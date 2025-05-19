@extends('admin.layouts.app')
@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">FORM TẠO KHUYẾN MÃI</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('promotions.store') }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        <div class="flex gap-6">
            <div class="w-1/3">
                <x-input type="text" name="code" label="Mã code khuyến mãi" placeholder="MXSJN" :value="old('code')" />
            </div>

            <div class="w-1/3">
                <x-select name="status" label="Trạng thái" :options="[
                'active' => 'Hoạt động', 
                'inactive' => 'Không hoạt động'
            ]" :selected="old('status')" />
            </div>
            <div class="w-1/3 flex flex-col gap-2">
                <label>Giá trị</label>
                <input type="text" id="discount_display" placeholder="10.000" class="form-control p-2"
                    oninput="syncFormattedToRaw(this, 'discount_value')" />

                <input type="hidden" name="discount_value" id="discount_value" value="{{ old('discount_value') }}">
            </div>
            <script>
            function syncFormattedToRaw(displayInput, hiddenInputId) {
                const raw = displayInput.value.replace(/\D/g, ''); // Chỉ giữ số
                const formatted = new Intl.NumberFormat('vi-VN').format(raw);

                displayInput.value = formatted;
                document.getElementById(hiddenInputId).value = raw;
            }
            document.addEventListener('DOMContentLoaded', function() {
                const discountInput = document.getElementById('discount_value');
                const displayInput = document.getElementById('discount_display');
                if (discountInput.value) {
                    displayInput.value = new Intl.NumberFormat('vi-VN').format(discountInput.value);
                }
            });
            </script>
        </div>
        <div class="flex gap-4">
            <div class="w-1/3">
                <x-input type="date" name="start_date" label="Ngày bắt đầu" :value="old('start_date')" />
            </div>
            <div class="w-1/3">
                <x-input type="date" name="end_date" label="Ngày kết thúc" :value="old('end_date')" />
            </div>
        </div>

        <div class="w-full flex flex-col gap-2">
            <label>Mô tả</label>
            <textarea name="description" id="description" placeholder="Mô tả về khuyến mãi..."
                class="textarea textarea-bordered w-full form-control p-2"></textarea>
        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo</button>
            <a href="/admin/promotions" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection