<x-inventoryview-admin-layout>
@inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $product->name }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>SKU:</strong>
                    {{ $product->sku }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>موجودی:</strong>
                    {{ $product->qty }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>به روزرسانی:</strong>
                    {{ $Format->persian_date($product->updated_at) }}
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">کد انبار</th>
                        <th scope="col">موجودی</th>
                        <th scope="col">ایجاد</th>
                        <th scope="col">به روزرسانی</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventoryCodes as $data)
                    <tr>
                        <th scope="row">{{ $data->code }}</th>
                        <td>{{ $data->qty }}</td>
                        <td>{{ $Format->persian_date($data->created_at) }}</td>
                        <td>{{ $Format->persian_date($data->updated_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</x-inventoryview-admin-layout>