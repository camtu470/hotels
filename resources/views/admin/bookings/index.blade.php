@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">Danh sách đơn đặt phòng</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="GET" action="{{ route('bookings.index') }}"
        class="shadow p-4 text-[#a9141e] font-bold text-sm  bg-white border border-gray-300 rounded-lg">

        <div class="flex gap-4 ">
            <div class="w-1/4">
                <x-select name="status" label="Trạng thái" placeholder="Tất cả" :options="[
            'pending' => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Đã hủy'
        ]" :selected="request('status')" />
            </div>

            <div class="w-1/4">
                <x-input type="text" name="guest_phone" label="SĐT Khách hàng" :value="request('guest_phone')"
                    placeholder="Nhập số điện thoại" />
            </div>

            <div class="w-1/4 flex gap-2 mt-auto mb-1">
                <button type="submit" class="btn btn-filter">
                    Lọc
                </button>
                <a href="{{ route('bookings.index') }}" class="btn btn-save">Đặt lại</a>
            </div>
        </div>
    </form>


    <div class="flex flex-col gap-4 shadow p-4 bg-white border border-gray-300 rounded-lg">
        <a href="{{ route('bookings.create') }}" class="btn btn-save text-lg w-2/12">TẠO MỚI</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Khách thuê</th>
                    <th>Ngày nhận</th>
                    <th>Ngày trả</th>
                    <th>Phòng</th>
                    <th>Dịch vụ</th>

                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr class="
        @if ($booking->status === 'pending') bg-yellow-100
        @elseif ($booking->status === 'confirmed') bg-green-100
        @elseif ($booking->status === 'cancelled') bg-red-100
        @endif
    ">
                    <td>{{ $booking->id }}</td>
                    <td class="capitalize">
                        {{ $booking->guest_name }}<br>
                        <small>{{ $booking->guest_phone }}</small>
                    </td>
                    <td>{{ $booking->formatted_check_in_date }}</td>
                    <td>{{ $booking->formatted_check_out_date }}</td>
                    <td>
                        @foreach ($booking->rooms as $room)
                        <div class="capitalize">- {{ $room->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($booking->services as $service)
                        <div class="capitalize">- {{ $service->name }}</div>
                        @endforeach
                    </td>

                    <td>
                        {{ number_format($booking->total_amount, 0, ',', '.') }}
                    </td>
                    <td class="uppercase font-medium ">
                        {{ $booking->status }}
                    </td>
                    <td>
                        @if ($booking->status === 'confirmed')
                        <span class=" text-green-600 font-semibold">Đã xác nhận</span>
                        @elseif ($booking->status === 'cancelled')
                        <span class="text-red-600 font-semibold">Đã hủy</span>
                        @else
                        <form action="{{ route('bookings.updateStatus', ['booking' => $booking->id]) }}" method="POST"
                            class="inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xác nhận đơn đặt phòng này không?');">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmed" />
                            <button type="submit" class="btn btn-save">
                                <i class="fa-solid fa-square-check"></i>
                            </button>
                        </form>

                        <form action="{{ route('bookings.updateStatus', ['booking' => $booking->id]) }}" method="POST"
                            class="inline"
                            onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn đặt phòng này không?');">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="cancelled" />
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-rectangle-xmark"></i>
                            </button>

                        </form>
                        <a href="{{ route('bookings.show', ['booking' => $booking->id]) }}" class="btn btn-primary"
                            title="Xem chi tiết">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-4 text-center">Không có đơn đặt phòng nào.</td>
                </tr>
                @endforelse
            </tbody>


        </table>
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>

    </div>
</div>

@endsection