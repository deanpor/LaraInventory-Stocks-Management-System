<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public function Creator(){

        return $this->belongsTo(User::class, 'created_by');
    }

    public function LastUpdatedBy(){

        return $this->belongsTo(User::class, 'updated_by');
    }

    public function DeletedBy(){

        return $this->belongsTo(User::class, 'deleted_by');
    }
}
