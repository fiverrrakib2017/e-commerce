<?php

namespace App\Http\Controllers\Backend\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        return view('Backend.Pages.Subscriber.Subscriber');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'email', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $coupon = Subscriber::when($search, function ($query) use ($search) {
            $query->where('email', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $coupon->count();
        $item = $coupon->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
    public function delete(Request $request){
        try {
            $subscriber = Subscriber::findOrFail($request->id);
            $subscriber->delete();

            return response()->json(['success' => true, 'message' => 'Delete successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error '], 500);
        }
    }
}
