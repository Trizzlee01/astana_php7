<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product_type(){
        return $this->belongsTo(ProductType::class);
    }
}
