<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name',
         'category_image',
         'slug',
         'status',
     ];
}
