@extends('admin.layouts.app')

@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">KHÁCH THUÊ</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a href="{{ route('guests.create') }}" class="btn btn-save text-lg w-2/12">TẠO MỚI</a>

        @if(session('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách thuê</th>
                    <th>SDT</th>
                    <th>Email</th>
                    <th>CMND/CCCD</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests as $guest)
                <tr>
                    <td>{{ $guest->id }}</td>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->phone }}</td>
                    <td>{{ $guest->email }}</td>
                    <td>{{ $guest->cmnd }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('guests.edit', $guest->id) }}"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('guests.destroy', $guest->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this guest?')" title="Xóa" class="btn btn-filter"><i
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