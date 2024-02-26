<?php

namespace App\Http\Controllers\Backend\Contract;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index(){
        return view('Backend.Pages.Contract.Contract');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name','subject','email','phone_number','comment','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Contract::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
            $query->where('subject', 'like', "%$search%");
            $query->where('email', 'like', "%$search%");
            $query->where('phone_number', 'like', "%$search%");
            $query->where('comment', 'like', "%$search%");

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
    public function delete(Request $request){
        $object = Contract::find($request->id);

        if (!$object) {
            return response()->json(['error' => 'Not found']);
        }
        // Delete the data
        $object->delete();

        return response()->json(['success' => 'Deleted successfully']); 
    }
}
