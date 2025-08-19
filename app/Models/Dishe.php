<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishe extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/dishe/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }
}
