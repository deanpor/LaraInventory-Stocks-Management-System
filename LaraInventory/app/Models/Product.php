<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    //protected $with = ['user_id'];

    protected static function boot()
    {
        parent::boot();

        // Handle the "deleting" event to prevent deletion if there are related stocks
        static::deleting(function ($product) {
            if ($product->stocks()->count() > 0) {
                // If there are related stocks, prevent deletion by throwing an exception
                throw new \Exception("Cannot delete the product as there are existing stocks.");
            }
        });
    }
    public function hasStock(){
        return $this->hasMany(Stock::class,'product_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function UpdatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function DeletedBy(){
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function stocks(){
        return $this->hasMany(Stock::class, 'product_id');
    }
}
