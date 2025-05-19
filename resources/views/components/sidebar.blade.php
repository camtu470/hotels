<div x-data="{ collapsed: false }"
    class="h-screen py-4 bg-gray-800 text-white flex flex-col transition-all duration-300">

    <!-- Tựa đề -->
    <div class="px-4 py-2 font-bold text-xl text-center" x-show="!collapsed">
        QUẢN LÝ
    </div>

    <!-- Item -->
    <nav class="flex-1">
        <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
            <i class="fa-solid fa-house-user"></i>
            <span x-show="!collapsed" class="whitespace-nowrap">DASHBOARD</span>
        </a>

        <!-- CƠ SỞ -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 6h16M4 10h16M4 14h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span x-show="!collapsed">CƠ SỞ</span>
                <svg x-show="!collapsed" :class="open ? 'rotate-90' : ''"
                    class="ml-auto h-4 w-4 transform transition-transform" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
            <div x-show="open && !collapsed" x-transition class="ml-8 flex flex-col">
                <a href="/admin/branches" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-code-branch"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">KHU VỰC</span>
                </a>
                <a href="/admin/floors" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-stairs"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">LẦU</span>
                </a>
                <a href="/admin/hotels" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-hotel"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">KHÁCH SẠN</span>
                </a>
                <a href="/admin/rooms" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-door-closed"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">PHÒNG</span>
                </a>
            </div>
        </div>

        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="fa-solid fa-file-invoice"></i>
                <span x-show="!collapsed">BOOKING</span>
                <svg x-show="!collapsed" :class="open ? 'rotate-90' : ''"
                    class="ml-auto h-4 w-4 transform transition-transform" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
            <div x-show="open && !collapsed" x-transition class="ml-8 flex flex-col">
                <a href="/admin/bookings" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">BOOKING PHÒNG</span>
                </a>
                <a href="#" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-receipt"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">BOOKING DV</span>
                </a>
            </div>
        </div>
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                <i class="fa-solid fa-elevator"></i>
                <span x-show="!collapsed">KHÁCH HÀNG</span>
                <svg x-show="!collapsed" :class="open ? 'rotate-90' : ''"
                    class="ml-auto h-4 w-4 transform transition-transform" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                </svg>
            </button>
            <div x-show="open && !collapsed" x-transition class="ml-8 flex flex-col">
                <a href="/admin/guests" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-users-line"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">KHÁCH HÀNG</span>
                </a>
                <a href="#" class="flex items-center gap-2 p-2 hover:bg-gray-700">
                    <i class="fa-solid fa-comments"></i>
                    <span x-show="!collapsed" class="whitespace-nowrap">ĐÁNH GIÁ</span>
                </a>
            </div>
        </div>
        <!-- KHÁCH HÀNG -->
        <a href="/admin/promotions" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
            <i class="fa-solid fa-percent"></i>
            <span x-show="!collapsed">KHUYẾN MÃI</span>
        </a>

        <a href="/admin/services" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
            <i class="fa-solid fa-bell-concierge"></i>
            <span x-show="!collapsed">DỊCH VỤ</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
            <i class="fa-solid fa-chart-simple"></i>
            <span x-show="!collapsed">DOANH THU</span>
        </a>



        <!-- Các mục khác làm tương tự... -->
    </nav>
</div>