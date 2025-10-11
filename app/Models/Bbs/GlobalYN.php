<?php

namespace App\Models\Bbs;

use App\Models\GlobalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalYN extends Model
{
    use HasFactory;
    protected $table="global_yn";
    protected $guarded = [];

}