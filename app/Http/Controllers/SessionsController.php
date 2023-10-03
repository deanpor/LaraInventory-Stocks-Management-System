<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Milon\Barcode\DNS2D;

class SessionsController extends Controller
{
    //

    public function create(){

        return view('sessions.login');
    }

    public function store(){
        $attributes = request()->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);



        //attempt to authenticate and log in the user
        if(auth()->attempt($attributes)){

            session()->regenerate();
            return redirect('/')->with('success', 'Successfully Login.' );;

        }

        //if the authentication is failed
        throw ValidationException::withMessages([
            'email'=>'Your provided credentials could not be verified.'

        ]);

    }

    public function edit($id){

        $user = User::find($id);

        return view('modals.user.update', ['user' => $user]);
    }



    public function update(Request $request, $id){

        $response = ['status' => 0, 'message' => 'Fail to update user information.'];

        $user = User::where('id', $id)->first();
        $validator = Validator::make($request->toArray(), [
            'name' => ['required', Rule::unique('users', 'name')->ignore($user)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user)],
            'contact_number' => ['required', Rule::unique('users', 'contact_number')->ignore($user)],
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        }
        else
            if(!Auth::validate(['email'=>$request->old_email, 'password' => $request->password])){

                $response = ['status'=>2, 'message' => 'User password not correct.'];

        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->save();


                // Retrieve the auto-incremented ID
                $userId = $user->id;


// Create an associative array with the data you want to encode in JSON format
                $data = [
                    'user_id' => $userId,
                    'name' => $request->name,
                    'email' => $request->email,
                    'contact_number' => $request->contact_number

                ];

// Encode the data as JSON
                $jsonData = json_encode($data);

                // Generate the QR code as a base64-encoded string
                $qrCodeImage = (new DNS2D)->getBarcodePNG(
                    $jsonData,
                    'QRCODE',
                    5, // Set the width (in pixels) to your desired size
                    5, // Set the height (in pixels) to your desired size
                    array(0, 0, 0), // Set the foreground color (black)
                    true // Return the image as a base64-encoded string
                );

                // Save the QR code as a PNG file in the storage directory
                $fileName = "qrcode_$userId.png"; // Set a unique file name
                $filePath = storage_path("app/public/qr_codes/user/$fileName");
                File::put($filePath, base64_decode($qrCodeImage));


//

            $response['status'] = 1;
            $response['message'] = "User Information Updated Successfully.";
        }
        return $response;

    }
//    public function generateQRCode()
//    {
//        // Generate the QR code data
//        $userId = auth()->user()->id;
//        $userEmail = auth()->user()->email;
//        $qrCodeData = "User ID: $userId | User Email: $userEmail";
//
//        // Generate the QR code as a base64-encoded string
//        $qrCodeImage = (new \Milon\Barcode\DNS2D)->getBarcodePNG(
//            $qrCodeData,
//            'QRCODE',
//            5, // Set the width (in pixels) to your desired size
//            5, // Set the height (in pixels) to your desired size
//            array(0, 0, 0), // Set the foreground color (black)
//            true // Return the image as a base64-encoded string
//        );
//
//        // Save the QR code as a PNG file in the storage directory
//        $fileName = "qrcode_$userId.png"; // Set a unique file name
//        $filePath = storage_path("app/public/qr_codes/$fileName");
//        File::put($filePath, base64_decode($qrCodeImage));
//
//        // Return the file path or any other response if needed
//        return $filePath;
//    }
    public function edit_password($id){
        $user = User::find($id);
        return view ('modals.user.password_update', ['user'=>$user]);
    }

    public function update_password(Request $request, $id){

        $response = ['status' => 0, 'message' => 'Fail to update user password.'];

        $user = User::where('id', $id)->first();

        if(!Auth::validate(['email'=>$user->email, 'password'=>$request->old_password])){
            $response = ['status'=>2, 'message' => 'User password not correct.'];

        }else{
            $user->password = $request->new_password;

            $user->save();
            $response['status'] = 1;
            $response['message'] = "User Password Updated Successfully.";

        }


        return $response;

    }

    public function destroy(){

        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
