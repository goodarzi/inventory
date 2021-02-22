<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             ورود به انبار   
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')

        <form  action="{{ route('inventory_transactions.store') }}" method="POST">

            <!-- CROSS Site Request Forgery Protection -->
            @csrf
            <input type="hidden" name="type" value="addition">

            <div class="form-group">
                <label>SKU</label>
                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value="{{old('sku')}}">
            </div>

            <div class="form-group">
                <label>تعداد</label>
                <input type="integer" class="form-control" name="qty" id="qty" value="{{old('qty')}}">
            </div>

            <div class="form-group">
                <label>انبار</label>
                <select class="form-control" name="stock_id">
                    @foreach ($stocks as $key => $value)
                    <option value="{{ $key }}" {{ old('stock_id') == $key ? 'selected' : '' }}> 
                            {{ $value }} 
                    </option>
                    @endforeach    
                </select>

            </div>

            <div class="form-group">
                <label>کد انبار</label>
                <input type="text" class="form-control @error('inventory_code') is-invalid @enderror" name="inventory_code" id="inventory_code" value="{{old('inventory_code')}}">
            </div>

            <div class="form-group">
                <label>توضیحات</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" value="{{old('description')}}">
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-inventoryview-admin-layout>