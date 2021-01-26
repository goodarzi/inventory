<?php

namespace Goodarzi\Inventory\Exports;

use Goodarzi\Inventory\Models\Product;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Product::query();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->sku,
            $product->name,
        ];
    }


    public function headings(): array
    {
        return [
            '#',
            'SKU',
            'Product Name',
        ];
    }

}
