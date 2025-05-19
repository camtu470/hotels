@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">
        CHỈNH SỬA KHÁCH SẠN</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    <form method="POST" action="{{ isset($hotel) ? route('hotels.update', $hotel->id) : route('hotels.store') }}"
        class="flex flex-col gap-4 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        @if(isset($hotel)) @method('PUT') @endif

        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2">
                <label>Tên khách sạn</label>
                <input type="text" name="name" class="form-control p-2" value="{{ old('name', $hotel->name ?? '') }}">
            </div>

            <div class="w-1/3 flex flex-col gap-2">
                <label class="block">Chi nhánh</label>
                <select name="branch_id" class="form-select p-2 uppercase">
                    @foreach($branches as $branch)
                    <option value="{{ $branch->id }}"
                        {{ (old('branch_id', $hotel->branch_id ?? '') == $branch->id) ? 'selected' : '' }}>
                        {{ $branch->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone" class="form-control p-2"
                    value="{{ old('phone', $hotel->phone ?? '') }}">
                @error('phone')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

            </div>
        </div>


        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" id="address" class="form-control p-2"
                    value="{{ old('address', $hotel->address ?? '') }}">
                @error('address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control p-2"
                    value="{{ old('email', $hotel->email ?? '') }}">
                @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col gap-2">
                <label>Ngày hoạt động</label>
                <input type="date" name="start" class="form-control p-2"
                    value="{{ old('start', $hotel->start ?? '') }}">
            </div>
        </div>

        <div class="w-full">
            <label>Mô tả</label>
            <textarea name="description"
                class="form-control p-2">{{ old('description', $hotel->description ?? '') }}</textarea>
        </div>



        <div class="w-full flex flex-col gap-2">
            <label>Hình ảnh</label>
            <div id="image-inputs" class="flex flex-col gap-2">
                @if(isset($hotel) && $hotel->images->count() > 0)

                @foreach($hotel->images as $image)
                <div class="flex gap-2 items-center">
                    <input type="text" name="images[]" class="form-control p-2"
                        value="{{ old('images[]', $image->image_url) }}" placeholder="Link hình ảnh">
                    <button type="button" class="text-red-600" onclick="removeImageInput(this)"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
                @endforeach
                @else

                <input type="text" name="images[]" class="form-control p-2" placeholder="Link hình ảnh">
                @endif
            </div>
            <button type="button" onclick="addImageInput()" class="w-1/12 text-blue-600 hover:underline">+
                Thêm
            </button>

            @error('images')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <script>
        function addImageInput() {
            const container = document.getElementById('image-inputs');
            const input = document.createElement('div');
            input.classList.add('flex', 'gap-2', 'items-center');
            input.innerHTML = `
                <input type="text" name="images[]" class="form-control p-2" placeholder="Link hình ảnh">
                <button type="button" class="text-red-600" onclick="removeImageInput(this)"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(input);
        }

        function removeImageInput(button) {
            const inputDiv = button.parentElement;
            inputDiv.remove();
        }
        </script>


        <div class="flex flex-col gap-2">
            <label>Tiện ích</label>
            <div id="amenity-inputs" class="flex flex-col gap-2">
                @if(isset($hotel))
                @foreach($hotel->amenities as $amenity)
                <div class="flex gap-2 items-center">
                    <input type="text" name="amenities[]" value="{{ $amenity->name }}" class="form-control p-2">
                    <button type="button" class="text-red-600" onclick="removeAmenityInput(this)"><i
                            class="fa-solid fa-trash"></i></button>
                </div>
                @endforeach
                @else
                <div class="flex gap-2 items-center">
                    <input type="text" name="amenities[]" class="form-control p-2" placeholder="Free Wifi">
                    <button type="button" class="text-red-600" onclick="removeAmenityInput(this)"><i
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
            const inputDiv = document.createElement('div');
            inputDiv.classList.add('flex', 'gap-2', 'items-center');
            inputDiv.innerHTML = `
            <input type="text" name="amenities[]" class="form-control p-2" placeholder="Tiện ích">
            <button type="button" class="text-red-600" onclick="removeAmenityInput(this)"><i class="fa-solid fa-trash"></i></button>
        `;
            container.appendChild(inputDiv);
        }

        function removeAmenityInput(button) {
            const inputDiv = button.parentElement;
            inputDiv.remove();
        }
        </script>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">
                Lưu
            </button>

            <a href="/admin/hotels" class="btn btn-back">Trở về</a>
        </div>

    </form>
</div>

@endsection