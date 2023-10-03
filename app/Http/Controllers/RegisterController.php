<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Milon\Barcode\DNS2D;

class RegisterController extends Controller
{
    //
    public function create(){

        return view('register.sign_up');
    }

    public function terms(){

        return view('modals.user.terms');
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'contact_number' => 'required|max:255|unique:users,contact_number',
            'password' =>'required|min:7|max:255',
            'repeat_password' =>'required|min:7|max:255|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            //create the user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact_number = $request->contact_number;
            $user->password = $request->password;
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

            //log the user in
            auth()->login($user);


            return redirect('/')->with('success', 'Your account has been created.' );



//        $validator = Validator::make($request->toArray(), [
//                'name' => 'required|max:255',
//                'email' => 'required|email|max:255|unique:users,email',
//                'contact_number' => 'required|max:255',
//                'password' =>'required|min:7|max:255',
//            ]
//        );
//
//
//        if ($validator->fails()) {
//            $response['message'] = json_encode($validator->errors());
//        } else {
//            $user = new User();
//            $user->name = $request->name;
//            $user->email = $request->email;
//            $user->contact_number = $request->contact_number;
//            $user->password = $request->password;
//            $user->save();
//
//            auth()->login($user);
//
//           return redirect('/');
////            $response['status'] = 1;
////            $response['message'] = "Successfully Sign Up.";
//        }
//
//        return $response;

    }
}
