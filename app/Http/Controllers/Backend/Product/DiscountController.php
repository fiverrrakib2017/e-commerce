<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Discount_Coupon;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(){
        return view('Backend.Pages.Product.Discount.index');
    }
    public function get_all_data(Request $request){
        $search=$request->search['value'];
        $columnsForOrderBy=['id','name','discount_amount','max_use','min_amount','expires_at','created_at','updated_at'];
        $orderByColumn=$request->order[0]['column'];
        $orderDirectection=$request->order[0]['dir'];

        $coupon=Discount_Coupon::when($search,function($query)use($search){
            $query->where('name','like',"%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn],$orderDirectection);
        $total=$coupon->count();
        $item=$coupon->skip($request->start)->take($request->length)->get();
        return response()->json([
    		'draw'=>$request->draw,
    		'recordsTotal'=>$total,
    		'recordsFiltered'=>$total,
    		'data' => $item
    	]);
    }
    public function edit($id){
        return $id;
    }
    public function delete(Request $request){
        $coupon = Discount_Coupon::find($request->id);
    
        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found.'], 404);
        }
    
        $coupon->delete();
    
        return response()->json(['success' => 'Coupon deleted successfully.']);
    }
    
}
