<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
         انبار جدید
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')
        <form action="{{ route('stocks.store') }}" method="POST">

            @csrf
            <div class="form-group">
                <label>کد سورس</label>
                <select class="form-control" name="source_id">
                    @foreach ($sources as $key => $value)
                        <option value="{{ $key }}" {{ ( $key == old('source_id') ) ? 'selected' : '' }}> 
                            {{ $value }} 
                    </option>
                    @endforeach    
                </select>
            </div>

            <div class="form-group">
                <label>اسم انبار</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
            </div>

            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-inventoryview-admin-layout>