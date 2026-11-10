<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'service_id', 'provider_id', 'booking_date', 'status'];

    // 🔗 تفعيل العلاقة الذكية: الحجز ينتمي لخدمة محددة
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function user() {
        
        return $this->belongsTo(User::class);

    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }


}
