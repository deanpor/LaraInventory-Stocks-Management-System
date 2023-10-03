<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function index(){

        $customer = Customer::where('status', 'Active')->get();
        return view ('customers.customers_table', ['customers'=>$customer]);

    }

    public function create(){
        return view('modals.customer.create');
    }

    public function store(Request $request){

        $response = ['status' => 0, 'message' => 'Fail to create customer'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:255',
        ]);

        if($validator->fails()){
            $response['message'] = json_encode($validator->errors());
        }else{

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email=$request->email;
            $customer->points_rewards = $request->points_rewards;
            $customer->contact_number=$request->contact_number;
            $customer->status = 'Active';
            $customer->created_by = auth()->user()->id;
            $customer->updated_by = auth()->user()->id;
            $customer->save();

            $response['status'] =1;
            $response['message'] = 'Customer Created Successfully.';

        }
        return $response;
    }

    public function show($id){
        $customer = Customer::find($id);
        return view('modals.customer.show', ['customer'=>$customer]);

    }

    public function edit($id){

        $customer = Customer::find($id);
        return view('modals.customer.update', ['customer'=>$customer]);
    }

    public function update(Request $request, $id){
        $response = ['status' => 0, 'message' => 'Fail to update customer.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|max:255',
            'points_carried' => 'required'
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        } else {

            $customer = Customer::where('id', $id)->first();
            $customer->name = $request->name;
            $customer->email=$request->email;
            $customer->contact_number=$request->contact_number;
            $customer->points_rewards = $request->points_carried;
            $customer->updated_by = auth()->user()->id;
            $customer->save();

            $response['status'] =1;
            $response['message'] = 'Customer Updated Successfully.';
        }
        return $response;

    }

    public function delete($id){

        $customer = Customer::find($id);
        return view ('modals.customer.delete', ['customer' => $customer]);

    }

    public function destroy(Request $request, $id){
        $response = ['status' => 0, 'message' => 'Fail to delete customer.'];


        $customer = Customer::where('id', $id)->first();
        $customer->status = 'Deleted';
        $customer->deleted_by = auth()->user()->id;
        $customer->deleted_at = now();
        $customer->save();

        $response['status'] = 1;
        $response['message'] = "Customer Deleted Successfully.";

        return $response;
    }

    public function deleted_customer_index(){
        $customer = Customer::where('status', 'Deleted')->onlyTrashed()->get();
        return view('customers.deleted_customers_table',
            [
                'customers' => $customer
            ]);
    }

    public function restore($id){
        $customer = Customer::where('id', $id)->onlyTrashed()->first();
        return view('modals.customer.restore', ['customer'=>$customer]);
    }

    public function recover($id){
        $response = ['status' => 0, 'message' => 'Fail to recover customer.'];

        $customer = Customer::where('id', $id)->withTrashed()->first();
        $customer->status ="Active";
        $customer->deleted_at = null;
        $customer->deleted_by = null;
        $customer->updated_by = auth()->user()->id;
        $customer->save();

        $response['status'] = 1;
        $response['message'] = "Product Restored Successfully.";

        return $response;
    }
}
