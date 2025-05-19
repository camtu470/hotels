@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">CHỈNH SỬA KHUYẾN MÃI</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('promotions.update', $promotion->id) }}"
        class="flex flex-col gap-4 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        @method('PUT')
        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2 text-sm text-[#a9141e] font-bold">
                <label for="code">Code:</label>
                <input type="text" name="code" id="code" value="{{ old('code', $promotion->code) }}"
                    class="form-control p-2">
                @error('code')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-1/3 flex flex-col gap-2 text-sm text-[#a9141e] font-bold">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-select p-2">
                    <option value="active" {{ old('status', $promotion->status) == 'active' ? 'selected' : '' }}>
                        Hoạt động
                    </option>
                    <option value="inactive" {{ old('status', $promotion->status) == 'inactive' ? 'selected' : '' }}>
                        Không hoạt động
                    </option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label>Giá trị</label>
                <input type="text" id="discount_display" class="form-control p-2"
                    value="{{ number_format($promotion->discount_value, 0, ',', '.') }}"
                    oninput="formatAndSyncDiscount(this)">
                <input type="hidden" name="discount_value" id="discount_value" value="{{ $promotion->discount_value }}">
            </div>
            <script>
            function formatAndSyncDiscount(input) {
                let rawValue = input.value.replace(/\D/g, ''); // Lấy chuỗi số thuần
                if (rawValue === '') {
                    document.getElementById('discount_value').value = '';
                    input.value = '';
                    return;
                }
                let formatted = new Intl.NumberFormat('vi-VN').format(rawValue);
                input.value = formatted;
                document.getElementById('discount_value').value = rawValue;
            }
            document.addEventListener('DOMContentLoaded', function() {
                const hiddenInput = document.getElementById('discount_value');
                const displayInput = document.getElementById('discount_display');

                if (hiddenInput && displayInput && hiddenInput.value) {
                    displayInput.value = new Intl.NumberFormat('vi-VN').format(hiddenInput.value);
                }
            });
            </script>
        </div>
        <div class="flex gap-6">
            <div class="w-1/3 flex flex-col gap-2">
                <label>Ngày bắt đầu</label>
                <input class="form-control p-2" type="date" name="start_date" value="{{ $promotion->start_date }}">
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label>Ngày kết thúc</label>
                <input class="form-control p-2" type="date" name="end_date" value="{{ $promotion->end_date }}">
            </div>
        </div>
        <div class="w-full flex flex-col gap-2">
            <label>Mô tả</label>
            <textarea name="description"
                class="form-control p-2">{{ old('description', $promotion->description ?? '') }}</textarea>
        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Lưu</button>
            <a href="/admin/promotions" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>

@endsection