<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\Invoice_Note;
use App\Models\Product;
use App\Models\Product_Order;
use App\Models\Product_Order_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        return view('Backend.Pages.Order.Order');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'fullname', 'phone_number','sub_total', 'discount', 'grand_total','order_status','created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Product_Order::when($search, function ($query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%");
            $query->where('phone_number', 'like', "%$search%");
            $query->where('sub_total', 'like', "%$search%");
            $query->where('discount', 'like', "%$search%");
            $query->where('grand_total', 'like', "%$search%");
            $query->where('order_status', 'like', "%$search%");
        });
        $object->select([
            '*',
            DB::raw("CONCAT(first_name, ' ', last_name) as fullname")
        ]);
        
        $object->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $object->count();
        $item = $object->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
    public function get_order($id){
        $product_order = Product_Order::with('orderDetails')->find($id);
        foreach ($product_order->orderDetails as $order_detail) {
            // Retrieve product details based on product_id
            $product = Product::find($order_detail->product_id);
            
            // Append product details to the order detail object
            $order_detail->product = $product;
        }
        return response()->json(['success' => true, 'data' =>$product_order]);
    }
    public function get_note($id){
        $data = Invoice_Note::where(['invoice_id'=>$id])->get();
        if (!empty($data)) {
            return response()->json(['success' => true, 'data' =>$data]);
            exit; 
        } 
        return response()->json(['success' => false, 'message' =>'Not Found']);
    }
    public function order_note_store(Request $request){
        $request->validate([
            'id' => 'required',
            'note' => 'required|string',
        ]);
        /* Create a new Invoice_Note instance*/
        $object = new Invoice_Note();
        $object->invoice_id = $request->id;
        $object->note = $request->note;
        $object->save();

        return response()->json(['success'=>true,'message' => 'Added Successfully']);
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
    public function confirm_order($id){
        $object=Product_Order::find($id);
    }
}
