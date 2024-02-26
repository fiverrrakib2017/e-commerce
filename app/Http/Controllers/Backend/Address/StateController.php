<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $data=Country::latest()->get();
        return view('Backend.Pages.Address.State',compact('data'));
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $columnsForOrderBy = ['id', 'country_id', 'name', 'status', 'created_at'];

    $states = State::with('country')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('country', function ($q) use ($search) {
                $q->where('country_name', 'like', "%$search%");
            })
            ->orWhere('name', 'like', "%$search%");
        })
        ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
        ->paginate($request->length);

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $states->total(),
            'recordsFiltered' => $states->total(),
            'data' => $states->items(),
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'country_id' => 'required|string|max:255',
            'state_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        // Create a new State instance
        $object = new State();
        $object->country_id = $request->country_id;
        $object->name = $request->state_name;
        $object->status = $request->status;
        $object->save();

        return response()->json(['success' => 'Added Successfully']);
    }
    public function edit($id){
        $data = State::with('country')->find($id);
        if (!$data) {
            return response()->json(['error' => 'State not found']);
        }
        return response()->json(['success'=>true,'data' => $data]); 
    }
    public function update(Request $request){
        $request->validate([
            'country_id' => 'required|string|max:255',
            'state_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        $object= State::find($request->id);
        $object->country_id = $request->country_id;
        $object->name = $request->state_name;
        $object->status = $request->status;
        $object->save();

        return response()->json(['success' => 'Update Successfully']);
    }
    public function delete(Request $request){
        $state = State::find($request->id);

        if (!$state) {
            return response()->json(['error' => 'State not found']);
        }
        // Delete the state
        $state->delete();

        return response()->json(['success' => 'State deleted successfully']); 
    }
}
