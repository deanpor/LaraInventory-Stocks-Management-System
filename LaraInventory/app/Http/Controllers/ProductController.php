<?php

namespace App\Http\Controllers;

use App\Models\Product;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    //
    public function index()
    {


        $product = Product::where('status', 'In Stock')->get();
//
//        foreach ($product as $test){
//            dd($test->count());
//        }
        return view('products.products_table',
            [
                'products' => $product
            ]);

    }


    public function show(Product $product)
    {
        return view('modals.product.show', ['product' => $product]);
    }

    public function create()
    {

        return view('modals.product.create');
    }

//    public function store(Request $request)
//    {
//        $response = ['status' => 0, 'message' => 'Fail to create product.'];
//
//        $validator = Validator::make($request->toArray(), [
//            'name' => 'string|required',
//            'upc' => 'string|required',
//            'sku' => 'string|required',
//        ]);
//
//        if ($validator->fails()) {
//            $response['message'] = json_encode($validator->errors());
//        } else {
//            $product = new Product();
//            $product->user_id = auth()->user()->id;
//            $product->updated_by = auth()->user()->id;
//            $product->name = $request->name;
//            $product->upc = $request->upc;
//            $product->sku = $request->sku;
//            $product->description = $request->description;
//            $product->status = 'In Stock';
//            $product->save();
//
//

//
//
//            $response['status'] = 1;
//            $response['message'] = "Product Created Successfully.";
//
//        }
//
//        return $response;
//    }


    public function store(Request $request)
    {
        $response = ['status' => 0, 'message' => 'Fail to create product.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'upc' => 'string|required',
            'sku' => 'string|required',
        ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        } else {
            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->updated_by = auth()->user()->id;
            $product->name = $request->name;
            $product->upc = $request->upc;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->status = 'In Stock';
            $product->save();

            $productId = $product->id;

            $barCodeImage = (new DNS1D)->getBarcodePNG(
                $product->upc,
                'C39',
                1, // Set the width (in pixels) to your desired size
                80, // Set the height (in pixels) to your desired size
                array(0, 0, 0), // Set the foreground color (black)
                true

            );

            // Save the QR code as a PNG file in the storage directory
            $fileName = "barcode_$productId.png"; // Set a unique file name
            $filePath = storage_path("app/public/barcode/products/$fileName");
            File::put($filePath, base64_decode($barCodeImage));

            $response['status'] = 1;
            $response['message'] = "Product Created Successfully.";

        }

        return $response;
    }




    public function edit($id)
    {

        $product = Product::find($id);

        return view('modals.product.update', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $response = ['status' => 0, 'message' => 'Fail to update product.'];

        $validator = Validator::make($request->toArray(), [
            'name' => 'string|required',
            'upc' => 'string|required',
            'sku' => 'string|required',
        ],
            [
            ]);

        if ($validator->fails()) {
            $response['message'] = json_encode($validator->errors());
        } else {
            $product = Product::where('id', $id)->first();
            $product->name = $request->name;
            $product->upc = $request->upc;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->status = 'In Stock';
            $product->updated_by = auth()->id();
            $product->save();

            $barCodeImage = (new DNS1D)->getBarcodePNG(
                $product->upc,
                'C39',
                1, // Set the width (in pixels) to your desired size
                80, // Set the height (in pixels) to your desired size
                array(0, 0, 0), // Set the foreground color (black)
                true

            );

            // Save the QR code as a PNG file in the storage directory
            $fileName = "barcode_$product->id.png"; // Set a unique file name
            $filePath = storage_path("app/public/barcode/products/$fileName");
            File::put($filePath, base64_decode($barCodeImage));


            $response['status'] = 1;
            $response['message'] = "Product Updated Successfully.";
        }
        return $response;

    }

    public function delete($id)
    {
        $product = Product::find($id);
        return view('modals.product.delete', ['product' => $product]);
    }

    public function destroy($id)
    {
        $response = ['status' => 0, 'message' => 'Fail to delete product.'];


        $product = Product::where('id', $id)->first();
        if($product->stocks()->count() > 0) {
            $response['status'] = 2;
            $response['message'] = "Unable To Delete The Product Due To It Have Stocks Exist For The Product";
        }else{
            $product->status = 'Deleted';
            $product->deleted_by = auth()->user()->id;
            $product->deleted_at = now();
            $product->save();

//            $barcodeImage = "barcode/products/barcode_{$product->id}.png";
//            Storage::delete($barcodeImage);

            $response['status'] = 1;
            $response['message'] = "Product Deleted Successfully.";
        }

        return $response;
    }

    public function deleted_product_index()
    {
        $product = Product::where('status', 'Deleted')->onlyTrashed()->get();
        return view('products.deleted_products_table',
            [
                'products' => $product
            ]);

    }

    public function restore($id)
    {
        $product = Product::where('id', $id)->onlyTrashed()->first();
        return view('modals.product.restore', ['product' => $product]);
    }

    public function recover($id)
    {
        $response = ['status' => 0, 'message' => 'Fail to recover product.'];

        $product = Product::where('id', $id)->withTrashed()->first();
        $product->status = 'In Stock';
        $product->deleted_at = null;
        $product->deleted_by = null;
        $product->updated_by = auth()->user()->id;
        $product->save();

        $response['status'] = 1;
        $response['message'] = "Product Restored Successfully.";

        return $response;

    }
}
