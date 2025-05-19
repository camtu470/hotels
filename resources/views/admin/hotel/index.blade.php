@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">KHÁCH SẠN</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    <form method="GET" action="{{ route('hotels.index') }}"
        class="shadow flex flex-col p-4 gap-4  bg-white border border-gray-300 rounded-lg">
        <div class="flex gap-2">
            <div class="w-1/4 flex flex-col gap-2">
                <label class="block text-[#a9141e] text-sm font-semibold">Tìm kiếm theo từ khóa</label>
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm khách sạn..."
                    class="input input-bordered p-2 border rounded" />
            </div>
            <div class="w-1/4 flex flex-col gap-2">
                <label class="block text-sm text-[#a9141e] font-semibold">Chi nhánh</label>
                <select name="branch_id" class="form-select p-2 rounded">
                    <option value="">Tất cả chi nhánh</option>
                    @foreach($branches as $branch)
                    <option class="uppercase" value="{{ $branch->id }}"
                        {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/4 flex flex-col gap-2">
                <label class="block text-sm text-[#a9141e] font-semibold">Năm hoạt động</label>
                <select name="year" class="form-select p-2 text-sm">
                    <option value="">Tất cả năm</option>
                    @foreach($years as $y)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/4 flex gap-2 mt-auto mb-1">
                <div><button type="submit" class="btn btn-filter ">Lọc
                    </button></div>

                <div><button type="button" onclick="window.location.href='{{ route('hotels.index') }}'"
                        class="btn btn-save ">Đặt lại</button></div>

            </div>
        </div>
    </form>

    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a href="{{ route('hotels.create') }}" class="btn btn-save text-lg w-2/12">TẠO MỚI</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên khách sạn</th>
                    <th>Chi nhánh</th>
                    <th>SDT</th>
                    <th>Địa chỉ</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @if($hotels->isEmpty())
                <tr>
                    <td colspan="5" class="text-center text-gray-500">Không tìm thấy khách sạn nào.</td>
                </tr>
                @else
                @foreach($hotels as $hotel)
                <tr>
                    <td class="flex flex-wrap gap-1 max-w-[200px]">
                        @if ($hotel->cover_image)
                        <img src="{{ $hotel->cover_image }}" alt="Hotel Image" class="w-16 h-16 object-cover rounded">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td class="capitalize">{{ $hotel->name }}</td>
                    <td class="uppercase">{{ $hotel->branch->name }}</td>
                    <td>{{ $hotel->phone }}</td>
                    <td class="capitalize">{{ $hotel->address }}</td>
                    <td class="normal-case">{{ $hotel->description }}</td>
                    <td class="">

                        <a href="{{ route('hotels.edit', $hotel->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this hotel?')" title="Xóa" class="btn btn-filter"><i
                                    class="fa-solid fa-trash"></i></button>
                            <a href="{{ route('rooms.edit', $hotel->id) }}" class="btn btn btn-info"><i
                                    class="fa-solid fa-eye" title="Xem chi tiết"></i></a>
                        </form>

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection