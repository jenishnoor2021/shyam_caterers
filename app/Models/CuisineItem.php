<?php

namespace App\Models;

use App\Models\CuisineCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuisineItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/cusineitems/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function category()
    {
        return $this->belongsTo(CuisineCategory::class, 'cuisine_category_id');
    }
}
