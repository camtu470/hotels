@extends('admin.layouts.app')
@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">FORM THÊM PHÒNG MỚI</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <div class="w-full">
        <form
            class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10"
            method="POST" action="{{ route('rooms.store') }}">
            @csrf
            <div class="flex gap-6">
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="hotel_id">Khách sạn</label>
                    <select name="hotel_id" class="form-select p-2 " aria-label="Default select example">
                        <option selected>Chọn khách sạn</option>
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="floor_id" class=" ">Lầu</label>
                    <select name="floor_id" class="form-select p-2" aria-label="Default select example">
                        <option selected>Chọn lầu</option>
                        @foreach($floors as $floor)
                        <option value="{{ $floor->id }}">{{ $floor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="type" class="">Loại phòng</label>
                    <select name="type" class="form-select p-2" required>
                        <option selected disabled>Chọn loại phòng</option>
                        <option value="Phòng đơn">Phòng đơn</option>
                        <option value="Phòng đôi">Phòng đôi</option>
                        <option value="Phòng ba">Phòng ba</option>
                        <option value="Phòng gia đình/nhóm">Phòng gia đình/nhóm</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-6">
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="name" class="">Tên phòng</label>
                    <input type="text" name="name" placeholder="Phòng 001.." class="form-control p-2 " required>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="price_per_night_display" class="">Giá một đêm</label>
                    <input type="text" id="price_display" placeholder="200.000" class="form-control p-2">
                    <input type="hidden" name="price_per_night" id="price_per_night" required>
                </div>
                <script>
                const priceDisplay = document.getElementById('price_display');
                const priceHidden = document.getElementById('price_per_night');
                priceDisplay.addEventListener('input', function() {
                    let raw = priceDisplay.value.replace(/\D/g, '');
                    if (!raw) {
                        priceHidden.value = '';
                        priceDisplay.value = '';
                        return;
                    }
                    const number = parseInt(raw);
                    priceHidden.value = number;
                    priceDisplay.value = number.toLocaleString(
                        'vi-VN');
                });
                document.querySelector('form').addEventListener('submit', function(e) {
                    if (!priceHidden.value) {
                        e.preventDefault();
                        alert('Vui lòng nhập giá hợp lệ!');
                    }
                });
                </script>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="status" class="">Trạng thái</label>
                    <select name="status" class="form-select p-2" aria-label="Default select example">
                        <option selected>Chọn trạng thái</option>
                        <option value="available">Có sẵn</option>
                        <option value="use">Đang thuê</option>
                        <option value="unavailable">Không có sẵn</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label class="">Hình ảnh phòng (URL)</label>
                <div id="image-inputs" class="flex flex-col gap-2">
                    <div class="flex gap-2 items-center">
                        <input type="text" name="images[]" class="form-control p-2 flex-1"
                            placeholder="https://example.com/image1.jpg">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <button type="button" onclick="addImageInput()" class="w-1/12 text-blue-600 hover:underline">
                    + Thêm
                </button>
            </div>
            <script>
            function addImageInput() {
                const container = document.getElementById('image-inputs');

                const wrapper = document.createElement('div');
                wrapper.className = 'flex gap-2 items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'images[]';
                input.placeholder = 'https://example.com/image.jpg';
                input.className = 'form-control p-2 flex-1';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'text-red-600 hover:underline';
                removeBtn.setAttribute('onclick', 'removeInput(this)');

                // Thêm icon vào button
                const icon = document.createElement('i');
                icon.className = 'fa-solid fa-trash';
                removeBtn.appendChild(icon);

                wrapper.appendChild(input);
                wrapper.appendChild(removeBtn);
                container.appendChild(wrapper);
            }

            function removeInput(button) {
                button.parentElement.remove();
            }
            </script>
            <div class="flex flex-col gap-2">
                <label class="block font-semibold">Tiện ích phòng:</label>
                <div id="amenity-inputs" class="flex flex-col gap-2">
                    <!-- Ô nhập đầu tiên -->
                    <div class="flex gap-2 items-center">
                        <input type="text" name="amenities[]" class="form-control p-2 flex-1" placeholder="Free Wifi..">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeAmenityInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <button type="button" onclick="addAmenityInput()" class="w-1/12 text-blue-600 hover:underline">
                    + Thêm
                </button>
            </div>
            <script>
            function addAmenityInput() {
                const container = document.getElementById('amenity-inputs');
                const wrapper = document.createElement('div');
                wrapper.className = 'flex gap-2 items-center';
                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'amenities[]';
                input.placeholder = 'Hồ bơi';
                input.className = 'form-control p-2 flex-1';
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'text-red-600 hover:underline';
                removeBtn.setAttribute('onclick', 'removeAmenityInput(this)');
                const icon = document.createElement('i');
                icon.className = 'fa-solid fa-trash';
                removeBtn.appendChild(icon);
                wrapper.appendChild(input);
                wrapper.appendChild(removeBtn);
                container.appendChild(wrapper);
            }

            function removeAmenityInput(button) {
                button.parentElement.remove();
            }
            </script>
            <div class=" flex gap-2 ml-auto">
                <button type="submit" class="btn btn-save">Tạo
                </button>
                <a href="/admin/rooms" class="btn btn-back">Trở về</a>
            </div>
        </form>
    </div>
</div>
@endsection