<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Product_Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view('Backend.Pages.Order.Order');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'user_id', 'sub_total', 'discount', 'grand_total','payment_status','created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $run_query = Product_Order::with('user:id,name')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    /* Search based on the user name in the user table*/
                    $subquery->whereHas('user', function ($subquery) use ($search) {
                        $subquery->where('name', 'like', "%$search%");
                    });
                    // Or search based on the name in the Product Order table
                    $subquery->orWhere('sub_total', 'like', "%$search%");
                    $subquery->orWhere('discount', 'like', "%$search%");
                    $subquery->orWhere('grand_total', 'like', "%$search%");
                    $subquery->orWhere('payment_status', 'like', "%$search%");
                });
            })
            ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection);

        $total = $run_query->count();
        $item = $run_query->skip($request->start)->take($request->length)->get();

        $data = [];

        foreach ($item as $item) {
            $data[] = [
                'id' => $item->id,
                'order_name' => $item->user ? $item->user->name  : 'N/A',
                'sub_total' => $item->sub_total,
                'discount' => $item->discount,
                'grand_total' => $item->grand_total,
                'payment_status' => $item->payment_status,
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
    public function delete(Request $request){
        try {
            $subscriber = Product_Order::findOrFail($request->id);
            $subscriber->delete();

            return response()->json(['success' => true, 'message' => 'Delete successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error '], 500);
        }
    }
}
