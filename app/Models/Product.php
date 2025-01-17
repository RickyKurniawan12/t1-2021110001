<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "id",
        'product_name',
        'description',
        'retail_price',
        'wholesale_price',
        'origin',
        'quantity',
        'product_image',
        'avatar',
    ];

    protected $append = [
        'product_image_url',
    ];

    public function getProduct_imageUrlAttribute()
    {
        if(filter_var($this->product_image, FILTER_VALIDATE_URL)){
            return $this->product_image;
        }
            return $this->product_image ? Storage::url($this->product_image) : null;
        
    }
}