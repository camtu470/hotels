@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">Create Service</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('services.store') }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        <div class="flex gap-6">
            <div class="w-1/2 flex flex-col gap-2">
                <label>Tên dịch vụ</label>
                <input type="text" name="name" placeholder="Nhập tên dịch vụ" class="form-control p-2">
            </div>

            <div class="w-1/2 flex flex-col gap-2">
                <label>Giá</label>
                <input type="text" id="price_display" placeholder="0" class="form-control p-2" autocomplete="off">
                <input type="hidden" name="price" id="price"
                    value="{{ old('price', isset($room) ? $room->price : '') }}">
            </div>
            <script>
            const priceDisplay = document.getElementById('price_display');
            const priceHidden = document.getElementById('price');
            if (priceHidden.value) {
                priceDisplay.value = Number(priceHidden.value).toLocaleString('vi-VN');
            }

            priceDisplay.addEventListener('input', () => {
                let rawValue = priceDisplay.value.replace(/[^0-9]/g, '');

                if (rawValue === '') {
                    priceHidden.value = '';
                    priceDisplay.value = '';
                    return;
                }
                let numberValue = parseInt(rawValue);
                priceHidden.value = numberValue;
                priceDisplay.value = numberValue.toLocaleString('vi-VN');
            });
            </script>

        </div>
        <div class="w-full flex flex-col gap-2">
            <label>Mô tả</label>
            <textarea name="description" placeholder="Mô tả về dịch vụ" class="form-control p-2"></textarea>
        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo
            </button>
            <a href="/admin/services" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection