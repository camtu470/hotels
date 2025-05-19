@extends('admin.layouts.app')

@section('content')

<div class="w-full flex flex-col gap-4 py-10 px-4">
    <h2 class="text-4xl font-extrabold text-center text-[#a9141e]">CHỈNH SỬA LẦU</h2>
    <div class="w-1/2 mx-auto border-2 border-[#a9141e]"></div>
    <form method="POST" action="{{ route('floors.update', $floor->id) }}"
        class="flex flex-col gap-6 text-sm text-[#a9141e] font-bold shadow bg-white border border-gray-300 rounded-lg p-6 py-10">
        @csrf
        @method('PUT')
        <div class="flex flex-col gap-2">
            <label>Tên lầu</label>
            <input type="text" name="name" class="form-control p-2" value="{{ $floor->name }}">
        </div>
        <div class=" flex gap-2 ml-auto">
            <button type="submit" class="btn btn-save">
                Lưu</button>
            <a href="/admin/floors" class="btn btn-back">Trở về</a>
        </div>
    </form>
</div>
@endsection