<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

        protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'quantity',
        'store_id',
        'modified_by',
        'modified_date',
        'created_by',
        'created_date',
    ];

    public function Store()
    {
        return $this->belongsTo(Store::class);
    }
}