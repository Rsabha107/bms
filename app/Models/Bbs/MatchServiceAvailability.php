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

}