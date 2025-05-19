<div class="flex flex-col gap-6">
    <h1 class="text-center text-5xl font-bold">PHÒNG DÀNH CHO BẠN</h1>
    <div class="flex gap-3 px-6">
        <div class="w-2/12 border flex flex-col gap-4 p-4 rounded-lg">

            <!-- Xếp hạng sao -->
            <div class="flex flex-col gap-2">
                <p class="font-bold">Xếp hạng sao</p>
                <div class="flex flex-col gap-2">
                    @for ($i = 1; $i <= 5; $i++) <label class="flex items-center gap-2">
                        <input type="checkbox" name="star_rating[]" value="{{ $i }}"
                            class="form-checkbox text-pink-600">
                        {{ $i }} sao
                        </label>
                        @endfor
                </div>
            </div>

            <!-- Lựa chọn thanh toán -->
            <div class="flex flex-col gap-2">
                <p class="font-bold">Lựa chọn thanh toán</p>
                <div class="flex flex-col gap-2">
                    @php
                    $paymentOptions = [
                    'free_cancel' => 'Hủy miễn phí',
                    'pay_at_property' => 'Thanh toán tại nơi ở',
                    'book_now_pay_later' => 'Đặt trước, trả tiền sau',
                    'pay_now' => 'Trả tiền liền',
                    'no_credit_card' => 'Đặt không cần thẻ tín dụng'
                    ];
                    @endphp
                    @foreach($paymentOptions as $key => $label)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="payment_options[]" value="{{ $key }}"
                            class="form-checkbox text-pink-600">
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Loại giường -->
            <div class="flex flex-col gap-2">
                <p class="font-bold">Loại giường</p>
                <div class="flex flex-col gap-2">
                    @php
                    $bedTypes = ['Đôi', 'Giường đôi lớn', 'Giường lớn', 'Đơn / Hai giường đơn', 'Giường tầng'];
                    @endphp
                    @foreach($bedTypes as $type)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="bed_types[]" value="{{ $type }}"
                            class="form-checkbox text-pink-600">
                        {{ $type }}
                    </label>
                    @endforeach
                </div>
            </div>

            <!-- Số lượng phòng ngủ -->
            <div class="flex flex-col gap-2">
                <p class="font-bold">Số lượng phòng ngủ</p>
                <div class="flex flex-col gap-2">
                    @php
                    $bedroomCounts = [
                    1 => '1 phòng ngủ',
                    2 => '2 phòng ngủ',
                    3 => '3+ phòng ngủ'
                    ];
                    @endphp
                    @foreach($bedroomCounts as $value => $label)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="bedroom_count[]" value="{{ $value }}"
                            class="form-checkbox text-pink-600">
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="w-10/12 flex flex-col gap-6">
            <div class="w-full mx-auto flex gap-4 shadow rounded-lg border-y p-4">
                <div class="w-full flex  gap-6">
                    <div class="w-4/12 flex flex-col gap-1">
                        <img src="https://pix8.agoda.net/hotelImages/36643921/753460829/731950d066fa4cb5f3f10be003789c86.jpg?ce=0&s=1024x"
                            alt="" class="w-full h-36 rounded-lg">
                        <div class="w-full flex gap-1 ">
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/a2f6492fb08b4d1dcc81f6d90944b33e.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>

                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/80839e8338eba7f95ff017583f25d785.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/2d194470c624fdf30ae8626db9e5afd2.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/b7ad824a8d4081c67c7f7c8007e5cad3.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>


                        </div>
                    </div>
                    <div class="w-5/12 flex flex-col gap-2 px-2 border-r">
                        <div class="flex flex-col gap-2 border-b p-2">
                            <h1 class="text-lg font-bold">The Sóng Apartment Vũng Tàu - Green House</h1>

                            <div class="flex gap-1 text-sm text-yellow-400">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-gray-500"></i>
                                <p class="text-sm">28, Thi Sach Street, The Song, The Sóng, Thắng Tam, Vũng Tàu, Việt
                                    Nam
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-users text-gray-500"></i>
                                    <div class="flex flex-col gap-1">
                                        <p>4 Người lớn</p>
                                    </div>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-house-flag text-gray-500"></i>
                                    <p>Diện tích: 55m<sup>2</sup></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-wifi text-gray-500"></i>
                                    <p>Miễn phí</p>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-door-open text-gray-500"></i>
                                    <p>2 Phòng ngủ</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-gray-500"></i>
                            <p>Tiện nghi : Máy giặt, Tủ lạnh, Tivi, Ban công, Khóa từ, Thang máy,..</p>
                        </div>
                    </div>

                    <div class="w-3/12 flex flex-col gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="italic font-medium">Giá mỗi đêm chưa gồm thuế và phí</p>
                            <div class="flex gap-2 items-center">
                                <h1 class="text-3xl font-bold text-gray-600 line-through">2.018.605 đ</h1>
                                <p class="text-red-500 text-2xl font-bold">-75%</p>
                            </div>

                            <p class="font-medium text-sm">CHỈ CÒN
                            </p>
                            <p class="text-4xl text-center font-bold text-red-700"> 544.160
                                VND</p>
                            <button
                                class="p-2 w-10/12 mt-2 mx-auto bg-red-700 text-base font-bold text-white rounded-lg">ĐẶT
                                NGAY</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto flex gap-4 shadow rounded-lg border-y p-4">
                <div class="w-full flex  gap-6">
                    <div class="w-4/12 flex flex-col gap-1">
                        <img src="https://pix8.agoda.net/hotelImages/36643921/753460829/731950d066fa4cb5f3f10be003789c86.jpg?ce=0&s=1024x"
                            alt="" class="w-full h-36 rounded-lg">
                        <div class="w-full flex gap-1 ">
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/a2f6492fb08b4d1dcc81f6d90944b33e.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>

                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/80839e8338eba7f95ff017583f25d785.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/2d194470c624fdf30ae8626db9e5afd2.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/b7ad824a8d4081c67c7f7c8007e5cad3.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>


                        </div>
                    </div>
                    <div class="w-5/12 flex flex-col gap-2 px-2 border-r">
                        <div class="flex flex-col gap-2 border-b p-2">
                            <h1 class="text-lg font-bold">The Sóng Apartment Vũng Tàu - Green House</h1>

                            <div class="flex gap-1 text-sm text-yellow-400">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-gray-500"></i>
                                <p class="text-sm">28, Thi Sach Street, The Song, The Sóng, Thắng Tam, Vũng Tàu, Việt
                                    Nam
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-users text-gray-500"></i>
                                    <div class="flex flex-col gap-1">
                                        <p>4 Người lớn</p>
                                    </div>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-house-flag text-gray-500"></i>
                                    <p>Diện tích: 55m<sup>2</sup></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-wifi text-gray-500"></i>
                                    <p>Miễn phí</p>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-door-open text-gray-500"></i>
                                    <p>2 Phòng ngủ</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-gray-500"></i>
                            <p>Tiện nghi : Máy giặt, Tủ lạnh, Tivi, Ban công, Khóa từ, Thang máy,..</p>
                        </div>
                    </div>

                    <div class="w-3/12 flex flex-col gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="italic font-medium">Giá mỗi đêm chưa gồm thuế và phí</p>
                            <div class="flex gap-2 items-center">
                                <h1 class="text-3xl font-bold text-gray-600 line-through">2.018.605 đ</h1>
                                <p class="text-red-500 text-2xl font-bold">-75%</p>
                            </div>

                            <p class="font-medium text-sm">CHỈ CÒN
                            </p>
                            <p class="text-4xl text-center font-bold text-red-700"> 544.160
                                VND</p>
                            <button
                                class="p-2 w-10/12 mt-2 mx-auto bg-red-700 text-base font-bold text-white rounded-lg">ĐẶT
                                NGAY</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto flex gap-4 shadow rounded-lg border-y p-4">
                <div class="w-full flex  gap-6">
                    <div class="w-4/12 flex flex-col gap-1">
                        <img src="https://pix8.agoda.net/hotelImages/36643921/753460829/731950d066fa4cb5f3f10be003789c86.jpg?ce=0&s=1024x"
                            alt="" class="w-full h-36 rounded-lg">
                        <div class="w-full flex gap-1 ">
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/a2f6492fb08b4d1dcc81f6d90944b33e.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>

                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/80839e8338eba7f95ff017583f25d785.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/2d194470c624fdf30ae8626db9e5afd2.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/b7ad824a8d4081c67c7f7c8007e5cad3.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>


                        </div>
                    </div>
                    <div class="w-5/12 flex flex-col gap-2 px-2 border-r">
                        <div class="flex flex-col gap-2 border-b p-2">
                            <h1 class="text-lg font-bold">The Sóng Apartment Vũng Tàu - Green House</h1>

                            <div class="flex gap-1 text-sm text-yellow-400">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-gray-500"></i>
                                <p class="text-sm">28, Thi Sach Street, The Song, The Sóng, Thắng Tam, Vũng Tàu, Việt
                                    Nam
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-users text-gray-500"></i>
                                    <div class="flex flex-col gap-1">
                                        <p>4 Người lớn</p>
                                    </div>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-house-flag text-gray-500"></i>
                                    <p>Diện tích: 55m<sup>2</sup></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-wifi text-gray-500"></i>
                                    <p>Miễn phí</p>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-door-open text-gray-500"></i>
                                    <p>2 Phòng ngủ</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-gray-500"></i>
                            <p>Tiện nghi : Máy giặt, Tủ lạnh, Tivi, Ban công, Khóa từ, Thang máy,..</p>
                        </div>
                    </div>

                    <div class="w-3/12 flex flex-col gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="italic font-medium">Giá mỗi đêm chưa gồm thuế và phí</p>
                            <div class="flex gap-2 items-center">
                                <h1 class="text-3xl font-bold text-gray-600 line-through">2.018.605 đ</h1>
                                <p class="text-red-500 text-2xl font-bold">-75%</p>
                            </div>

                            <p class="font-medium text-sm">CHỈ CÒN
                            </p>
                            <p class="text-4xl text-center font-bold text-red-700"> 544.160
                                VND</p>
                            <button class="btn btn-filter text-base">ĐẶT
                                NGAY</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mx-auto flex gap-4 shadow rounded-lg border-y p-4">
                <div class="w-full flex  gap-6">
                    <div class="w-4/12 flex flex-col gap-1">
                        <img src="https://pix8.agoda.net/hotelImages/36643921/753460829/731950d066fa4cb5f3f10be003789c86.jpg?ce=0&s=1024x"
                            alt="" class="w-full h-36 rounded-lg">
                        <div class="w-full flex gap-1 ">
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/a2f6492fb08b4d1dcc81f6d90944b33e.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>

                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/80839e8338eba7f95ff017583f25d785.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/1006230829/2d194470c624fdf30ae8626db9e5afd2.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>
                            <div class="w-1/4"> <img
                                    src="https://pix8.agoda.net/hotelImages/36643921/-1/b7ad824a8d4081c67c7f7c8007e5cad3.jpg?ce=0&s=1024x"
                                    alt="" class="w-full h-20 object-cover rounded-md">
                            </div>


                        </div>
                    </div>
                    <div class="w-5/12 flex flex-col gap-2 px-2 border-r">
                        <div class="flex flex-col gap-2 border-b p-2">
                            <h1 class="text-lg font-bold">The Sóng Apartment Vũng Tàu - Green House</h1>

                            <div class="flex gap-1 text-sm text-yellow-400">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-location-dot text-gray-500"></i>
                                <p class="text-sm">28, Thi Sach Street, The Song, The Sóng, Thắng Tam, Vũng Tàu, Việt
                                    Nam
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-users text-gray-500"></i>
                                    <div class="flex flex-col gap-1">
                                        <p>4 Người lớn</p>
                                    </div>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-house-flag text-gray-500"></i>
                                    <p>Diện tích: 55m<sup>2</sup></p>
                                </div>
                            </div>
                            <div class="flex">
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-wifi text-gray-500"></i>
                                    <p>Miễn phí</p>
                                </div>
                                <div class="w-1/2 flex items-center gap-2">
                                    <i class="fa-solid fa-door-open text-gray-500"></i>
                                    <p>2 Phòng ngủ</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-gray-500"></i>
                            <p>Tiện nghi : Máy giặt, Tủ lạnh, Tivi, Ban công, Khóa từ, Thang máy,..</p>
                        </div>
                    </div>

                    <div class="w-3/12 flex flex-col gap-2">
                        <div class="flex flex-col gap-2">
                            <p class="italic font-medium">Giá mỗi đêm chưa gồm thuế và phí</p>
                            <div class="flex gap-2 items-center">
                                <h1 class="text-3xl font-bold text-gray-600 line-through">2.018.605 đ</h1>
                                <p class="text-red-500 text-2xl font-bold">-75%</p>
                            </div>

                            <p class="font-medium text-sm">CHỈ CÒN
                            </p>
                            <p class="text-4xl text-center font-bold text-red-700"> 544.160
                                VND</p>
                            <button
                                class="p-2 w-10/12 mt-2 mx-auto bg-red-700 text-base font-bold text-white rounded-lg">ĐẶT
                                NGAY</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn btn-save ml-auto">Xem thêm</div>
        </div>
    </div>

</div>