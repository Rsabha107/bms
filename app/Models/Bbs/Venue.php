<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'venues';

    public function active_status()
    {
        return $this->belongsTo(GlobalStatus::class, 'active_flag');
    }

    public function matches()
    {
        return $this->hasMany(Matches::class, 'venue_id');
    }
}
