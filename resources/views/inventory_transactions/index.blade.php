<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: right;">
            تراکنش انبار
        </h2>
    </x-slot>
    @inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')

    <div class="container mt-5">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <a class="btn btn-success" href="{{ route('inventory_transactions_addition') }}">ورود انبار </a>
                <a class="btn btn-danger" href="{{ route('inventory_transactions_removal') }}">خروج انبار </a>
            </div>
        </div>
    @include('inventoryview::flash-messages')
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">SKU</th>
                    <th scope="col">نام محصول</th>
                    <th scope="col">ورود/خروج</th>
                    <th scope="col">تعداد</th>
                    <th scope="col">موجودی محصول</th>
                    <th scope="col">موجودی کدانبار</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">کد انبار</th>
                    <th scope="col">کاربر</th>
                    <th scope="col">تاریخ</th>
                    <th scope="col">آخرین ویرایش</th>
                    <th scope="col">ویرایش</th>

                </tr>
            </thead>
            <tbody>
                @foreach($inventoryTransactionData as $data)
                @if ($data->type == 'addition')
                    <tr class="table-success">
                @elseif ($data->type == 'removal')
                    <tr class="table-danger">
                @else
                    <tr>
                @endif
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->sku }}</td>
                    <td>{{ $data->product->name }}</td>
                    <td>{{ $data->type }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ $data->product_qty }}</td>
                    <td>{{ $data->inventory_code_qty }}</td>
                    <td>{{ $data->description }}</td>                        
                    <td>{{ $data->inventory_code }}</td>                        
                    <td>{{ $data->user->name }}</td>                        
                    <td>{{ $Format->persian_date($data->updated_at) }}</td>
                    <td>{{ $Format->persian_date($data->created_at) }}</td>
                    <td>

                        <a href="{{ route('inventory_transactions.edit', $data->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
                {!! $inventoryTransactionData->links() !!}
        </div>
    </div>
</x-inventoryview-admin-layout>