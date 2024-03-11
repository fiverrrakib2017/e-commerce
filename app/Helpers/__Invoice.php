<?php
namespace App\Helpers;

use App\Models\Customer_Invoice;
use App\Models\Supplier_Invoice;

if (!function_exists('__get_invoice_data')) {
    function __get_invoice_data($id,$type){
        if ($type==='Customer') {
            $invoice_count=Customer_Invoice::where('customer_id',$id)->count();
            $total_paid_amount=Customer_Invoice::where('customer_id',$id)->sum('paid_amount');
            $total_due_amount=Customer_Invoice::where('customer_id',$id)->sum('due_amount');
            $invoices = Customer_Invoice::where('customer_id', $id)->get();
        }elseif($type='Supplier'){
            $invoice_count=Supplier_Invoice::where('supplier_id',$id)->count();
            $total_paid_amount=Supplier_Invoice::where('supplier_id',$id)->sum('paid_amount');
            $total_due_amount=Supplier_Invoice::where('supplier_id',$id)->sum('due_amount');
            $invoices = Supplier_Invoice::where('supplier_id', $id)->get();
        }else{
            $invoice_count=0; 
            $total_paid_amount=0; 
            $total_due_amount=0; 
            $invoices=[]; 
        }
        return compact('invoice_count','total_paid_amount','total_due_amount','invoices');
    }
}