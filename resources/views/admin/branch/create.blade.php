@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">FORM TẠO KHU VỰC</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('branches.store') }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        <div class="flex flex-col gap-2">
            <label>Tên Khư vực</label>
            <input type="text" name="name" placeholder="Nhập tên khu vực" class="form-control p-2">

        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">Tạo</button>
            <a href="/admin/branches" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection