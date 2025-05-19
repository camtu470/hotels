@extends('admin.layouts.app')

@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <div class="w-full flex flex-col gap-4">
        <div class="w-full flex flex-col gap-4">
            <div class="w-full flex ">
                <button onclick="window.history.back()" class="btn btn-back">
                    ← Trở về
                </button>
                <div class="w-10/12 flex flex-col gap-2">
                    <h2 class="text-2xl font-extrabold text-center text-[#a9141e]">Sơ đồ phòng theo khách sạn</h2>
                    <div class="w-3/12 mx-auto border-1 border-[#a9141e]"></div>
                </div>
            </div>
            <div class="flex gap-6">
                <form method="GET" action="{{ route('rooms.map') }}"
                    class="w-1/2 shadow text-[#a9141e] text-sm flex flex-col p-3  bg-white border border-gray-300 rounded-lg">
                    <label for="hotel_id" class="block mb-2 font-semibold">Chọn khách sạn:</label>
                    <select name="hotel_id" id="hotel_id" class="form-select p-2 capitalize"
                        onchange="this.form.submit()">
                        <option value="">Chọn khách sạn</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}"
                            {{ (isset($hotelId) && $hotelId == $hotel->id) ? 'selected' : '' }}>
                            {{ $hotel->name }}
                        </option>
                        @endforeach
                    </select>
                </form>
                <div class="w-1/2 mx-auto flex gap-6 bg-white font-bold shadow p-3 rounded">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 bg-[#05561F]"></div>
                        <p>CÒN PHÒNG</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 bg-orange-600"></div>
                        <p>ĐANG SỬ DỤNG</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 bg-[#a9141e]"></div>
                        <p>KHÔNG KHẢ DỤNG</p>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($selectedHotel) && $selectedHotel)
        @if($rooms->count() > 0)
        @php
        $roomsByFloor = $rooms->groupBy('floor_id');
        @endphp

        <div class=" bg-white border border-gray-300 rounded-lg shadow">
            @foreach($roomsByFloor as $floorId => $roomsInFloor)
            <div class="flex p-4 gap-4 border-b-2">
                <div
                    class="w-1/12 border-2 rounded-lg text-xl text-[#a9141e] font-bold uppercase flex items-center justify-center">
                    {{ $roomsInFloor->first()->floor ? $roomsInFloor->first()->floor->name : 'Lầu không xác định' }}
                </div>
                <div class="w-11/12 grid grid-cols-4 gap-4">
                    @foreach($roomsInFloor as $room)
                    <div
                        class="p-3 text-white flex flex-col gap-2 shadow-sm rounded border
        {{ $room->status === 'available' ? 'bg-[#05561F]' : ($room->status === 'unavailable' ? 'bg-[#a9141e]' : 'bg-orange-600') }}">

                        <h3 class="font-semibold text-base capitalize">{{ $room->name }} </h3>
                        <h3 class="capitalize">- {{ ucfirst($room->type) }}</h3>
                        <p class="bg-white mt-1 text-black p-2 rounded">Giá/đêm:
                            <strong>{{ number_format($room->price_per_night, 0, ',', '.') }} VND</strong>
                        </p>
                    </div>
                    @endforeach
                </div>

            </div>
            @endforeach
        </div>
        @else
        <p>Khách sạn chưa có phòng nào.</p>
        @endif
        @else
        <p>Vui lòng chọn một khách sạn để xem danh sách phòng.</p>
        @endif
    </div>
</div>
@endsection