<!-- <nav class="bg-white border-b border-gray-200 shadow">
    <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between">

        <button class="lg:hidden text-gray-500 focus:outline-none" id="menu-toggle">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <div class="w-full lg:flex lg:items-center lg:w-auto hidden" id="navbar-menu">
            <ul class="flex flex-col lg:flex-row lg:space-x-6 mt-4 lg:mt-0 text-gray-700 font-medium">
                <li><a href="#" class="hover:text-blue-600">TRANG CHỦ</a></li>
                <li><a href="#" class="hover:text-blue-600">VỀ CHÚNG TÔI</a></li>


                <li class="relative group">
                    <button class="flex items-center hover:text-blue-600 focus:outline-none focus:text-blue-600">LOẠI
                        PHÒNG
                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 011.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul
                        class="absolute left-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg hidden group-hover:block z-10">
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">PHÒNG A</a></li>
                        <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">PHÒNG B</a></li>
                    </ul>
                </li>

                <li><a href="#" class="hover:text-blue-600">BÀI VIẾT</a></li>
                <li><a href="#" class="hover:text-blue-600">LIÊN HỆ</a></li>
            </ul>


            <form class="flex items-center mt-4 lg:mt-0 lg:ml-6">
                <input type="search" placeholder="Search"
                    class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:border-blue-400" />
                <button
                    class="px-4 py-2 bg-green-500 text-white rounded-r-md hover:bg-green-600 transition">Search</button>
            </form>


            <ul class="flex flex-col lg:flex-row lg:items-center lg:space-x-4 mt-4 lg:mt-0 lg:ml-6">
                @guest
                @if (Route::has('login'))
                <li><a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">LOGIN</a></li>
                @endif
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600">REGISTER</a></li>
                @endif
                @else
                <li class="relative group">
                    <button class="flex items-center text-gray-700 hover:text-blue-600">
                        {{ Auth::user()->name }}
                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 011.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div
                        class="absolute right-0  w-40 bg-white border border-gray-200 rounded shadow-lg hidden group-hover:block z-10">
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


<script>
document.getElementById('menu-toggle').addEventListener('click', function() {
    const menu = document.getElementById('navbar-menu');
    menu.classList.toggle('hidden');
}); <
</script> -->

<div class="bg-white shadow">

    <div class="flex items-center justify-between py-3 px-6">
        <a href="/" class="w-2/12">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-tents text-xl"></i>
                <h1 class="font-bold text-2xl">TUSTAY</h1>

            </div>
        </a>
        <div class="flex gap-6 items-center font-medium text-base">
            <a href="">VỀ CHÚNG TÔI</a>
            <a href="">LIÊN HỆ</a>
            <div class="border-1 border-gray-400 h-6"></div>
            <ul class="flex">
                @guest
                @if (Route::has('login'))
                <li><a href="{{ route('login') }}" class="py-2 px-6 border border-black rounded-md">LOGIN</a></li>
                @endif
                @if (Route::has('register'))
                <li><a href="{{ route('register') }}" class="py-2 px-6">REGISTER</a></li>
                @endif
                @else
                <li x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    <button class="flex uppercase items-center hover:text-gray-700">
                        {{ Auth::user()->name }}
                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 011.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-32 bg-white border border-gray-200 rounded shadow-lg z-10">
                        <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-300"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-300">Profile</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </li>

                @endguest
            </ul>
        </div>


    </div>

</div>