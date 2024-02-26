<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $data=State::latest()->get();
        return view('Backend.Pages.Address.City',compact('data'));
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $columnsForOrderBy = ['id', 'state_id', 'name', 'status', 'created_at'];

    $city = City::with('state')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('state', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhere('name', 'like', "%$search%");
        })
        ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
        ->paginate($request->length);

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $city->total(),
            'recordsFiltered' => $city->total(),
            'data' => $city->items(),
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'state_id' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        
        // Create a new City instance
        $object = new City();
        $object->state_id = $request->state_id;
        $object->name = $request->city_name;
        $object->status = $request->status;
        $object->save();

        return response()->json(['success' => 'Added Successfully']);
    }
    public function edit($id){
        $data = City::with('state')->find($id);
        if (!$data) {
            return response()->json(['error' => 'City not found']);
        }
        return response()->json(['success'=>true,'data' => $data]); 
    }
    public function update(Request $request){
        $request->validate([
            'state_id' => 'required|string|max:255',
            'city_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        $object= City::find($request->id);
        $object->state_id = $request->state_id;
        $object->name = $request->city_name;
        $object->status = $request->status;
        $object->save();

        return response()->json(['success' => 'Update Successfully']);
    }
    public function delete(Request $request){
        $object = City::find($request->id);

        if (!$object) {
            return response()->json(['error' => 'City not found']);
        }
        // Delete the City
        $object->delete();

        return response()->json(['success' => 'City deleted successfully']); 
    }
}
