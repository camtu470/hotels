@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">Tạo đơn đặt phòng</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>

    @if ($errors->any())
    <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold">
        @csrf

        <div class="flex gap-6">
            <div class="w-1/2 flex flex-col gap-2 shadow bg-white border border-gray-300 rounded-lg p-4">
                <h1 class=" text-lg">Thông tin khách thuê</h1>
                <div class="w-1/12 border-2 border-[#a9141e]"></div>
                <div class="flex flex-col gap-4 mt-2">
                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <x-input type="text" name="guest_name" label="Họ tên" placeholder="Nhập tên khách thuê"
                                required />
                        </div>

                        <div class="w-1/2">
                            <x-input type="email" name="guest_email" label="Email" placeholder="Nhập email" />
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-1/2">
                            <x-input type="text" name="guest_phone" label="Số điện thoại"
                                placeholder="Nhập số điện thoại" required />
                        </div>

                        <div class="w-1/2">
                            <x-input type="text" name="guest_id_number" label="CMND/CCCD" placeholder="Nhập CMND/CCCD"
                                required />
                        </div>
                    </div>
                </div>

            </div>
            <div class="w-1/2 flex flex-col gap-4 shadow bg-white border border-gray-300 rounded-lg p-4">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center">
                        <div class="w-10/12 flex flex-col gap-2">
                            <h3 class="text-lg">Dịch vụ đi kèm</h3>
                            <div class="w-1/12 border-2 border-[#a9141e]"></div>
                        </div>
                        <h3 class="w-2/12 text-center text-lg">Số lượng</h3>
                    </div>

                    <div class="flex flex-col gap-2">
                        @foreach ($services as $service)
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                class="service-checkbox w-1/12">
                            <span class="capitalize text-sm w-9/12 font-normal text-black">{{ $service->name }}
                                ({{ number_format($service->price, 0, ',', '.') }}đ)</span>
                            <x-input type="number" name="service_quantities[{{ $service->id }}]" placeholder="Số lượng"
                                :value="1" min="1" class="w-2/12 text-sm" />

                        </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="block font-medium">Tổng tiền dịch vụ</label>
                        <input type="text" readonly id="service-total-display"
                            class="form-control p-2 bg-gray-200 font-bold">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 shadow bg-white border border-gray-300 rounded-lg p-4">
            <h3 class="text-lg">Thông tin phòng thuê</h3>
            <div class="w-1/12 border-2 border-[#a9141e]"></div>
            <div class="flex flex-col gap-4">
                <!-- Khách sạn và phòng -->
                <div class="flex gap-4">
                    <div class="w-1/2 flex flex-col gap-2">
                        <label class="block font-bold">Khách sạn</label>
                        <select id="hotel-select" name="hotel_id" class="form-select p-2">
                            <option value="">Chọn khách sạn</option>
                            @foreach ($hotels as $hotel)
                            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="" id="room-list">
                    <!-- Phòng sẽ được hiển thị tại đây -->
                </div>
                <div class="flex gap-2">
                    <div class="w-1/2 flex gap-2">
                        <div class="w-1/2 flex flex-col gap-2">
                            <label class="block font-medium">Ngày nhận phòng</label>
                            <input class="form-control p-2" type="date" name="check_in_date" id="check-in"
                                min="{{ now()->toDateString() }}" required>
                        </div>
                        <div class="w-1/2 flex flex-col gap-2">
                            <label class="block font-medium">Ngày trả phòng</label>
                            <input class="form-control p-2" type="date" name="check_out_date" id="check-out"
                                min="{{ now()->toDateString() }}" required>
                        </div>
                        <script>
                        let blockedDates = [];

                        // Lấy các ngày đã bị đặt cho phòng đã chọn
                        async function fetchBlockedDates(roomId) {
                            if (!roomId) return;
                            try {
                                const res = await fetch(`/admin/bookings/blocked-dates/${roomId}`);
                                blockedDates = await res.json();
                            } catch (e) {
                                console.error("Không lấy được ngày đã đặt:", e);
                            }
                        }

                        // Kiểm tra ngày có bị chặn không
                        function checkDateBlocked(dateStr) {
                            return blockedDates.includes(dateStr);
                        }

                        // Kiểm tra và xử lý khi user chọn ngày
                        function setupDateInputValidation(inputId) {
                            const input = document.getElementById(inputId);
                            input.addEventListener('change', function() {
                                const val = this.value;
                                if (checkDateBlocked(val)) {
                                    alert(
                                        "Ngày này đã được đặt cho phòng đã chọn. Vui lòng chọn ngày khác."
                                    );
                                    this.value = "";
                                }
                            });
                        }

                        // Gắn sự kiện khi user chọn phòng (giả sử select phòng có id="room-select")
                        document.getElementById('room-select')?.addEventListener('change', function() {
                            fetchBlockedDates(this.value);
                        });

                        // Gán kiểm tra ngày cho 2 input
                        setupDateInputValidation('check-in');
                        setupDateInputValidation('check-out');
                        </script>
                    </div>
                    <div class="w-1/2 flex gap-2">
                        <div class="w-2/pl-5 flex flex-col gap-2">
                            <label class="block font-medium">Số đêm</label>
                            <input type="number" id="num-nights" readonly
                                class="form-control font-bold p-2 bg-gray-200">
                        </div>
                        <div class="w-3/5 flex flex-col gap-2 ">
                            <label>Tổng tiền các phòng</label>
                            <input type="text" id="room-total-display" readonly
                                class="form-control p-2 bg-gray-200 font-bold">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-2 shadow bg-white border border-gray-300 rounded-lg p-4">

            <h1 class="text-lg">Thông tin thanh toán</h1>
            <div class="w-1/12 border-2 border-[#a9141e]"></div>
            <!-- Mã khuyến mãi và thanh toán -->
            <div class="flex gap-4 mt-2">
                <div class="w-1/2 flex gap-2">
                    <div class="w-1/2 flex flex-col gap-2">
                        <label class="block font-medium mb-1">Mã khuyến mãi</label>
                        <select name="promotion_code" class="form-control p-2" id="promotion-select">
                            <option value="">Không chọn</option>
                            @foreach ($promotions as $promo)
                            <option value="{{ $promo->code }}" data-discount="{{ $promo->discount_value }}">
                                {{ $promo->code }} - Giảm {{ number_format($promo->discount_value, 0, ',', '.') }}đ
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/2 flex flex-col gap-2">
                        <label class="block font-medium">Phương thức thanh toán</label>
                        <select name="payment_method" class="form-control p-2" required>
                            <option value="cash">Tiền mặt</option>
                            <option value="credit_card">Thẻ tín dụng</option>
                            <option value="bank_transfer">Chuyển khoản</option>
                            <option value="momo">Momo</option>
                            <option value="zalo_pay">Zalo Pay</option>
                        </select>
                    </div>
                </div>
                <div class="w-1/2 flex gap-4">
                    <div class="w-1/2 flex flex-col gap-2">
                        <label class="block font-bold">Tổng thanh toán (Đã giảm giá)</label>
                        <input type="text" id="final-total-display" readonly
                            class="form-control p-2 bg-gray-200 font-semibold">
                    </div>
                    <!-- Tổng thanh toán -->
                    <div class="w-1/2 flex flex-col gap-2">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-select p-2">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                            </option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Đã xác
                                nhận
                            </option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy
                            </option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo
            </button>
            <a href="/admin/bookings" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>

