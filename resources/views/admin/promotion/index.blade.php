@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-5xl font-extrabold text-center text-[#a9141e]">KHUYẾN MÃI</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="GET" action="{{ route('promotions.index') }}"
        class="flex flex-col gap-4 p-4 shadow text-[#a9141e] text-sm font-semibold bg-white border border-gray-300 rounded-lg">
        <div class="flex gap-2">
            <div class="w-1/4 flex flex-col gap-2">
                <label>Tìm kiếm theo mã code</label>
                <input type="text" name="code" placeholder="Mã khuyến mãi" value="{{ request('code') }}"
                    class="form-control p-2" />
            </div>
            <div class="w-1/4 flex flex-col gap-2">
                <label>Trạng thái</label>
                <select name="status" class="form-select p-2">
                    <option value="">Trạng thái</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động
                    </option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Ngưng hoạt động
                    </option>
                </select>
            </div>
            <div class="w-1/4 flex flex-col gap-2">
                <label>Tìm kiếm theo giá</label>
                <div class="flex items-center gap-2">
                    <div class="relative w-full">
                        <input type="text" id="min_price_display" placeholder="Giá từ"
                            value="{{ number_format(request('min_price'), 0, ',', '.') }}"
                            class="form-control p-2 w-full" oninput="syncFormattedToRaw(this, 'min_price')" />
                        <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price') }}">
                    </div>
                    <p class="font-bold text-black">-</p>
                    <div class="relative w-full">
                        <input type="text" id="max_price_display" placeholder="Giá đến"
                            value="{{ number_format(request('max_price'), 0, ',', '.') }}"
                            class="form-control p-2 w-full" oninput="syncFormattedToRaw(this, 'max_price')" />
                        <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price') }}">
                    </div>
                </div>
            </div>
            <script>
            function syncFormattedToRaw(displayInput, hiddenInputId) {
                const rawValue = displayInput.value.replace(/\D/g, ''); // Chỉ lấy số
                const formatted = new Intl.NumberFormat('vi-VN').format(rawValue);
                displayInput.value = formatted;
                document.getElementById(hiddenInputId).value = rawValue;
            }
            </script>
            <div class="w-1/4 flex gap-2 mt-auto">
                <div><button type="submit" class="btn btn-filter">Lọc</button>
                </div>
                <div> <a href="{{ route('promotions.index') }}" class="btn btn-save">Đặt lại</a>
                </div>
            </div>
        </div>
    </form>
    <div class="flex flex-col gap-4 p-4 shadow bg-white border border-gray-300 rounded-lg">
        <a class="btn btn-save text-lg w-2/12" href="{{ route('promotions.create') }}">TẠO MỚI
        </a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã code</th>
                    <th>Mô tả</th>
                    <th>Giá trị</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($promotions as $promo)
                <tr>
                    <td>{{ $promo->id }}</td>
                    <td>{{ $promo->code }}</td>
                    <td>{{ $promo->description }}</td>
                    <td>{{ number_format($promo->discount_value, 0, ',', '.') }} </td>
                    <td>{{ $promo->start_date }}</td>
                    <td>{{ $promo->end_date }}</td>
                    <td>{{ $promo->status }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('promotions.edit', $promo->id) }}"><i
                                class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                        <form action="{{ route('promotions.destroy', $promo->id) }}" method="POST"
                            style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-filter" title="Xóa"
                                onclick="return confirm('Delete this promotion?')"><i
                                    class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection