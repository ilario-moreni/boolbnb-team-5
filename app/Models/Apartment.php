<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'n_room', 'n_bed', 'n_bathroom', 'mq', 'image', 'latitude', 'longitude'];

    public static function generateSlug($title)
    {

        return Str::slug($title, '-');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }
}
