<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreOrderCampaign extends Model
{
    use HasFactory;

    public static function generateUniqueSlug()
    {
        do {
            $slug = Str::random(25);
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
