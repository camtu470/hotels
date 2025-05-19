@extends('admin.layouts.app')
@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">FORM TẠO KHÁCH SẠN</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    <form method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf

        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2">
                <label for="name">Tên khách sạn</label>
                <input type="text" name="name" id="name" placeholder="Nhập tên khách sạn" class="form-control p-2"
                    value="{{ old('name') }}">
                @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col gap-2">
                <label for="branch_id">Khu vực</label>
                <select name="branch_id" id="branch_id" class="form-select p-2 uppercase">
                    @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                    @endforeach
                </select>
                @error('branch_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label for="start">Bắt đầu hoạt động</label>
                <input type="date" name="start" id="start" class="form-control p-2 " value="{{ old('start') }}">
                @error('start')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control p-2"
                    value="{{ old('email') }}">
                @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col gap-2">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" placeholder="0989..." id="phone" class="form-control p-2"
                    value="{{ old('phone') }}">
                @error('phone')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col gap-2">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" placeholder="Địa chỉ" class="form-control p-2"
                    value="{{ old('address') }}">
                @error('address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="w-full flex flex-col gap-2">
            <label for="description">Mô tả</label>
            <textarea name="description" id="description" placeholder="Mô tả về khách sạn..."
                class="textarea textarea-bordered w-full form-control p-2">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror

        </div>
        <!-- Image Field (Optional) -->
        <!-- Multiple Image URLs -->
        <div class="w-full flex flex-col gap-2">
            <label>Hình ảnh</label>
            <div id="image-inputs" class="flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <input type="text" name="images[]" class="form-control p-2"
                        placeholder="https://example.com/image.jpg">
                    <button type="button" class="text-red-600" onclick="removeInput(this)"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <button type="button" onclick="addImageInput()" class="w-1/12 text-blue-600 hover:underline">+
                Thêm</button>

            @error('images')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>


        <script>
        function addImageInput() {
            const container = document.getElementById('image-inputs');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'items-center');
            div.innerHTML = `
        <input type="text" name="images[]" class="form-control p-2" placeholder="https://example.com/image.jpg">
        <button type="button" class="text-red-600" onclick="removeInput(this)"><i class="fa-solid fa-trash"></i></button>
    `;
            container.appendChild(div);
        }
        </script>



        <!-- Amenities -->
        <div class="w-full flex flex-col gap-2">
            <label>Tiện ích khách sạn</label>
            <div id="amenity-inputs" class="flex flex-col gap-2">
                @if(isset($hotel))
                @foreach($hotel->amenities as $amenity)
                <div class="flex gap-2 items-center">
                    <input type="text" name="amenities[]" value="{{ $amenity->name }}" class="form-control p-2">
                    <button type="button" class="text-red-600" onclick="removeInput(this)"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
                @endforeach
                @else
                <div class="flex gap-2 items-center">
                    <input type="text" name="amenities[]" class="form-control p-2" placeholder="Free Wifi..">
                    <button type="button" class="text-red-600" onclick="removeInput(this)"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
                @endif
            </div>
            <button type="button" onclick="addAmenityInput()" class="w-1/12 text-blue-600 hover:underline">+
                Thêm</button>
        </div>


        <script>
        function addAmenityInput() {
            const container = document.getElementById('amenity-inputs');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'items-center');
            div.innerHTML = `
        <input type="text" name="amenities[]" class="form-control p-2" placeholder="Free Wifi..">
        <button type="button" class="text-red-600" onclick="removeInput(this)"><i class="fa-solid fa-trash"></i></button>
    `;
            container.appendChild(div);
        }

        function removeInput(button) {
            const div = button.parentElement;
            div.remove();
        }
        </script>



        <!-- Submit Button -->
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo
            </button>
            <a href="/admin/hotels" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection