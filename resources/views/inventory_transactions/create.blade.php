<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ایجاد تراکنش انبار 
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')

        <form method="POST" action="{{ route('inventory_transactions.store') }}">

            <!-- CROSS Site Request Forgery Protection -->
            @csrf

            <div class="form-group">
                <label>SKU</label>
                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value="{{old('sku')}}">
            </div>

            <div class="form-group">
                <label>Type</label>
                <input type="radio" id="addition" name="type" value="addition" {{ old('type') == "addition" ? 'checked' : '' }}>
                <label for="addition">ورود</label>
                <input type="radio" id="removal" name="type" value="removal" {{ old('type') == "removal" ? 'checked' : '' }}>
                <label for="removal">خروج</label>
            </div>

            <div class="form-group">
                <label>QTY</label>
                <input type="integer" class="form-control" name="qty" id="qty" value="{{old('qty')}}">
            </div>

            <div class="form-group">
                <label>Inventory Code</label>
                <input type="text" class="form-control @error('inventory_code') is-invalid @enderror" name="inventory_code" id="inventory_code" value="{{old('inventory_code')}}">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{old('description')}}">
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-inventoryview-admin-layout>