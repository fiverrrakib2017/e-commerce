<?php

namespace App\Http\Controllers\Backend\Supplier;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Customer_Invoice;
use App\Models\Customer_Invoice_Details;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Supplier_Invoice;
use App\Models\Supplier_Invoice_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Supplier_invoiceController extends Controller
{
    public function create_invoice(){
        $supplier=Supplier::latest()->get();
        $product=Product::latest()->get();
        $products=Product::with('product_image')->paginate(10);
        return view('Backend.Pages.Supplier.invoice_create',compact('supplier','product','products'));
    }
    public function search_product_data(Request $request){
        if ($request->search=='') {
            $products = Product::with('product_image')->latest()->get();
            return response()->json(['success'=>true,'data' => $products]);
            exit; 
        }
        $products = Product::with('product_image')->where('title', 'like', "%$request->search%")->get();
        return response()->json(['success'=>true,'data' => $products]);
    }
    public function show_invoice(){
        return view('Backend.Pages.Supplier.invoice');
    }
    public function view_invoice($id){
        $supplier=Supplier::latest()->get();
        $product=Product::latest()->get();
       $data=  Supplier_Invoice::with('supplier','items')->where('id',$id)->get();
       return view('Backend.Pages.Supplier.invoice_view',compact('data','supplier','product'));
    }
    public function edit_invoice($id){
        $supplier=Supplier::latest()->get();
        $product=Product::latest()->get();
        $products=Product::with('product_image')->paginate(10);
       $data=  Supplier_Invoice::with('supplier','items')->where('id',$id)->get();
       return view('Backend.Pages.Supplier.invoice_edit',compact('data','supplier','product','products'));
    }
    public function update_invoice(Request $request){
        /* Validate the request data*/
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
            'product_id' => 'required|array',
            'product_id.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'total_price' => 'required|array',
            'total_price.*' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);
        /* If validation fails, return the error response*/
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
         /*Update the invoice*/
         $invoice = Supplier_Invoice::find($request->id);
         $invoice->supplier_id = $request->supplier_id;
         $invoice->total_amount = $request->total_amount;
         $invoice->paid_amount = $request->paid_amount ?? 0;
         $invoice->due_amount = $request->due_amount ?? $request->total_amount;
         $invoice->update();

        /* Delete existing invoice items */
        $invoice->items()->delete();

        /* Create new invoice items*/
        foreach ($request->product_id as $index => $productId) {
            $invoiceItem = new Supplier_Invoice_Details();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->product_id = $productId;
            $invoiceItem->qty = $request->qty[$index];
            $invoiceItem->price = $request->price[$index];
            $invoiceItem->total_price = $request->qty[$index] * $request->price[$index];
            $invoiceItem->save();
    
            // Update total amount
            //$invoice->total_amount += $invoiceItem->total_price;
        } 

        /*Calculate and update due amount*/ 
        // $invoice->due_amount = $invoice->total_amount - ($request->paid_amount ?? 0);
        // $invoice->save();
        
        return response()->json(['success' => true, 'message' => 'Invoice updated successfully'], 201);
    }
    public function show_invoice_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'fullname', 'phone_number','total_amount', 'paid_amount', 'due_amount','status','created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];
    
        $query = Supplier_Invoice::with('supplier')->when($search, function ($query) use ($search) {
            $query->where('total_amount', 'like', "%$search%")
                  ->orWhere('paid_amount', 'like', "%$search%")
                  ->orWhere('due_amount', 'like', "%$search%")
                  ->orWhere('created_at', 'like', "%$search%")
                  ->orWhereHas('supplier', function ($query) use ($search) {
                      $query->where('fullname', 'like', "%$search%")
                            ->orWhere('phone_number', 'like', "%$search%");
                  });
        }) ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection)
        ->paginate($request->length);
    
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $query->total(),
            'recordsFiltered' => $query->total(),
            'data' => $query->items(),
        ]);
    }
    public function store_invoice(Request $request){
        /* Validate the request data*/
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|integer',
            'product_id' => 'required|array',
            'product_id.*' => 'required|numeric',
            'qty' => 'required|array',
            'qty.*' => 'required|numeric',
            'price' => 'required|array',
            'price.*' => 'required|numeric',
            'total_price' => 'required|array',
            'total_price.*' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);
        /* If validation fails, return the error response*/
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
       
        /*Create the invoice*/
        $invoice = new Supplier_Invoice();
        $invoice->supplier_id = $request->supplier_id;
        $invoice->total_amount = $request->total_amount;
        $invoice->paid_amount = $request->paid_amount ?? 0;
        $invoice->due_amount = $request->due_amount ?? $request->total_amount;
        $invoice->save();
        

        /* Create invoice items*/
        foreach ($request->product_id as $index => $productId) {
            $invoiceItem = new Supplier_Invoice_Details();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->product_id = $productId;
            $invoiceItem->qty = $request->qty[$index];
            $invoiceItem->price = $request->price[$index];
            $invoiceItem->total_price = $request->qty[$index] * $request->price[$index];
            $invoiceItem->save();

            // Update total amount
            $invoice->total_amount += $invoiceItem->total_price;
        } 

          /*Calculate and update due amount*/ 
          $invoice->due_amount = $invoice->total_amount - ($request->paid_amount ?? 0);
          $invoice->save();
          return response()->json(['success' =>true, 'message'=> 'Invoice stored successfully'], 201);
        
    }
    public function delete_invoice(Request $request){
        $invoice = Supplier_Invoice::find($request->id);
        $invoice->delete();
        return response()->json(['success'=>true,'message' => 'Invoice deleted successfully']);
    }
}
