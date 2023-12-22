<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Discount_Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $discount = Discount_Coupon::findOrFail($id);
        return response()->json(['success' => true, 'data' => $discount]);
    }
    public function delete(Request $request){
        $coupon = Discount_Coupon::find($request->id);
    
        if (!$coupon) {
            return response()->json(['error' => 'Coupon not found.'], 404);
        }
    
        $coupon->delete();
    
        return response()->json(['success' => 'Coupon deleted successfully.']);
    }
    public function store(Request $request){
        // Validate the form data
         $ruls=[
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_use' => 'required|integer',
            'type' => 'required|in:fixed,parcent',
            'discount_amount' => 'required|numeric',
            'min_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'expire_date' => 'required|date|after:start_date',
            'status' => 'required|in:0,1',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $discount = new Discount_Coupon();
        $discount->code=$request->code;
        $discount->name=$request->name;
        $discount->description=$request->description;
        $discount->max_use=$request->max_use;
        $discount->type=$request->type;
        $discount->discount_amount=$request->discount_amount;
        $discount->min_amount=$request->min_amount;
        $discount->status=$request->status;
        $discount->starts_at=$request->start_date;
        $discount->expires_at=$request->expire_date;
        $discount->save();
        return response()->json(['success'=>'Coupon Added successfully']);
    }
    public function update(Request $request){
        // Validate the form data
        $ruls=[
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_use' => 'required|integer',
            'type' => 'required|in:fixed,parcent',
            'discount_amount' => 'required|numeric',
            'min_amount' => 'required|numeric',
            'start_date' => 'required|date',
            'expire_date' => 'required|date|after:start_date',
            'status' => 'required|in:0,1',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        $discount =Discount_Coupon::find($request->id);
        $discount->code=$request->code;
        $discount->name=$request->name;
        $discount->description=$request->description;
        $discount->max_use=$request->max_use;
        $discount->type=$request->type;
        $discount->discount_amount=$request->discount_amount;
        $discount->min_amount=$request->min_amount;
        $discount->status=$request->status;
        $discount->starts_at=$request->start_date;
        $discount->expires_at=$request->expire_date;
        $discount->update();
        return response()->json(['success'=>'Coupon Update successfully']);
    }
    

    
}
