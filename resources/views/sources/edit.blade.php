<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             ویرایش سورس     
        </h2>
    </x-slot>
    <div class="container mt-5">
    @include('inventoryview::flash-messages')
        <form action="{{ route('sources.update', $source->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>ID #:</strong>
                        <label>{{ $source->id }}</label>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>اسم سورس:</strong>
                        <input type="text" name="name" value="{{ $source->name }}" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>     

        </div>
    </form>
</x-inventoryview-admin-layout>
