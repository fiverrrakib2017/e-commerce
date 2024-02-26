<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\leadFrom;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use Illuminate\Http\Request;
use DB;

class homeController extends Controller
{
    public function index(){
        $brand=Product_Brand::latest()->get();
        $category=Product_Category::latest()->get();
        $product=Product::with('product_image','brand','category')->latest()->paginate(8);

        return view('Frontend.Pages.Home.Home',compact('brand','category','product'));
    }
    public function babybouncer(){


        return view('Frontend.Pages.babybouncer');
    }

    public function babyoffer(){


        return view('Frontend.Pages.leadfrom');
    }
    public function leadSave(Request $r){

        $lead =new leadfrom;
        $lead->name=$r->name?$r->name:"not data";$r->name;
        $lead->number=$r->number?$r->number:"not data";$r->number;
        $lead->age=$r->age?$r->age:"not data";$r->age;
        $lead->subject=$r->subject?$r->subject:"not data";
        $lead->save();
        return redirect()->back()->with("success","এই লটারির ব্যাপারে আরো বিস্তারিত জানতে ও আপডেট জানতে আমাদের গ্রুপে জয়েন করুন");
    }
    public function load_more(Request $request)
    {
        $start = $request->input('start');
        $data=Product::with('product_image','brand','category')->latest()->offset($start)
        ->limit(8)
        ->get();
        return response()->json([
            'data' => $data,
            'next' => $start + 8
        ]);
    }


}
