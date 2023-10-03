<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    public function ProductOf(){

        return $this->belongsTo(Product::class, 'product_id');
    }

    public function ProductSoldTo(){
        return $this->belongsTo(Customer::class, 'sold_to');
    }

    public function Creator(){
        return $this -> belongsTo(User::class, 'created_by');

    }

    public function LastUpdatedBy(){
        return $this -> belongsTo(User::class, 'updated_by');
    }

    public function DeletedBy(){
        return $this -> belongsTo(User::class, 'deleted_by');
    }
}
