<?php

namespace App\Models;

use App\Models\CuisineItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CuisineCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $uploads = '/cusinecategory/';

    public function getFileAttribute($photo)
    {
        return $this->uploads . $photo;
    }

    public function items()
    {
        return $this->hasMany(CuisineItem::class, 'cuisine_category_id');
    }
}
