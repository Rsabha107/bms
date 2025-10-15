<?php

namespace App\Exports;

use App\Models\Bbs\BroadcastBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BmsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'REF_NUMBER',
            'ORGANIZATION_NAME',
            'BROADCASTER',
            'EVENT',
            'VENUE',
            'MATCH',
            'SERVICE',
            'QTY',
            'CREATED AT',
        ];
    }
    public function collection()
    {
        $ops = BroadcastBooking::all();
        $ops->transform(function ($op) {
            return [
                // 'id' => $op->id,
                'ref_number' => $op->ref_number,
                'organization_name' => $op->created_by_user?->organization_name,
                'created_by' => $op->created_by_user?->name,
                'event' => $op->event->name,
                'venue' => $op->venue->title,
                'match' => $op->match->match_code,
                'service' => $op->service->title,
                'qty' => $op->quantity,
                'created_at' => $op->created_at,
            ];
        });
        return $ops;
    }
}
