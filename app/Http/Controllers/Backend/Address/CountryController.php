<?php

namespace App\Http\Controllers\Backend\Address;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(){
        return view('Backend.Pages.Address.Country');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'country_name','country_code','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Country::when($search, function ($query) use ($search) {
            $query->where('country_name', 'like', "%$search%");
            $query->where('country_code', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $object->count();
        $item = $object->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'country_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        // Create a new country instance
        $country = new Country();
        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->status = $request->status;
        $country->save();

        return response()->json(['success' => 'Added Successfully']);
    }
    public function edit($id){
        $data = Country::find($id);
        if (!$data) {
            return response()->json(['error' => 'Country not found']);
        }
        return response()->json(['success'=>true,'data' => $data]); 
    }
    public function update(Request $request){
        $request->validate([
            'country_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        $country= Country::find($request->id);
        $country->country_name = $request->country_name;
        $country->country_code = $request->country_code;
        $country->status = $request->status;
        $country->save();

        return response()->json(['success' => 'Update Successfully']);
    }
    public function delete(Request $request){
        $country = Country::find($request->id);

        if (!$country) {
            return response()->json(['error' => 'Country not found']);
        }
        // Delete the Country
        $country->delete();

        return response()->json(['success' => 'Country deleted successfully']); 
    }
}
