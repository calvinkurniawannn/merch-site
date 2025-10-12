<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'slug',
    ];

    public static function generateUniqueSlug()
    {
        do {
            $slug = Str::random(15);
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}