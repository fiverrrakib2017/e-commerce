<?php

namespace App\Http\Controllers\Backend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Pickup_point;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pickupController extends Controller
{
    public function index(){
        $staff=Staff::latest()->get();
        return view('Backend.Pages.Shop.Pickup',compact('staff'));
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'staff_id', 'name', 'address', 'phone','pick_up_status','cash_on_pickup_status'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $run_query = Pickup_point::with('staff:id,name')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    // Search based on the staff's fullname in the staff table
                    $subquery->whereHas('staff', function ($subquery) use ($search) {
                        $subquery->where('name', 'like', "%$search%");
                    });
                    // Or search based on the name in the pickup_points table
                    $subquery->orWhere('name', 'like', "%$search%");
                });
            })
            ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection);

        $total = $run_query->count();
        $item = $run_query->skip($request->start)->take($request->length)->get();

        $data = [];

        foreach ($item as $item) {
            $data[] = [
                'id' => $item->id,
                'staff_name' => $item->staff ? $item->staff->name  : 'N/A',
                'name' => $item->name,
                'address' => $item->address,
                'phone' => $item->phone,
                'pick_up_status' => $item->pick_up_status,
                'cash_on_pickup_status' => $item->cash_on_pickup_status,
                'created_at' => $item->created_at,
            ];
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
    public function store(Request $request){
         // Validate the form data
         $ruls=[
            'staff_name' => 'required|string|max:255',
            'pickup_point_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'pick_up_status' => 'required|in:1,2',
            'cash_on_pickup_status' =>'required|in:1,2',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $object = new Pickup_point();
        $object->staff_id=$request->staff_name;
        $object->name=$request->pickup_point_name;
        $object->address=$request->address;
        $object->phone=$request->phone;
        $object->pick_up_status=$request->pick_up_status;
        $object->cash_on_pickup_status=$request->cash_on_pickup_status;
        $object->save();
        return response()->json(['success'=>'Added successfully']);
    }
    public function delete(Request $request){
        $object=Pickup_point::find($request->id);
        $object->delete();
        return response()->json(['success'=>'Delete successfully']);
    }
    public function edit($id){
        $data=Pickup_point::find($id);
        return response()->json(['success'=>true, 'data'=>$data]);
    }
    public function update(Request $request){
         // Validate the form data
         $ruls=[
            'staff_name' => 'required|string|max:255',
            'pickup_point_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'pick_up_status' => 'required|in:1,2',
            'cash_on_pickup_status' =>'required|in:1,2',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $object =Pickup_point::find($request->id);
        $object->staff_id=$request->staff_name;
        $object->name=$request->pickup_point_name;
        $object->address=$request->address;
        $object->phone=$request->phone;
        $object->pick_up_status=$request->pick_up_status;
        $object->cash_on_pickup_status=$request->cash_on_pickup_status;
        $object->update();
        return response()->json(['success'=>'Update successfully']);
    }
}
