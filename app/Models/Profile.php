<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/profile/';

    public function getImageAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
