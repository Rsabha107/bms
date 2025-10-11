<?php

namespace App\Http\Controllers\Mds\Setting;

use App\Exports\BookingSlotExport;
use App\Http\Controllers\Controller;
use App\Imports\BookingSlotImport;
use App\Models\Mds\BookingSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class BookingSlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showImportForm()
    {
        return view('mds.setting.schedule.import');
    }


    public function export()
    {
        return Excel::download(new BookingSlotExport, 'booking_slots.xlsx');
    }

    public function import(Request $request)
    {
        Log::info('BookingSlotController::import');
        Log::info($request->all());

        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Log::info('BookingSlotController::import - file validated');
        Excel::import(new BookingSlotImport, $request->file('import_file'));

        $ws = BookingSlot::where('booking_date', '=', '1970-01-01')->delete();

        return redirect()->route('mds.setting.schedule')->with('success', 'Data imported successfully.');
        // return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
