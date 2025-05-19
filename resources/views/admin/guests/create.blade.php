@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">FORM TẠO KHÁCH HÀNG</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('guests.store') }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf

        <div class="flex gap-4">
            <div class="w-1/2">
                <x-input type="text" name="name" label="Tên khách hàng" placeholder="Nhập tên khách hàng"
                    required="true" />
            </div>
            <div class="w-1/2">
                <x-input type="text" name="phone" label="Số điện thoại" placeholder="0876.." required="true" />
            </div>
        </div>

        <div class="flex gap-6">
            <div class="w-1/2">
                <x-input type="email" name="email" label="Email" placeholder="example@gmail.com" required="true" />
            </div>
            <div class="w-1/2">
                <x-input type="text" name="cmnd" label="CMND/CCCD" placeholder="Nhập CMND/CCCD" required="true" />
            </div>
        </div>

        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo
            </button>
            <a href="/admin/guests" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection