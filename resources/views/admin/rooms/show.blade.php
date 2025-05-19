@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-2 py-10 px-4">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-extrabold text-[#a9141e]">Chi tiết phòng: {{ $room->name }}</h2>
        <a href="#" onclick="event.preventDefault(); history.back();" class="btn btn-back">Trở về</a>
    </div>
    <div class="w-3/12  border-1 border-[#a9141e]"></div>
    <div class="mt-4 shadow flex  gap-2 p-4 text-sm  bg-white border border-gray-300 rounded-lg">
        <div class="w-5/12 flex flex-col">
            <div class="w-full">
                @if($room->images->count())
                <img src="{{ $room->images->first()->image_url }}" alt="Ảnh chính"
                    class="w-full object-cover rounded" />
                @else
                <p>Không có ảnh</p>
                @endif
            </div>
            <div class="flex mt-2 gap-2">
                @foreach($room->images as $image)
                <div class="w-1/4 h-24 bg-pink-200">
                    <img src="{{ $image->image_url }}" alt="Ảnh phụ" class="w-full h-24 rounded bg-cover" />
                </div>
                @endforeach
            </div>
        </div>
        <div class="w-7/12 flex flex-col gap-2 px-4">
            <div class="flex justify-between">
                <p class="text-3xl  font-bold capitalize text-[#a9141e]">
                    {{ $room->hotel->name ?? 'N/A' }}
                </p>
                <p class="p-2 bg-orange-600 text-xl font-bold text-white rounded-md">Giảm sốc 10%</p>
            </div>
            <div class="flex gap-2 text-yellow-500">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
            <p class="capitalize mt-1"><strong>Địa chỉ:</strong> {{ $room->hotel->address ?? 'N/A' }}</p>
            <p class=" capitalize text-2xl font-bold">{{ $room->name }} - {{ $room->floor->name ?? 'N/A' }}</p>
            <div class="flex flex-col gap-2">
                <p><strong>Loại phòng:</strong> {{ ucfirst($room->type) }}</p>
                <p><strong>Các tiện ích phòng:</strong>
                    @if($room->amenities->count())
                    @php
                    $colors = ['bg-red-300', 'bg-blue-300', 'bg-green-300', 'bg-yellow-300', 'bg-purple-300',
                    'bg-pink-300', 'bg-indigo-300', 'bg-teal-300', 'bg-orange-300'];
                    @endphp
                <ul class="w-full flex flex-wrap gap-2">
                    @foreach($room->amenities as $amenity)
                    @php
                    $bg = $colors[array_rand($colors)];
                    @endphp
                    <li class="{{ $bg }} p-2 border rounded-lg">{{ $amenity->name }}</li>
                    @endforeach
                </ul>
                @else
                Không có tiện ích nào.
                @endif
                </p>
            </div>
            @php
            $oldPrice = $room->price_per_night;
            $newPrice = $oldPrice * 1.1;
            @endphp
            <div class="flex flex-col gap-2 py-4">
                <p class=" text-2xl font-bold">
                    Giá cũ: <span class="text-black line-through">
                        {{ number_format($newPrice, 0, ',', '.') }} VNĐ/ĐÊM
                    </span>
                </p>
                <p class="text-4xl font-bold text-[#a9141e]">

                    HIỆN CÒN : {{ number_format($oldPrice, 0, ',', '.') }} VNĐ/ĐÊM
                </p>
            </div>
            <button class="btn btn-save text-xl">ĐẶT NGAY</button>
        </div>
    </div>
</div>
@endsection