<script>
let nights = 0;
let discount_value = 0; // ✅ Thêm biến toàn cục

function calculateNights() {
    const checkIn = new Date(document.getElementById('check-in').value);
    const checkOut = new Date(document.getElementById('check-out').value);

    if (checkIn && checkOut && checkOut > checkIn) {
        const diffTime = Math.abs(checkOut - checkIn);
        nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    } else {
        nights = 0;
    }

    document.getElementById('num-nights').value = nights;
    updateRoomTotal();
}

function updateRoomTotal() {
    let total = 0;

    document.querySelectorAll('.room-checkbox').forEach((checkbox) => {
        const container = checkbox.closest('.room-item');
        const roomPrice = parseFloat(checkbox.dataset.price || 0);
        const roomTotalInput = container.querySelector('.room-total');

        if (checkbox.checked && nights > 0) {
            const roomTotal = roomPrice * nights;
            roomTotalInput.value = roomTotal.toLocaleString('vi-VN') + ' đ';
            total += roomTotal;
        } else {
            roomTotalInput.value = '';
        }
    });

    document.getElementById('room-total-display').value = total.toLocaleString('vi-VN') + ' đ';
    updateFinalTotal();
}

function updateServiceTotal() {
    let total = 0;

    document.querySelectorAll('.service-checkbox').forEach(checkbox => {
        const container = checkbox.closest('.flex');
        const quantityInput = container.querySelector('input[type="number"]');

        if (checkbox.checked && quantityInput) {
            const quantity = parseInt(quantityInput.value) || 0;
            const labelText = container.querySelector('span').textContent;
            const priceMatch = labelText.match(/([\d.]+)đ/);
            const price = priceMatch ? parseInt(priceMatch[1].replace(/\./g, '')) : 0;

            total += price * quantity;
        }
    });

    document.getElementById('service-total-display').value = total.toLocaleString('vi-VN') + ' đ';
    updateFinalTotal();
}

