<x-inventoryview-admin-layout>
@inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $inventory_code->code }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('inventory_codes.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>SKU:</strong>
                    <a href="{{ route('products.show', $inventory_code->sku) }}"> {{ $inventory_code->sku }} </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>موجودی:</strong>
                    {{ $inventory_code->qty }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>به روزرسانی:</strong>
                    {{ $Format->persian_date($inventory_code->updated_at) }}
                </div>
            </div>
        </div>
    </div>
</x-inventoryview-admin-layout>