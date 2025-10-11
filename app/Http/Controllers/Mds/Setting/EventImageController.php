<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Http\Controllers\Controller;
use App\Models\Mds\DriverStatus;
use App\Models\Mds\DeliveryVehicle;
use App\Models\Mds\DeliveryVehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Redirect;

class EventImageController extends Controller
{
    //
    public function getPrivateFile($file)
    {
        $file_path = 'app/private/mds/event/logo/' . $file;
        $path = storage_path($file_path);

        Log::info('path: '.$path);

        return response()->file($path);
    }

}
