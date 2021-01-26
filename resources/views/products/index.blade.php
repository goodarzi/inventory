<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            محصولات
        </h2>
    </x-slot>



@inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')

<div class="container mt-5">
        <h2>Search</h2>
        <form action="select.html">
            <select id= "livesearch" class="livesearch form-control" onchange="selectFunction(this);" name="sku"></select>
            <a id="mylink" href="http://google.com">Link</a>
        </form>
</div>

    <div class="container mt-5">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <a class="btn btn-warning" href="{{ route('products.export') }}">Export Products</a>
                <a class="btn btn-success" href="{{ route('products.create') }}">محصول جدید</a>
            </div>
        </div>
    @include('inventoryview::flash-messages')

            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">SKU</th>
                        <th scope="col">نام محصول</th>
                        <th scope="col">موجودی</th>                 
                        <th scope="col"> به‌روزرسانی</th>
                        <th scope="col">تاریخ ایجاد</th>
                        <th scope="col">ویرایش</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productData as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->sku }}</td>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->qty }}</td>
                        <td>{{ $Format->persian_date($data->updated_at) }}</td>
                        <td>{{ $Format->persian_date($data->created_at) }}</td>
                        <td>
                        <form action="{{ route('products.destroy', $data->id) }}" method="POST">

                            <a href="{{ route('products.show', $data->sku) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            <a href="{{ route('products.edit', $data->id) }}">
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
                    {!! $productData->links() !!}
            </div>
        </div>
    <script type="text/javascript">
function selectFunction() {
    var x = document.getElementById("livesearch").value;
    document.getElementById("mylink").innerHTML = x;  
    document.getElementById("mylink").href = "products/" + x;
  
}
        $('#livesearch').select2({
            dir: 'rtl',
            placeholder: 'Select Product',
            ajax: {
                url: '/product_search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.sku,
                                text: item.name+' - '+item.sku+' - ('+item.qty+')'
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
</x-inventoryview-admin-layout>