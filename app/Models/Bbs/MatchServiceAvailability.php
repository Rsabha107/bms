<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchServiceAvailability extends Model
{
    use HasFactory;
    protected $table="match_service_availabilities";
    protected $guarded = [];

    public function match()
    {
        return $this->belongsTo(Matches::class, 'match_id', 'id');
    }
    public function service()
    {
        return $this->belongsTo(BroadcastService::class, 'service_id', 'id');
    }

}