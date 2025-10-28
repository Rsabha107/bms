<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $guarded = [];


    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }

    public function venues()
    {
        return $this->belongsToMany(Venue::class, 'venue_event', 'venue_id', 'event_id');
    }

    public function matches()
    {
        return $this->hasMany(Matches::class, 'event_id');
    }

    public function services()
    {
        return $this->hasMany(BroadcastService::class, 'event_id')->whereNull('service_type');
    }

    public function mmcServices()
    {
        return $this->hasMany(BroadcastService::class, 'event_id')->where('service_type', 'like', 'mmc%');
    }
}
