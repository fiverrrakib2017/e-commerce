<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Order extends Model
{
    use HasFactory;
    public function orderDetails()
    {
        return $this->hasMany(Product_Order_Details::class, 'invoice_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
