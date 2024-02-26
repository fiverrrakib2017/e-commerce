<?php

namespace App\Http\Controllers\Api;
use Firebase\JWT\JWT;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index(Request $request){
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error'=>'User id Not Found']);
        }
        $data=Product::with('product_image','brand','category','sub_category')->where('user_id',$userId)->latest()->get();
        return response()->json(['success'=>true,'data'=>$data]);
    }
    public function indexForDev(Request $request){

        $data=Product::with('product_image','brand','category','sub_category')->latest()->get();
        return response()->json(['success'=>true,'data'=>$data]);
    }
    public function get_product($id){
        $userId = Auth::id();
        if (!$userId) {
            return response()->json(['error'=>'User id Not Found']);
        }
        $data=Product::with('product_image','brand','category','sub_category')->where(['user_id'=>$userId,'id'=>$id])->first();
        return response()->json(['success'=>true,'data'=>$data]);
    }
    public function get_productForDev($id){

        $data=Product::with('product_image','brand','category','sub_category')->where('id',$id)->first();
        return response()->json(['success'=>true,'data'=>$data]);
    }
}
