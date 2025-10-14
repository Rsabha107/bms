<?php

namespace App\Http\Controllers\Bbs\Admin;

use App\Exports\BmsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
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

    public function showImportForm() {}


    public function export(Request $request)
    {
        // Validate the request if needed
        Log::info($request->all());

        $filters = $request->only([
            'export_event_filter',        // array
            'export_venue_filter',
            'export_status_filter',
            'export_date_range_filter',
            'export_tag_filter'
        ]);

        Log::info('Filters applied: ' . json_encode($filters));

        return Excel::download(new BmsExport($filters), 'bms_export.xlsx');
    }

    public function import(Request $request) {}
}
