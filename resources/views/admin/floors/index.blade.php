@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">LẦU</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a href="{{ route('floors.create') }}" class="btn btn-save text-lg w-2/12">
            TẠO MỚI</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên lầu</th>
                    <!-- <th>Ngày hoạt động</th> -->
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($floors as $floor)
                <tr>
                    <td>{{ $floor->id }}</td>
                    <td class="capitalize">{{ $floor->name }}</td>
                    <!-- <td>{{ $floor->created_at }}</td> -->
                    <td>
                        <a class="btn btn-warning" href="{{ route('floors.edit', $floor->id) }}"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('floors.destroy', $floor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-filter" type="submit" title="Xóa"
                                onclick="return confirm('Delete this floor?')"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection