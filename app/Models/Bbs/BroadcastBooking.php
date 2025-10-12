<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BroadcastBooking extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'broadcast_bookings';

    public function service()
    {
        return $this->belongsTo(BroadcastService::class, 'service_id');
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function match()
    {
        return $this->belongsTo(Matches::class, 'match_id');
    }

}
