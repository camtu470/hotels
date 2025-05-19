@extends('admin.layouts.app')
@section('content')

<div class="w-full p-6 flex flex-col gap-6">
    <form method="GET" action="{{ route('admin.dashboard') }}" class="max-w-md">
        <label for="hotel_id" class="block mb-2 font-bold text-[#a9141e] text-2xl">KHÁCH SẠN</label>
        <select name="hotel_id" id="hotel_id" class="form-select capitalize p-2" onchange="this.form.submit()">
            <option value="">Chọn khách sạn</option>
            @foreach ($hotels as $hotel)
            <option value="{{ $hotel->id }}" {{ $selectedHotelId == $hotel->id ? 'selected' : '' }}>
                {{ $hotel->name }}
            </option>
            @endforeach
        </select>
    </form>

    @if ($selectedHotelId)
    <div class="w-full flex gap-4">
        <div class="w-1/2 flex flex-col gap-2">
            @if($selectedHotel)

            <div class="w-full flex flex-col gap-2 bg-white border rounded-lg shadow p-6">
                <div class="flex justify-between text-xl font-bold text-[#a9141e]">
                    <div class="flex flex-col gap-2">
                        <h3 class="uppercase">Khu vực :
                            {{ $selectedHotel->branch->name }}

                        </h3>
                        <div class="w-full border-1 border-[#a9141e]"></div>
                    </div>

                    <h3 class="">{{ $totalFloors }} LẦU</h3>
                </div>
                <div class="flex gap-4">
                    <div class="flex flex-col gap-2">
                        <p class="capitalize"><strong>Đ/C :</strong> {{ $selectedHotel->address }}</p>
                        <p class="capitalize"><strong>SDT :</strong> {{ $selectedHotel->phone }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="capitalize"><strong>EMAIL :</strong> {{ $selectedHotel->email }}</p>
                        <p class="capitalize"><strong>HOẠT ĐỘNG :</strong>
                            {{ $selectedHotel->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

            </div>
            @endif


            <div class="flex gap-2">
                <div class="w-1/2 bg-white border rounded-lg shadow p-6 flex flex-col gap-2">
                    <h2 class="text-[#a9141e] text-base text-center font-bold">PHÒNG TRỐNG / TỔNG SỐ</h2>
                    <div class="w-1/2 mx-auto border-1 border-[#a9141e]"></div>
                    <p class="text-2xl text-center font-bold">{{ $availableRooms }} / {{ $totalRooms }}</p>
                    <a href="{{ route('rooms.map', ['hotel_id' => $selectedHotelId]) }}" class="">
                        <div class="mt-2 bg-gray-200 border rounded-lg shadow p-2 text-center text-sm font-bold">Sơ
                            đồ
                            khách
                            sạn
                        </div>
                    </a>
                </div>

                <div class="w-1/2 bg-white border rounded-lg shadow p-6 flex flex-col gap-2">
                    <h2 class="text-[#a9141e] text-base text-center font-bold">BOOKING CHỜ XÁC NHẬN</h2>
                    <div class="w-1/2 mx-auto border-1 border-[#a9141e]"></div>
                    <p class="text-2xl text-center font-bold">{{ $pendingBookings }}</p>
                </div>
            </div>


        </div>

        <div class="w-1/2 bg-white border rounded-lg shadow p-6 flex flex-col gap-6">
            <div class="flex flex-col gap-2">
                <h2 class="text-3xl text-[#a9141e] font-bold text-center">TỔNG DOANH THU</h2>
                <div class="w-1/4 mx-auto border-1 border-[#a9141e]"></div>
            </div>


            <form method="GET" action="{{ route('admin.dashboard') }}" class="  text-[#a9141e] text-sm ">
                <input type="hidden" name="hotel_id" value="{{ $selectedHotelId }}">
                <div class="flex flex-col gap-2">
                    <label for="date_to" class="block font-semibold mb-1">Tìm kiếm theo khoảng thời gian</label>
                    <div class="flex gap-4 ">
                        <div class="flex gap-2 items-center">
                            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                                class="form-control p-2" />
                            <p class="font-bold text-black">-</p>
                            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                                class="form-control p-2" />
                        </div>
                        <div class="flex gap-2">
                            <div> <button type="submit" class="btn btn-filter">Lọc</button>
                            </div>
                            <div> <a href="{{ route('admin.dashboard', ['hotel_id' => $selectedHotelId]) }}"
                                    class="btn btn-save">Đặt lại</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <p class="text-5xl font-bold text-center mt-auto text-green-600 border rounded px-2 py-4 shadow">
                {{ number_format($totalRevenue, 0, ',', '.') }}
                VND
            </p>
        </div>

    </div>
    <div class="bg-white flex flex-col gap-4 border rounded-lg shadow p-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold text-[#a9141e]">DANH SÁCH BOOKING</h2>
            <form method="GET" action="{{ route('admin.dashboard') }}" class="flex gap-4">
                <div class=" flex flex-col gap-2">
                    <label class="block text-[#a9141e] text-sm font-semibold">Tìm kiếm bằng SĐT</label>
                    <input type="hidden" name="hotel_id" value="{{ $selectedHotelId }}">
                    <input type="text" name="search_phone" placeholder="090.."
                        value="{{ old('search_phone', $searchPhone ?? '') }}" class=" form-control p-2" />
                </div>

                <div class="flex gap-2 mt-auto">
                    <div class="">
                        <button type="submit" class="btn btn-filter ">Lọc
                        </button>
                    </div>
                    <div>
                        <a href="{{ route('admin.dashboard', ['hotel_id' => $selectedHotelId]) }}"
                            class="btn btn-save">Đặt lại</a>

                    </div>
                </div>
            </form>
        </div>


        <table class="w-full table-auto border-collapse border">
            <thead class="">
                <tr>
                    <th class="border p-2">#</th>
                    <th class="border p-2">Khách thuê</th>
                    <th class="border p-2">Ngày nhận</th>
                    <th class="border p-2">Ngày trả</th>
                    <th class="border p-2">Phòng</th>
                    <th class="border p-2">Dịch vụ</th>
                    <th class="border p-2">Tổng tiền</th>
                    <th class="border p-2">Trạng thái</th>
                    <th class="border p-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr class="@if ($booking->status === 'pending') bg-yellow-100
                                @elseif ($booking->status === 'confirmed') bg-green-100
                                @elseif ($booking->status === 'cancelled') bg-red-100
                                @endif">
                    <td class="border p-2">{{ $booking->id }}</td>
                    <td class="border p-2 capitalize">
                        {{ $booking->guest_name }}<br>
                        <small>{{ $booking->guest_phone }}</small>
                    </td>
                    <td class="border p-2">{{ $booking->formatted_check_in_date }}</td>
                    <td class="border p-2">{{ $booking->formatted_check_out_date }}</td>
                    <td class="border p-2 capitalize">
                        @foreach ($booking->rooms as $room)
                        <div>- {{ $room->name }}</div>
                        @endforeach
                    </td>
                    <td class="border p-2 capitalize">
                        @foreach ($booking->services as $service)
                        <div>- {{ $service->name }}</div>
                        @endforeach
                    </td>
                    <td class="border p-2">{{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                    <td class="border p-2 uppercase font-semibold">{{ $booking->status }}</td>
                    <td class="border p-2">
                        <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        @if ($booking->status === 'pending')
                        <form method="POST" action="{{ route('bookings.updateStatus', $booking->id) }}"
                            class="inline-block" onsubmit="return confirm('Xác nhận booking này?')">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" class="btn btn-save">✔</button>
                        </form>
                        <form method="POST" action="{{ route('bookings.updateStatus', $booking->id) }}"
                            class="inline-block" onsubmit="return confirm('Hủy booking này?')">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="btn btn-danger">✖</button>
                        </form>
                        @else
                        <span class="text-gray-600">--</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center p-4">Không có booking nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>

    @endif
</div>
@endsection