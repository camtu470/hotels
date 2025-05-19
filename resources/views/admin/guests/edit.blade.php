@extends('admin.layouts.app')
@section('content')
<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">CHỈNH SỬA KHÁCH THUÊ</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('guests.update', $guest->id) }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        @method('PUT')
        <div class="flex gap-4">
            <div class="w-1/2">
                <x-input type="text" name="name" label="Tên khách hàng" :value="$guest->name" required="true" />
            </div>
            <div class="w-1/2">
                <x-input type="text" name="phone" label="Số điện thoại" :value="$guest->phone" required="true" />
            </div>
        </div>

        <div class="flex gap-6">
            <div class="w-1/2">
                <x-input type="email" name="email" label="Email" :value="$guest->email" required="true" />
            </div>
            <div class="w-1/2">
                <x-input type="text" name="cmnd" label="CMND/CCCD" :value="$guest->cmnd" required="true" />
            </div>
        </div>

        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Lưu
            </button>
            <a href="/admin/guests" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection