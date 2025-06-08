<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/src/styles.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <script src="https://unpkg.com/tippy.js@6"></script>
  <script src="{{ asset('node_modules/chart.js/dist/chart.umd.js') }}"></script>
  <style>
    .tippy-box {
      background-color: #2B2C32 !important;
      color: #EBEBEB !important;
      border-radius: 6px !important;
      font-size: 14px !important;
      padding: 5px 10px !important;
    }
    .tippy-arrow {
      color: #2B2C32 !important;
    }
  </style>
</head>
<body class="bg-[#05060F] overflow-hidden">
<style>
        ::-webkit-scrollbar {
        width: 5px;
        height: 3px;
        }
        ::-webkit-scrollbar-thumb {
        background: #EBEBEB;
        border-radius: 3px;
        }
        ::-webkit-scrollbar-track {
        background: transparent;
        margin: 15px 0;
        }
</style>
<!-- Sidebar -->
<aside class="fixed top-4 left-4 z-50 w-[70px] h-[calc(100vh-2rem)] transition-all duration-300 transform -translate-x-full bg-[#12131A] rounded-2xl shadow-sm">
    <!-- Sidebar Content -->
    <div class="h-full px-[15px] py-[11px] overflow-y-auto overflow-x-hidden relative">
        <ul class="space-y-4 font-medium">
            <!-- Logo/Brand Button -->
            <li>
                <a href="#" class="layout-toggle flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Toggle Layout">
                    <i class="bi bi-layout-split text-[24px]"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Dashboard">
                    <i class="bi bi-columns-gap text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('schedule') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Schedule">
                    <i class="bi bi-calendar2 text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Schedule</span>
                </a>
            </li>
            <li>
                <a href="{{ route('presence') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Presence">
                    <i class="bi bi-clock-history text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Presence</span>
                </a>
            </li>
            <li>
                <a href="{{ route('students') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Students">
                    <i class="bi bi-people text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Students</span>
                </a>
            </li>
            <li>
                <a href="{{ route('course') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Courses">
                    <i class="bi bi-book text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Courses</span>
                </a>
            </li>
            <li>
                <a href="{{ route('resources') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Resources">
                    <i class="bi bi-archive text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Resources</span>
                </a>
            </li>
        </ul>
        <!-- Bottom Menu -->
        <ul class="space-y-4 font-medium absolute bottom-8 left-4 right-4 transition-all duration-300">
            <li>
                <a href="{{ route('profile') }}" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Profile">
                    <i class="bi bi-person-circle text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Profile</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center p-2 text-[#EBEBEB] rounded-lg hover:bg-[#2B2C32] transform hover:scale-110 transition-transform duration-300" data-tippy-content="Logout">
                    <i class="bi bi-box-arrow-left text-[24px]"></i>
                    <span class="ml-3 font-normal hidden">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<!-- Navbar -->
<nav class="fixed top-4 right-4 left-4 sm:left-[110px] h-[70px] bg-[#12131A] shadow-sm transition-all duration-300 ease-in-out rounded-2xl mb-4">
    <div class="container-fluid h-full">
        <div class="flex items-center justify-between h-full px-6 max-md:px-6 max-sm:px-6">
            <!-- Bagian Kiri -->
            <div class="flex items-center max-md:w-full max-md:h-full max-md:justify-center max-sm:w-full max-sm:h-full max-sm:justify-center">
                <button class="sidebar-toggle p-1 sm:-ml-6 text-[#EBEBEB] hover:bg-[#2B2C32] rounded-lg transform hover:scale-110 transition-transform duration-300" data-tippy-content="Toggle Sidebar">
                    <i class="bi bi-list text-[24px]"></i>
                </button>
            </div>

            <!-- Bagian Tengah -->
            <div class="flex-1 sm:block hidden"></div>

            <!-- Bagian Kanan -->
            <div class="flex items-center space-x-6 sm:block hidden">
                <h2 class="text-xl font-semibold text-[#EBEBEB] transform hover:scale-110 transition-transform duration-300" style="font-family: 'Patua One', cursive; font-size: 20px;">X Academy</h2>
            </div>
        </div>
    </div>
</nav>
<!-- Main Content -->
<main class="ml-[100px] mr-10 mt-28 text-[#EBEBEB]">
    @yield('content')
</main>
<script>
    // Initialize Tippy.js
    tippy('[data-tippy-content]', {
        placement: 'right',
        animation: false,
        theme: 'custom',
        arrow: true,
        delay: 0,
        duration: 0,
        hideOnClick: false,
        trigger: 'mouseenter',
        interactive: false,
        appendTo: document.body,
        onShow(instance) {
            // Hapus semua tooltip yang ada
            document.querySelectorAll('.tippy-box').forEach(tooltip => {
                tooltip.remove();
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stack('scripts')
</body>
</html>
