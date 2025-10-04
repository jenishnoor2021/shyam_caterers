<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\InquiryMail;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function events()
    {
        return $this->belongsTo(EventType::class, 'event_type');
    }
    
    public static function boot()
    {
        parent::boot();

        static::created(function ($item) {

            $adminEmail = "shyamcatererssurat@gmail.com";
            Mail::to($adminEmail)->send(new InquiryMail($item));
        });
    }
}
