@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">KHU VỰC</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="GET" action="{{ route('branches.index') }}"
        class="shadow flex flex-col p-4 gap-4  bg-white border border-gray-300 rounded-lg">
        <div class="flex gap-2">
            <div class="w-1/3">
                <x-input type="text" label="Tên khu vực" name="name" :value="request('name')"
                    placeholder="Tìm theo tên" />
            </div>


            <div class="w-1/3">
                <x-select label="Năm hoạt động" name="year"
                    :options="collect($years)->mapWithKeys(fn($y) => [$y => $y])->toArray()" :selected="request('year')"
                    placeholder="Tất cả năm" />
            </div>

            <div class="flex gap-2 mt-auto">
                <div><button type="submit" class="btn btn-filter">Lọc</button>
                </div>
                <div> <a href="{{ route('branches.index') }}" class="btn btn-save">Đặt lại</a>
                </div>
            </div>

        </div>
    </form>
    <div class="flex flex-col gap-4 p-4 shadow bg-white border border-gray-300 rounded-lg">

        <a class="btn btn-save text-lg w-2/12" href="{{ route('branches.create') }}">
            TẠO MỚI</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khu vực</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $branch)
                <tr>
                    <td>{{ $branch->id }}</td>
                    <td class="uppercase">{{ $branch->name }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('branches.edit', $branch->id) }}"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('branches.destroy', $branch->id) }}" method="POST"
                            style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-filter" title="Xóa"
                                onclick="return confirm('Delete this branch?')"><i
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