<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use App\Models\Product_image;
use App\Models\Seller;
use App\Models\Temp_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function index(){
         $product=Product::with('product_image')->latest()->get();
        return view('Backend.Pages.Product.index',compact('product'));
    }
    public function get_product($id){
        return Product::with('product_image')->where(['id'=>$id])->latest()->get();
    }
    public function create(){
        $seller=Seller::latest()->get();
        $category=Product_Category::latest()->get();
        $brand=Product_Brand::latest()->get();
        return view('Backend.Pages.Product.Create',compact('category','brand','seller'));
    }
    public function store(Request $request){
        $rules = [
            'product_name' => 'required',
            'brand_id'=>'required',
            'category_id'=>'required',
            'slug' => 'nullable|unique:products',
            'price' => 'required|numeric',
            'description' => 'nullable|max:10000',
            'seller_id' => 'required',
            'product_type' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()){

            $product = new Product();
            $product->user_id = Auth::guard('admin')->user()->id; 
            $product->title = $request->product_name;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_cat_id;
            $product->child_category_id = $request->child_cat_id;

            $product->seller_id = $request->seller_id;
            $product->size = $request->size;
            $product->color = $request->color;
            $product->tax = $request->tax;
            $product->delivery_charge = $request->delivery_charge;
            $product->product_type = $request->product_type;
            
            
            
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = 'Yes';
            $product->qty = $request->qty;

            $product->status = $request->status;

            $product->save();

            // save gallery pic
            if(!empty($request->image_array)){
                foreach($request->image_array as $temp_image_id){

                    $tempImageInfo = Temp_Image::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new Product_image();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'Null';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id.'-'.time().'.'.$ext;

                    $productImage->image =url('uploads/product/' .$imageName);
                    $productImage->save();

                    // Generate Product Thumbnails
                    $sPath = public_path() . '/temp/' . $tempImageInfo->name;
                    $dPath = public_path() . '/uploads/product/' . $imageName;

                    File::copy($sPath, $dPath);
                }
            }

            $request->session('success', 'Product added succesfully');
           
            return response()->json([
                'status' => true,
                'message' => 'Product added succesfully'
            ]);
            //return redirect()->route('admin.products.index')->with('success','Add Successfully');
            
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function delete(Request $request){
        $product=Product::find($request->id);
        if (empty($product)) {
            return redirect()->route('admin.products.index')->with('error','Product not found');
        }
        /* Product Image Find And Delete it From Database table */
        $product_image=Product_image::where(['product_id'=>$request->id])->get();
        if (!empty($product_image)) {
            foreach ($product_image as $productImage) {
                File::delete(public_path('uploads/product/'.$productImage->image));
            }
        }
        /* Now Delete Product Image Name Delete it From Database table */
        Product_image::where(['product_id'=>$request->id])->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Delete Success');
    }
    public function edit($id){
        $data=Product::find($id);
        return view('Backend.Pages.Product.Edit',compact('data'));
    }
}
