<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             ویرایش کد انبار     
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('inventory_codes.update', $inventoryCode->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ID #:</strong>
                        <label>{{ $inventoryCode->id }}</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Code:</strong>
                        <label>{{ $inventoryCode->code }}</label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Qty:</strong>
                        <input type="text" name="qty" value="{{ $inventoryCode->qty }}" class="form-control" placeholder="Description">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>     

        </div>
    </form>
</x-inventoryview-admin-layout>
