<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use App\Models\Bbs\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastService extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'broadcast_services';

    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }

    public function service_images()
    {
        return $this->hasMany(ServiceImage::class, 'service_id', 'id');
    }

    // In BroadcastBooking.php
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function menu_item()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }
}
