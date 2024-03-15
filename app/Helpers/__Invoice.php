<?php
namespace App\Helpers;

use App\Models\Customer_Invoice;
use App\Models\Customer_Transaction_History;
use App\Models\Supplier_Invoice;
use App\Models\Supplier_Transaction_History;
use App\Models\Product_Order;
use App\Models\Invoice_Note;

if (!function_exists('__get_invoice_data')) {
    function __get_invoice_data($id,$type){
        if ($type==='Customer') {
            $invoice_count=Customer_Invoice::where('customer_id',$id)->count();
            $total_paid_amount=Customer_Invoice::where('customer_id',$id)->sum('paid_amount');
            $total_due_amount=Customer_Invoice::where('customer_id',$id)->sum('due_amount');
            $invoices = Customer_Invoice::where('customer_id', $id)->get();
            $transaction_history=Customer_Transaction_History::where('id',$id)->get();
        }elseif($type='Supplier'){
            $invoice_count=Supplier_Invoice::where('supplier_id',$id)->count();
            $total_paid_amount=Supplier_Invoice::where('supplier_id',$id)->sum('paid_amount');
            $total_due_amount=Supplier_Invoice::where('supplier_id',$id)->sum('due_amount');
            $invoices = Supplier_Invoice::where('supplier_id', $id)->get();
            $transaction_history=Supplier_Transaction_History::where('id',$id)->get();
        }else{
            $invoice_count=0; 
            $total_paid_amount=0; 
            $total_due_amount=0; 
            $invoices=[]; 
        }
        return compact('invoice_count','total_paid_amount','total_due_amount','invoices','transaction_history');
    }
}
if (!function_exists('__due_payment_received')) {
    function __due_payment_received($request, $invoiceModel, $historyModel, $foreignKey) {
        $request->validate([
            'id' => 'required|integer', 
            'amount' => 'required|numeric', 
        ]);

        $invoice = $invoiceModel->find($request->id);
        $dueAmount = $invoice->due_amount;

        if ($request->amount > $dueAmount) {
            return response()->json(['success' => false, 'message' => 'Over Amount Not Allowed'], 400);
        }

        $paid_amount = $invoice->paid_amount + $request->amount;
        $due_amount = max($invoice->due_amount - $request->amount, 0);
       
        $invoice->update([
            'paid_amount' => $paid_amount,
            'due_amount' => $due_amount,
        ]);

        // Log transaction history
        $object = new $historyModel();
        $object->invoice_id = $request->id; 
        $object->$foreignKey = $invoice->$foreignKey;
        $object->amount = $request->amount;
        $object->status = 1;
        $object->save();

        return response()->json(['success'=>true,'message' => 'Payment successful'], 200);
    }
}
if (!function_exists('__user_order_update_status')) {
    function __user_order_update_status($invoice_id,$order_status,$type){
        $object=Product_Order::find($invoice_id);
        $object->order_status=$order_status; 
        $object->save();

        $notes=new Invoice_Note();
        $notes->invoice_id =$object->id; 
        $notes->note=$type;
        $notes->save();
    }
}
