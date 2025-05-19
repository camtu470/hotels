@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">CHỈNH SỬA PHÒNG</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <div class="w-full">
        <form
            class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10"
            method="POST" action="{{ route('rooms.update', $room->id) }}">
            @csrf
            @method('PUT')
            <div class="flex gap-6">
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="hotel_id">Khách sạn</label>
                    <select name="hotel_id" class="form-select p-2">
                        @foreach($hotels as $hotel)
                        <option value="{{ $hotel->id }}" @if(old('hotel_id', $room->hotel_id) == $hotel->id)
                            selected @endif>
                            {{ $hotel->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="floor_id">Lầu</label>
                    <select name="floor_id" class="form-select p-2">
                        @foreach($floors as $floor)
                        <option value="{{ $floor->id }}" @if(old('floor_id', $room->floor_id) == $floor->id)
                            selected @endif>
                            {{ $floor->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="type">Loại phòng</label>
                    <select name="type" class="form-select p-2">
                        @foreach(['Phòng đơn', 'Phòng đôi', 'Phòng ba', 'Phòng gia đình/nhóm'] as $type)
                        <option value="{{ $type }}" @if(old('type', $room->type) == $type) selected
                            @endif>{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex gap-6">
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="name">Tên phòng</label>
                    <input type="text" name="name" value="{{ old('name', $room->name) }}" class="form-control p-2"
                        required>
                </div>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="price_display">Giá một đêm</label>
                    <input type="text" id="price_display"
                        value="{{ number_format(old('price_per_night', $room->price_per_night), 0, ',', '.') }}"
                        class="form-control p-2">
                    <input type="hidden" name="price_per_night" id="price_per_night"
                        value="{{ old('price_per_night', $room->price_per_night) }}">
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
                    priceDisplay.value = number.toLocaleString('vi-VN');
                });

                document.querySelector('form').addEventListener('submit', function(e) {
                    if (!priceHidden.value) {
                        e.preventDefault();
                        alert('Vui lòng nhập giá hợp lệ!');
                    }
                });
                </script>
                <div class="w-1/3 flex flex-col gap-2">
                    <label for="status">Trạng thái</label>
                    <select name="status" class="form-select p-2">
                        <option value="available" @if(old('status', $room->status) == 'available') selected
                            @endif>Có sẵn</option>
                        <option value="unavailable" @if(old('status', $room->status) == 'unavailable') selected
                            @endif>Không có sẵn</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-col gap-2">
                <label>Hình ảnh phòng (URL)</label>
                <div id="image-inputs" class="flex flex-col gap-2">
                    @if(isset($room) && $room->images->count() > 0)
                    @foreach($room->images as $index => $image)
                    <div class="flex gap-2 items-center">
                        <input type="text" name="images[]" value="{{ old('images.' . $index, $image->image_url) }}"
                            class="form-control p-2 flex-1" placeholder="Link hình ảnh">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                    @endforeach
                    @else
                    <div class="flex gap-2 items-center">
                        <input type="text" name="images[]" class="form-control p-2 flex-1" placeholder="Link hình ảnh">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                    @endif
                </div>
                <button type="button" onclick="addImageInput()" class="w-1/12 text-blue-600 hover:underline">+
                    Thêm</button>
            </div>
            <div class="flex flex-col gap-2">
                <label class="block font-semibold">Tiện ích phòng:</label>
                <div id="amenity-inputs" class="flex flex-col gap-2">
                    @if(isset($room) && $room->amenities->count() > 0)
                    @foreach($room->amenities as $index => $amenity)
                    <div class="flex gap-2 items-center">
                        <input type="text" name="amenities[]" class="form-control p-2 flex-1"
                            value="{{ old('amenities.' . $index, $amenity->name) }}" placeholder="Tiện ích">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeAmenityInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                    @endforeach
                    @else
                    <div class="flex gap-2 items-center">
                        <input type="text" name="amenities[]" class="form-control p-2 flex-1" placeholder="Tiện ích">
                        <button type="button" class="text-red-600 hover:underline" onclick="removeAmenityInput(this)"><i
                                class="fa-solid fa-trash"></i></button>
                    </div>
                    @endif
                </div>
                <button type="button" onclick="addAmenityInput()" class="w-1/12 text-blue-600 hover:underline">+
                    Thêm</button>
            </div>
            <script>
            function addImageInput() {
                const container = document.getElementById('image-inputs');
                const wrapper = document.createElement('div');
                wrapper.className = 'flex gap-2 items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'images[]';
                input.placeholder = 'Link hình ảnh';
                input.className = 'form-control p-2 flex-1';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'text-red-600 hover:underline';
                removeBtn.setAttribute('onclick', 'removeInput(this)');

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

            function addAmenityInput() {
                const container = document.getElementById('amenity-inputs');
                const wrapper = document.createElement('div');
                wrapper.className = 'flex gap-2 items-center';

                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'amenities[]';
                input.placeholder = 'Tiện ích';
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
            <div class="flex gap-2 ml-auto">
                <button type="submit" class="btn btn-save">Lưu
                </button>
                <a href="/admin/rooms" class="btn btn-back">Trở về</a>
            </div>
        </form>
    </div>
</div>
@endsection