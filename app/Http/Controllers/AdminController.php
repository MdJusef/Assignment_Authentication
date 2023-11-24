<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function showProduct(){
        if(auth()->user()){
            $products = Product::get();
            return response()->json([
                'products' => $products,
            ]);
        }else{
            return response()->json('You are not registered user');
        }
    }

    public function addProduct(Request $request){
        if(auth()->user() && auth()->user()->role  == 'admin') {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:4|max:100',
                'product_video' => 'required|',
                'description' => 'required|string|min:10|max:300',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            } else {
                $products = new Product;
                $products->name = $request->name;
                $products->product_video = $request->product_video;
                $products->description = $request->description;
                $products->save();

                return response()->json([
                    'message' => 'product add successfully',
                    'products' => $products,
                ]);
            }
        }
        else{
            return response()->json('you don not have access to add product');
        }

    }

    public function updateProduct(Request $request){
        if (auth()->user() && auth()->user()->role =='admin'){
            $products = Product::find($request->product_id);
            $products->name = $request->name;
            $products->product_video = $request->product_video;
            $products->description = $request->description;
            $products->save();
            return response()->json([
                'message' => 'Product update Successfully',
                'product' => $products,
            ]);
        }
        else{
            return response()->json('you are not admin user');
        }
    }
}
