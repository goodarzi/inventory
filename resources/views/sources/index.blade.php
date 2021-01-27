<x-inventoryview-admin-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="text-align: right;">
            سورس 
        </h2>
    </x-slot>
    @inject('Format', 'Goodarzi\Inventory\Http\Helpers\PersianDate')

    <div class="container mt-5">
        <div class="card bg-light mt-3">
            <div class="card-body">
                <a class="btn btn-success" href="{{ route('sources.create') }}">سورس جدید</a>
            </div>
        </div>
    @include('inventoryview::flash-messages')

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">اسم سورس</th>
                    <th scope="col"> به‌روزرسانی</th>
                    <th scope="col">تاریخ ایجاد</th>
                    <th scope="col">ویرایش</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sourceData as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->name }}</td>
                    <td>{{ $Format->persian_date($data->updated_at) }}</td>
                    <td>{{ $Format->persian_date($data->created_at) }}</td>
                    <td>
                        <form action="{{ route('sources.destroy', $data->id) }}" method="POST">

                            <a href="{{ route('sources.show', $data->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            <a href="{{ route('sources.edit', $data->id) }}">
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
                {!! $sourceData->links() !!}
        </div>
    </div>
</x-inventoryview-admin-layout>