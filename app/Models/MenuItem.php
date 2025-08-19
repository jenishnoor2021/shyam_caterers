<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/menuItem/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function Categories()
    {
        return $this->belongsTo(Category::class);
    }
}
