<?php

namespace Goodarzi\Inventory\Exports;

use Goodarzi\Inventory\Models\InventoryCode;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InventoryCodesExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return InventoryCode::query();
    }

    public function map($inventoryCode): array
    {
        return [
            $inventoryCode->id,
            $inventoryCode->code,
        ];
    }


    public function headings(): array
    {
        return [
            '#',
            'Inventory Code',
        ];
    }

}
