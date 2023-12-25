<?php

namespace App\Http\Controllers\Backend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(){
        return view('Backend.Pages.Shop.Staff');
    }
    public function all_data(Request $request){
        $search=$request->search['value'];
        $columnsForOrderBy=['id','name','email','address','city','phone','password','created_at','updated_at'];
        $orderByColumn=$request->order[0]['column'];
        $orderDirectection=$request->order[0]['dir'];

        $data=Staff::when($search,function($query)use($search){
            $query->where('name','like',"%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn],$orderDirectection);
        $total=$data->count();
        $item=$data->skip($request->start)->take($request->length)->get();
        return response()->json([
    		'draw'=>$request->draw,
    		'recordsTotal'=>$total,
    		'recordsFiltered'=>$total,
    		'data' => $item
    	]);
    }
    public function store(Request $request){
         // Validate the form data
         $ruls=[
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string|max:55',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $object = new Staff();
        $object->name=$request->name;
        $object->email=$request->email;
        $object->address=$request->address;
        $object->city=$request->city;
        $object->phone=$request->phone;
        $object->password=$request->password;
        $object->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function edit($id){
       $data= Staff::find($id);
       return response()->json(['success'=>true, 'data'=>$data]);
    }
    public function update(Request $request){
        // Validate the form data
        $ruls=[
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'password' => 'required|string|max:55',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }
        $object =Staff::find($request->id);
        $object->name=$request->name;
        $object->email=$request->email;
        $object->address=$request->address;
        $object->city=$request->city;
        $object->phone=$request->phone;
        $object->password=$request->password;
        $object->update();
        return response()->json(['success'=>'Update successfully']);
    }
    public function delete(Request $request){
        $data= Staff::find($request->id);
        $data->delete();
        return response()->json(['success'=>'Delete Successful']);
     }
}
