<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(){
        $data=City::latest()->get();
        return view('Backend.Pages.Address.Address',compact('data'));
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
        $columnsForOrderBy = ['id', 'city_id', 'postal_code', 'street_address', 'created_at'];

        $addresses = Address::with(['city.state.country'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('city.state.country', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('city.state', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhereHas('city', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })
                ->orWhere('postal_code', 'like', "%$search%")
                ->orWhere('street_address', 'like', "%$search%");
            })
            ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
            ->paginate($request->length);

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $addresses->total(),
            'recordsFiltered' => $addresses->total(),
            'data' => $addresses->items(),
        ]);

    }
    public function store(Request $request){
        $request->validate([
            'city_id' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'postal_code' => 'required',
        ]);
        // Create a new City instance
        $object = new Address();
        $object->city_id = $request->city_id;
        $object->street_address = $request->street_address;
        $object->postal_code = $request->postal_code;
        $object->save();

        return response()->json(['success' => 'Added Successfully']);
    }
    public function edit($id){
        $data = Address::with('city')->find($id);
        if (!$data) {
            return response()->json(['error' => 'Address not found']);
        }
        return response()->json(['success'=>true,'data' => $data]); 
    }
    public function update(Request $request){
        $request->validate([
            'city_id' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'postal_code' => 'required',
        ]);
        $object= Address::find($request->id);
        $object->city_id = $request->city_id;
        $object->street_address = $request->street_address;
        $object->postal_code = $request->postal_code;
        $object->update();

        return response()->json(['success' => 'Update Successfully']);
    }
    public function delete(Request $request){
        $object = Address::find($request->id);

        if (!$object) {
            return response()->json(['error' => 'Address not found']);
        }
        // Delete the Address
        $object->delete();

        return response()->json(['success' => 'Address deleted successfully']); 
    }
}
