@extends('admin.layouts.app')

@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <div class="w-full flex "> <button onclick="window.history.back()" class="btn btn-back">
            ← Trở về
        </button>
        <div class="w-10/12 flex flex-col gap-2">
            <h2 class="text-2xl font-extrabold text-center text-[#a9141e]"> Chi tiết booking <span
                    class="text-black">#{{ $booking->id }}</span></h2>
            <div class="w-3/12 mx-auto border-1 border-[#a9141e]"></div>
        </div>
    </div>
    <div class="shadow flex flex-col gap-2 p-4 text-sm  bg-white border border-gray-300 rounded-lg">
        <div class="w-full flex items-center py-4">
            <div class="w-3/12 flex items-center gap-2">
                <i class="fa-solid fa-tents text-2xl"></i>
                <h1 class="font-bold text-3xl">TUSTAY</h1>
            </div>
            <h1 class="text-3xl w-6/12  text-center font-bold">HÓA ĐƠN</h1>
            <div class="w-1/12"></div>
            <div class="w-2/12 flex flex-col">
                <p class="">Hóa đơn số: {{ $booking->id }}</p>
                <p>Ngày: {{ $booking->created_at->format('d/m/Y') }}</p>
            </div>
        </div>
        <div class="w-1/2 mx-auto  border"></div>
        <div class="flex gap-4 py-4">
            @php
            $hotel = $booking->rooms->first()->hotel ?? null;
            @endphp
            <div class="w-1/2 flex flex-col gap-2 py-2 text-base">
                <p><strong>Tên khách sạn:</strong class="capitalize"> {{ $hotel?->name ?? 'N/A' }}</p>
                <p><strong>Địa chỉ:</strong class="capitalize"> {{ $hotel?->address ?? 'N/A' }}</p>
                <p><strong>Điện thoại:</strong> {{ $hotel?->phone ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $hotel?->email ?? 'N/A' }}</p>
                <p><strong>Số tài khoản:</strong> 3832987424 tại Ngân hàng BIDV Chi nhánh Hóc Môn</p>
            </div>
            <div class="w-1/2 flex flex-col gap-2 py-2 text-base">
                <p>Họ tên người mua hàng: <strong class="capitalize">{{ $booking->guest_name }}</strong> </p>
                <p>Điện thoại: <strong class="capitalize">{{ $booking->guest_phone }}</strong> </p>
                <p>Email: <strong class="capitalize">{{ $booking->guest_email }}</strong> </p>
                <p>CMND/CCCD: <strong class="capitalize">{{ $booking->guest_id_number }}</strong> </p>
                <p>Hình thức thanh toán: <strong class="capitalize">{{ $booking->payment_method }}</strong> </p>
            </div>
        </div>
        <div class="w-1/2 mx-auto  border"></div>
        <div class="flex flex-col gap-2 py-4">
            <p>Ngày thuê : <strong>{{ $booking->formatted_check_in_date }}</strong> đến
                <strong> {{ $booking->formatted_check_out_date }}</strong>
            </p>
            <table class="table table-bordered w-full border">
                <thead>
                    <tr class="text-center bg-gray-100">
                        <th>STT</th>
                        <th>Tên hàng hóa, dịch vụ</th>
                        <th>Đơn vị tính</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                @php
                $totalRoom = 0;
                $totalService = 0;
                $discount = $booking->promotion->discount_value ?? 0;
                @endphp
                <tbody>
                    {{-- Hiển thị phòng --}}
                    @foreach ($booking->rooms as $index => $room)
                    @php
                    $nights = $room->pivot->nights ?? 1;
                    $roomTotal = $room->pivot->total_price ?? ($room->price_per_night * $nights);
                    $totalRoom += $roomTotal;
                    @endphp
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td class="text-start capitalize">{{ $room->name }}</td>
                        <td>Đêm</td>
                        <td>{{ $nights }}</td>
                        <td>{{ number_format($room->price_per_night) }}đ</td>
                        <td>{{ number_format($roomTotal) }}đ</td>
                    </tr>
                    @endforeach
                    {{-- Hiển thị dịch vụ --}}
                    @foreach ($booking->services as $index => $service)
                    @php
                    $quantity = $service->pivot->quantity ?? 1;
                    $unitPrice = $service->pivot->unit_price ?? $service->price;
                    $serviceTotal = $service->pivot->total_price ?? ($unitPrice * $quantity);
                    $totalService += $serviceTotal;
                    @endphp
                    <tr class="text-center">
                        <td>{{ count($booking->rooms) + $index + 1 }}</td>
                        <td class="text-start capitalize">{{ $service->name }}</td>
                        <td>Lần</td>
                        <td>{{ $quantity }}</td>
                        <td>{{ number_format($unitPrice) }}đ</td>
                        <td>{{ number_format($serviceTotal) }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-right font-semibold">
                        <td colspan="5" class="text-end pr-4">Tổng tiền phòng:</td>
                        <td>{{ number_format($totalRoom) }}đ</td>
                    </tr>
                    <tr class="text-right font-semibold">
                        <td colspan="5" class="text-end pr-4">Tổng tiền dịch vụ:</td>
                        <td>{{ number_format($totalService) }}đ</td>
                    </tr>
                    <tr class="text-right font-semibold text-red-600">
                        <td colspan="5" class="text-end pr-4">Giảm giá:</td>
                        <td>Mã: {{ $booking->promotion?->code ?? '-' }} - {{ number_format($discount) }}đ</td>
                    </tr>
                    <tr class="text-right font-bold bg-gray-100">
                        <td colspan="5" class="text-end pr-4">Tổng thanh toán:</td>
                        <td>{{ number_format($totalRoom + $totalService - $discount) }}đ</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection