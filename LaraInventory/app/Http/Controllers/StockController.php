<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    //

    public function index(){

        //Find out the stock that the deleted at equal to null
        $query = Stock::where('deleted_at', null);
        $product_chose = null;
        $query2 = Product::where('deleted_at', null);

        //If the product for filtration is set and not null, perform the filtration according to the product
        if (isset($_GET['product']) && $_GET['product'] != null){

            $query->where('product_id', $_GET['product']);
            $query2->find($_GET['product']);
            $product_chose = $query2->first();

        }

        if (isset($_GET['status']) && $_GET['status'] != null ){

            $query->where('status', $_GET['status']);
        }

        //Get the query result and prepare for showing out to the table
        $stocks = $query->get();



        //For selecting of product name for filtering purpose
        $products = Product::where('status', '!=', 'Deleted')->get();

        //Return the query result to the stocks table
        return view('stocks.stocks_table',[
            'stocks' => $stocks,
            'products' => $products,
            'product_chose'=> $product_chose,
            'status'=>\request('status'),
        ] );
    }

    public function in_stock_index(){

        $stock = Stock::where('status','In Stock')->get();
        return view('stocks.in_stock_stocks_table',[
            'stocks' => $stock
        ]);
    }

    public function sell_stock($id){
        $stock = Stock::find($id);
        $customers = Customer::where('status', '!=', 'Deleted')->get();
        return view('modals.stock.sell', ['stock'=>$stock], ['customers' => $customers] );

    }

    public function stock_sold(Request $request, $id){
        $response = ['status' => 0, 'message' => 'Fail to sell this stock.'];


        $stock = Stock::where('id', $id)->first();
        $stock->status = 'Sold';
        $stock->sold_by = auth()->user()->id; //if no sign in, this will be fail
        $stock->sold_at = now();
        $stock->sold_to = $request->customer_id;
        $stock->save();

        $response['status'] = 1;
        $response['message'] = "Stock Sold Successfully.";

        return $response;
    }

    public function create(){

        $products = Product::where('status', '!=', 'Deleted')->get();
        return view('modals.stock.create',['products'=>$products]);
    }

    public function store(Request $request){

        $response = ['status' => 0, 'message' => 'Fail to create stocks'];

        $validator = Validator::make($request->toArray(), [
            'cost_price' => 'required',
            'sell_price' => 'required',
            'quantity' => 'required',
            'product_id' => 'required',
        ]);

        if($validator->fails()){
            $response['message'] = json_encode($validator->errors());
        }else{

            for ($x = 0; $x < $request->quantity ; $x++) {


                $stock = new Stock();
                $stock->product_id = $request->product_id;
                $stock->cost_price = $request->cost_price;
                $stock->sell_price = $request->sell_price;
                $stock->created_by = auth()->id();
                $stock->updated_by = auth()->id();
                $stock->status = 'In Stock';
                $stock->save();

            }

            $response['status'] =1;
            $response['message'] = 'Stock Created Successfully.';

        }
        return $response;
    }

    public function edit($id){
        $stock = Stock::find($id);
        $products = Product::where('status', '!=', 'Deleted')->get();
        return view('modals.stock.update', ['stock' =>$stock], ['products' => $products]);
    }

    public function update(Request $request, $id)
    {
        $response = ['status' => 0, 'message' => 'Fail to create stocks'];

        $validator = Validator::make($request->toArray(), [
            'cost_price' => 'required',
            'sell_price' => 'required',
            'product_id' => 'required',
        ]);

        if($validator->fails()){
            $response['message'] = json_encode($validator->errors());
        }else{



                $stock = Stock::where('id', $id)->first();
                $stock->product_id = $request->product_id;
                $stock->cost_price = $request->cost_price;
                $stock->sell_price = $request->sell_price;
                $stock->updated_by = auth()->user()->id;
                $stock->save();

            $response['status'] =1;
            $response['message'] = 'Stock Created Successfully.';

        }
        return $response;

    }

    public function delete($id){
        $stock = Stock::find($id);
        return view('modals.stock.delete', ['stock'=>$stock] );

    }


    public function destroy($id)
    {
        $response = ['status' => 0, 'message' => 'Fail to delete stock.'];

        $stock = Stock::where('id', $id)->first();
        $stock->status = 'Deleted';
        $stock->deleted_by = auth()->user()->id; //if no sign in, this will be fail
        $stock->deleted_at = now();
        $stock->save();

        $response['status'] = 1;
        $response['message'] = "Stock Deleted Successfully.";

        return $response;
    }

    public function show ($id){

        $stock = Stock::find($id);

        return view ('modals.stock.show', ['stock' =>$stock]);
    }

    public function deleted_stock_index(){
        $stock = Stock::where('status', 'Deleted')->onlyTrashed()->get();
        return view('stocks.deleted_stocks_table',
            [
                'stocks' => $stock
            ]);

    }

    public function multi_delete(Request $request){


        $selectedStocks = explode(',', $request->input('selectedStocks')); //Explode is a PHP function call that splits a string into an array based on a specified delimiter.
                                                                                        //The delimiter in this case is the ','
        $response = ['status' => 0, 'message' => 'Fail to delete stock.'];
        foreach($selectedStocks as $selected_stock){
            $stock = Stock::where('id', $selected_stock)->first();
            $stock->status = 'Deleted';
            $stock->deleted_by = auth()->user()->id; //if no sign in, this will be fail
            $stock->deleted_at = now();
            $stock->save();

        }

        return redirect()->route('stock.search');

    }

    public function restore($id) {
        $stock = Stock::where('id', $id)->onlyTrashed()->first();
        return view('modals.stock.restore', ['stock' => $stock]);
    }

    public function recover(Request $request, $id){
        $response = ['status' => 0, 'message' => 'Fail to recover stock.'];

        $stock = Stock::where('id', $id)->withTrashed()->first();
        $stock->status = 'In Stock';
        $stock->deleted_at = null;
        $stock->deleted_by = null;
        $stock->updated_by = auth()->user()->id;
        $stock->save();

        $response['status'] = 1;
        $response['message'] = "Stock Restored Successfully.";

        return $response;

    }


}
