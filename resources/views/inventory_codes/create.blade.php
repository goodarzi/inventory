<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ایجاد کد انبار
        </h2>
    </x-slot>

    <div class="container mt-5">
    @include('inventoryview::flash-messages')

        <form action="{{ route('inventory_codes.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Code</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code">
            </div>

            <div class="form-group">
                <label>Stock Id</label>
                <input type="text" class="form-control @error('stock_id') is-invalid @enderror" name="stock_id"
                    id="stock_id">
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-inventoryview-admin-layout>