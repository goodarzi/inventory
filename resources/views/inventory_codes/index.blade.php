<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: right;">
            کد انبار
        </h2>
    </x-slot>
    @inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')

    <div class="container mt-5">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <a class="btn btn-warning" href="{{ route('inventory_codes.export') }}">Export Inventory Codes</a>
                <a class="btn btn-success" href="{{ route('inventory_codes.create') }}">کد انبار جدید</a>
            </div>
        </div>
    @include('inventoryview::flash-messages')

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">کد انبار</th>
                    <th scope="col">موجودی</th>
                    <th scope="col">SKU</th>
                    <th scope="col">محل انبار</th>
                    <th scope="col"> به‌روزرسانی</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">بارکد</th>
                    <th scope="col">ویرایش</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventoryCodeData as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->code }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ $data->sku }}</td>
                    <td>{{ $data->stock->name }}</td>
                    <td>{{ $Format->persian_date($data->updated_at) }}</td>
                    <td>{{ $Format->persian_date($data->created_at) }}</td>
                    <td>
<div id="print-content-{{ $data->id }}">

<?php //echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($data->code, "C128",2,60,array(1,1,1), true) . '"   />'; ?>
<?php //echo DNS1D::getBarcodeSVG($data->code, 'C128',1,75); ?>
</div>
<form>

<input type="button" onclick="printDiv('print-content-{{ $data->id }}')" value="print barcode!"/>
</form>


</td>
                    <td>
                        <form action="{{ route('inventory_codes.destroy', $data->id) }}" method="POST">

                            <a href="{{ route('inventory_codes.show', $data->code) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            <a href="{{ route('inventory_codes.edit', $data->id) }}">
                                <i class="fas fa-edit  fa-lg"></i>

                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>

                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
                {!! $inventoryCodeData->links() !!}
        </div>
    </div>
</x-inventoryview-admin-layout>