function updateFinalTotal() {
    const roomTotal = parseInt(document.getElementById('room-total-display').value.replace(/\D/g, '') || 0);
    const serviceTotal = parseInt(document.getElementById('service-total-display').value.replace(/\D/g, '') || 0);
    const finalTotal = roomTotal + serviceTotal - discount_value;

    document.getElementById('final-total-display').value = finalTotal.toLocaleString('vi-VN') + ' đ';
}

// Sự kiện thay đổi ngày
document.getElementById('check-in').addEventListener('change', calculateNights);
document.getElementById('check-out').addEventListener('change', calculateNights);

// Sự kiện chọn khách sạn để tải phòng
document.getElementById('hotel-select').addEventListener('change', function() {
    const hotelId = this.value;
    const container = document.getElementById('room-list');
    container.innerHTML = '';

    if (hotelId) {
        fetch(`/admin/hotels/${hotelId}/rooms`)
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    container.innerHTML = '<p class="text-gray-500">Không có phòng nào.</p>';
                    return;
                }

                data.forEach(room => {
                    const floorName = room.floor?.name || 'Chưa rõ tầng';
                    const roomHtml = `
                        <div class="room-item flex gap-2 items-center mb-2">
                            <div class="w-1/2 flex items-center gap-2">
                                <input type="checkbox" name="room_ids[]" value="${room.id}" class="room-checkbox" data-price="${room.price_per_night}">
                                <span class="text-black capitalize font-normal">${room.name} (${room.type})- (${floorName}) - ${room.price_per_night.toLocaleString('vi-VN')}đ/đêm</span>
                                <input type="hidden" name="room_prices[]" value="${room.price_per_night}">
                            </div>
                            <div class="w-1/2">
                                <input type="text" class="room-total form-control p-2 bg-gray-200" readonly placeholder="Tổng tiền phòng">
                            </div>
                        </div>`;
                    container.insertAdjacentHTML('beforeend', roomHtml);
                });

                document.querySelectorAll('.room-checkbox').forEach(cb => {
                    cb.addEventListener('change', updateRoomTotal);
                });

                updateRoomTotal();
            })
            .catch(error => {
                console.error('Lỗi khi tải phòng:', error);
            });
    }
});

// Sự kiện thay đổi khuyến mãi
document.getElementById('promotion-select').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    discount_value = parseInt(selectedOption.dataset.discount || 0); // ✅ Cập nhật giá trị toàn cục

    updateFinalTotal();
});

// Dịch vụ
document.querySelectorAll('.service-checkbox').forEach(cb => {
    cb.addEventListener('change', updateServiceTotal);
});
document.querySelectorAll('input[name^="service_quantities"]').forEach(input => {
    input.addEventListener('input', updateServiceTotal);
});
</script>

@endsection