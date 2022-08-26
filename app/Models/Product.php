<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function product_type(){
        return $this->belongsTo(ProductType::class, 'id_productType');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'id_group');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'id_owner');
    }

    public function supply_histories()
    {
        return $this->hasMany(SupplyHistory::class);
    }
}
