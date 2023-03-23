<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['users_id', 'title', 'slug', 'n_room', 'n_bed', 'n_bathroom', 'mq', 'image', 'latitude', 'longitude'];

    public static function generateSlug($title)
    {

        return Str::slug($title, '-');
    }
}
