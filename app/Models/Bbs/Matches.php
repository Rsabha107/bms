<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $table="matches";
    // protected $table="bbs_matches";
    protected $guarded = [];

}