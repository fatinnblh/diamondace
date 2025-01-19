<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'paper_size',
        'binding_style',
        'cover_colour',
        'quantity',
        'page_count',
        'base_cost',
        'shipping_option', // Add this line
        'payment_method',  // Add this line
    ];
}