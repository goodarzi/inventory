<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         محصول جدید
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')
        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>SKU</label>
                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value= "{{ $generatedSku }}">
            </div>

            <div class="form-group">
                <label>نام محصول</label>
                <input style="direction : rtl;" type="text" class="typeahead form-control @error('name') is-invalid @enderror" name="name" id="name" autocomplete="off">
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
    <script type="text/javascript">
        var path = "{{ url('product_autocomplete') }}";
            $('input.typeahead').typeahead({
                source:  function (query, process) {
                return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
                }
            });
    </script>
</x-inventoryview-admin-layout>