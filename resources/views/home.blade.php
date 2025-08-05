@extends('layouts.app')

@section('content')

<div class="flex flex-col gap-10">
    <div
        class="relative w-full rounded-b-2xl pb-10 overflow-hidden bg-cover bg-no-repeat bg-[url('https://images.squarespace-cdn.com/content/v1/5aadf482aa49a1d810879b88/1626698419120-J7CH9BPMB2YI728SLFPN/1.jpg')]">
        <div class="absolute inset-0 bg-black/60 z-0"></div>
        <div class="relative z-10 flex flex-col gap-6 pt-[130px] text-white">
            <h1 class="w-8/12 text-center mx-auto uppercase text-6xl font-bold leading-[70px]">
                Lorem ipsum dolor sit amet consectetur adipisicing
            </h1>
            <div class="border-b border-white w-3/12 mx-auto"></div>
            <p class=" w-1/2 mx-auto text-center font-normal text-2xl">Lorem ipsum dolor sit amet consectetur
                adipisicing elit.
                Harum vel
                doloribus
                delectus nemo quisquam.</p>
            <div
                class="w-10/12 p-4 mx-auto flex items-center bg-white shadow border border-gray-400 rounded-lg text-xl text-black">
                <div class="w-4/12 p-2 flex flex-col gap-2">
                    <div class="flex gap-2 items-center">
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Địa điểm</p>
                    </div>
                    <select name="" id="" class="appearance-none p-2 border border-gray-400 rounded">
                        <option value="hưebb">Tên khu vực</option>
                        <option value="hưebb">Tên khu vực</option>
                        <option value="hưebb">Tên khu vực</option>
                        <option value="hưebb">Tên khu vực</option>
                    </select>
                </div>

                <div class="border border-gray-500"></div>

                <div class="w-7/12 p-2 flex flex-col gap-2">

                    <div class="flex gap-2">
                        <div class="w-1/2 flex flex-col gap-2">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-calendar-week"></i>
                                <p>Checkin</p>
                            </div>
                            <input type="date" name="check_in" class="p-2 border border-gray-400 rounded">
                        </div>
                        <div class="border border-gray-500"></div>
                        <div class="w-1/2 flex flex-col gap-2">
                            <div class="flex gap-2 items-center">
                                <i class="fa-solid fa-calendar-week"></i>
                                <p>Checkout</p>
                            </div>
                            <input type="date" name="check_out" class="p-2 border border-gray-400 rounded">
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-2/12 mt-auto mb-[10px] p-2 bg-red-600 text-white rounded hover:bg-red-800">Tìm
                    kiếm</button>
            </div>

        </div>
    </div>
    <x-hotels />
    <x-introduce />
    <x-list-room />
    <x-step />
    <x-new />
</div>
@endsection