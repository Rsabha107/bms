<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BroadcastBooking extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'broadcast_bookings';


    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {

            DB::transaction(function () use ($model) {
                Log::info('Generating ref_number for Profile');
                // Lock the row for update to prevent race conditions
                $seq = SeqNumGen::lockForUpdate()->firstOrFail();
                Log::info('SeqNumGen fetched: ', ['last_number' => $seq->last_number]);
                $last_number = $seq->last_number + 1;
                $seq->update(['last_number' => $last_number]);

                // $venue = Venue::find($model->venue_id);
                // $location = Location::find($model->location_id);

                // $venue_short_name = $venue->short_name ?? 'VENUE';
                // $location_name = $location->title ?? 'LOCATION';

                $model->ref_number = 'MPBS-' . str_pad($last_number, 10, '0', STR_PAD_LEFT);
            });
        });
    }


    public function service()
    {
        return $this->belongsTo(BroadcastService::class, 'service_id');
    }
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function studio()
    {
        return $this->belongsTo(MmcSpace::class, 'venue_id');
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
