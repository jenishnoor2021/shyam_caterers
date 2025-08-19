<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/reels/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function getPosterAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
