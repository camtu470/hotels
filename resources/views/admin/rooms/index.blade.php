@extends('admin.layouts.app')
@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">PHÒNG</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <div class="flex flex-col gap-2">
        <form method="GET" class="shadow flex flex-col p-4 gap-4  bg-white border border-gray-300 rounded-lg">
            <div class="flex gap-2">
                <div class="w-1/4 flex flex-col gap-2">
                    <label class="block text-[#a9141e] text-sm font-semibold">Khách sạn</label>
                    <select name="hotel_id" class="form-select p-2 rounded">
                        <option value="">Tất cả</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ request('hotel_id') == $hotel->id ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/4 flex flex-col gap-2">
                    <label class="block text-sm text-[#a9141e] font-semibold">Lầu</label>
                    <select name="floor_id" class="form-select p-2 rounded">
                        <option value="">Tất cả</option>
                        @foreach($floors as $floor)
                        <option value="{{ $floor->id }}" {{ request('floor_id') == $floor->id ? 'selected' : '' }}>
                            {{ $floor->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/4 flex flex-col gap-2">
                    <label class="block text-sm text-[#a9141e] font-semibold">Loại phòng</label>
                    <select name="type" class="form-select p-2 text-sm" required>
                        <option selected disabled>Chọn loại phòng</option>
                        <option value="Phòng đơn">Phòng đơn</option>
                        <option value="Phòng đôi">Phòng đôi</option>
                        <option value="Phòng ba">Phòng ba</option>
                        <option value="Phòng gia đình/nhóm">Phòng gia đình/nhóm</option>
                    </select>
                </div>
                <div class="w-1/4 flex flex-col gap-2">
                    <label class="block text-sm text-[#a9141e] font-semibold">Trạng thái</label>
                    <select name="status" class="form-select p-2 rounded">
                        <option value="">Tất cả</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Có sẵn
                        </option>
                        <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Không
                            có
                            sẵn</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex flex-col gap-2">
                    <label class="block text-sm text-[#a9141e]  font-semibold">Lọc theo giá</label>
                    <div class="w-1/2 flex items-center gap-2">
                        <input type="text" id="price_min_view" placeholder="100.000"
                            value="{{ number_format(request('price_min'), 0, ',', '.') }}"
                            class="form-input p-2 rounded border" />
                        <p class="font-bold">-</p>
                        <input type="text" id="price_max_view" placeholder="300.000"
                            value="{{ number_format(request('price_max'), 0, ',', '.') }}"
                            class="form-input p-2 rounded border" />
                        <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min') }}">
                        <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max') }}">
                    </div>
                    <script>
                    function formatCurrency(value) {
                        return value.replace(/\D/g, "") // loại ký tự không phải số
                            .replace(/\B(?=(\d{3})+(?!\d))/g, "."); // chấm mỗi 3 số
                    }

                    function setupCurrencyInput(viewId, realId) {
                        const viewInput = document.getElementById(viewId);
                        const realInput = document.getElementById(realId);

                        viewInput.addEventListener("input", function() {
                            const raw = viewInput.value.replace(/\./g, '');
                            viewInput.value = formatCurrency(raw);
                            realInput.value = raw;
                        });
                    }

                    setupCurrencyInput("price_min_view", "price_min");
                    setupCurrencyInput("price_max_view", "price_max");
                    </script>
                </div>
                <div class="flex gap-2 mt-auto">
                    <div class="">
                        <button type="submit" class="btn btn-filter ">Lọc
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('rooms.index') }}" class="btn btn-save ">Đặt
                            lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a href="{{ route('rooms.create') }}" class="btn btn-save text-lg w-2/12">
            TẠO MỚI</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên khách sạn</th>
                    <th>Lầu</th>
                    <th>Tên phòng</th>
                    <th>Giá một đêm</th>
                    <th>Loại phòng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td>{{ $room->id }}</td>
                    <td class="flex flex-wrap gap-1 max-w-[200px]">
                        @if ($room->cover_image)
                        <img src="{{ $room->cover_image }}" alt="Room Image" class="w-16 h-16 object-cover rounded">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $room->hotel->name }}</td>
                    <td>{{ $room->floor->name }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ number_format($room->price_per_night, 0, ',', '.') }}</td>
                    <td>{{ $room->type }}</td>
                    <td class="text-center">
                        @if ($room->status === 'available')
                        <i class="fa-solid fa-circle-check text-[#05561F] text-xl" title="Có sẵn"></i>
                        @elseif ($room->status === 'unavailable')
                        <i class="fa-solid fa-circle-exclamation text-[#DF2626] text-xl" title="Không có sẵn"></i>
                        @else
                        {{ $room->status }}
                        @endif
                    </td>
                    <td class="">
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-filter" title="Xóa"
                                onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-info" title="Xem chi tiết phòng">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection