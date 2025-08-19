<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/events/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function getPosterAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function images()
    {
        return $this->hasMany(Gallery::class, 'events_id');
    }
}
