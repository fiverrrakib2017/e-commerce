<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_sub_category extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
        'name',
    ];
    public function category(){
        return $this->belongsTo(Product_Category::class);
    }
}
