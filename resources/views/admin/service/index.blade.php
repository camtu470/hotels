@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">DỊCH VỤ</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a class="btn btn-save text-lg w-2/12" href="{{ route('services.create') }}">TẠO MỚI
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên dịch vụ</th>
                    <th>Mô tả</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td class="capitalize">{{ $service->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>{{ number_format($service->price, 0, ',', '.') }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('services.edit', $service->id) }}"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form method="POST" action="{{ route('services.destroy', $service->id) }}"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-filter" onclick="return confirm('Delete this service?')"
                                title="Xóa"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection