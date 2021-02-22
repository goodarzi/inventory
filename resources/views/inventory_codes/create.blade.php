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
                <select class="form-control" name="stock_id">
                    @foreach ($stocks as $key => $value)
                    <option value="{{ $key }}" {{ old('stock_id') == $key ? 'selected' : '' }}> 
                            {{ $value }} 
                    </option>
                    @endforeach    
                </select>

            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-inventoryview-admin-layout>