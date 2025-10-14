<?php

namespace App\Exports;

use App\Models\Mds\DeliveryBooking;
use App\Models\Sps\Profile;
use Carbon\Carbon;
use FontLib\TrueType\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BmsExportx implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $filters;
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // $export_event_filter = (request()->export_event_filter) ? request()->export_event_filter : "";
        // $export_venue_filter = (request()->export_venue_filter) ? request()->export_venue_filter : "";
        // $export_rsp_filter = (request()->export_rsp_filter) ? request()->export_rsp_filter : "";
        // $export_client_group_filter = (request()->export_client_group_filter) ? request()->export_client_group_filter : "";
        // $export_date_range_filter = (request()->export_date_range_filter) ? request()->export_date_range_filter : "";


        $ops = Profile::with('items')->orderBy('created_at', 'desc');

        $startDate = null;
        $endDate = null;

        Log::info('Booking export filters: ' . json_encode($this->filters));

        // ✅ Filter: booking_status_ids
        if (!empty($this->filters['export_status_filter'])) {
            $ops->where('item_status_id', $this->filters['export_status_filter']);
        }

        // ✅ Filter: event_ids
        if (!empty($this->filters['export_event_filter'])) {
            $ops->where('event_id', $this->filters['export_event_filter']);
        }

        // ✅ Filter: venue_ids
        if (!empty($this->filters['export_venue_filter'])) {
            $ops->where('venue_id', $this->filters['export_venue_filter']);
        }

        // ✅ Filter: tag
        if (!empty($this->filters['export_tag_filter'])) {
            $ops->where('tag_id', $this->filters['export_tag_filter']);
        }

        if (!empty($this->filters['export_date_range_filter'])) {
            $dates = explode('to', $this->filters['export_date_range_filter']);
            $startDate = trim($dates[0]);
            if (count($dates) > 1) {
                $endDate = trim($dates[1]);
            } else {
                $endDate = null;
                $endDate = $startDate;
            }

            if ($startDate) {
                $startDate = Carbon::createFromFormat('d/m/y', $startDate)->toDateString();
            }
            if ($endDate) {
                $endDate = Carbon::createFromFormat('d/m/y', $endDate)->toDateString();
            }

            if ($startDate && $endDate) {
                $ops = $ops->whereBetween('booking_date', [$startDate, $endDate]);
            } else if ($startDate) {
                $ops = $ops->where('booking_date', '>=', $startDate);
            } else if ($endDate) {
                $ops = $ops->where('booking_date', '<=', $endDate);
            }
        }

        $ops = $ops->get();

        $exportData = collect();

        // $ops->transform(function ($ops) use ($rows) {

        foreach ($ops as $op) {
            foreach ($op->items as $item) {

                $exportData->push([
                    'ref' => $op->ref_number,
                    'location' => $op->location?->title,
                    'event' => $op->event->name,
                    'venue' => $op->venue->title,
                    'first_name' => $op->first_name,
                    'last_name' => $op->last_name,
                    'phone' => $op->phone,
                    'email' => $op->email_address,
                    'status' => $op->status?->title,
                    'rack_location' => $item->storage_location,
                    'tag' => $item->storage_tag_number,
                    'item' => $item->prohibited_item?->item_name,
                    'description' => $item->item_description,
                    'item_status' => $item->status?->title,
                    'operator_comments' => $item->operator_comments,
                    'time' => $op->created_at ? $op->created_at->format('h:i A') : '',
                    'date' => $op->created_at ? $op->created_at->format('d/m/Y') : '',
                ]);
            }
        }


        // $op->transform(function ($op) {
        //     return [
        //         // 'id' => $op->id,
        //         'ref' => $op->ref_number,
        //         'location' => $op->location?->title,
        //         'event' => $op->event->name,
        //         'venue' => $op->venue->title,
        //         'first_name' => $op->first_name,
        //         'last_name' => $op->last_name,
        //         'phone' => $op->phone,
        //         'email' => $op->email_address,
        //         'status' => $op->status?->title,
        //         'rack_location' => $op->items->storage_location,
        //         'tag' => $op->storage_tag_number,
        //         'item' => $op->prohibited_item?->item_name,
        //         'description' => $op->item_description,
        //         'operator_comments' => $op->operator_comments,
        //         'time' => $op->created_at ? $op->created_at->format('h:i A') : '',
        //         'date' => $op->created_at ? $op->created_at->format('d/m/Y') : '',
        //     ];
        // });


        return $exportData;
    }

    public function headings(): array
    {
        return [
            // '#',
            'REF#',
            'LOCATION',
            'EVENT',
            'VENUE',
            'FIRST NAME',
            'LAST NAME',
            'PHONE',
            'EMAIL',
            'STATUS',
            'RACK LOCATION',
            'TAG',
            'ITEM',
            'DESCRIPTION',
            'ITEM STATUS',
            'OPERATOR COMMENTS',
            'TIME',
            'DATE',
        ];
    }
}
