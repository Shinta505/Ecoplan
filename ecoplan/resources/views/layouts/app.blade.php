<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - EcoPlan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-screen w-64 bg-white border-r border-gray-200 z-30 transition-transform duration-300 transform"
               id="sidebar">
            <!-- Logo Section -->
            <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="EcoPlan" class="h-8 w-auto">
                    <span class="text-xl font-semibold text-gray-800">EcoPlan</span>
                </a>
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <i class='bx bx-chevron-left text-2xl'></i>
                </button>
            </div>

            <!-- Navigation Menu -->
            <nav class="px-4 py-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 {{ Request::routeIs('dashboard') ? 'bg-green-50 text-green-600' : '' }}">
                            <i class='bx bxs-dashboard text-xl'></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('profile') }}" 
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 {{ Request::routeIs('profile') ? 'bg-green-50 text-green-600' : '' }}">
                            <i class='bx bx-user text-xl'></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('waste.detect') }}"
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 {{ Request::routeIs('waste.detect') ? 'bg-green-50 text-green-600' : '' }}">
                            <i class='bx bx-camera text-xl'></i>
                            <span>Deteksi Sampah</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('videos') }}"
                           class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-600 {{ Request::routeIs('videos') ? 'bg-green-50 text-green-600' : '' }}">
                            <i class='bx bx-video text-xl'></i>
                            <span>Video Pengolahan</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="fixed bottom-4 w-56">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 w-full">
                                <i class='bx bx-log-out text-xl'></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="lg:ml-64 min-h-screen">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 h-16 fixed top-0 right-0 left-0 lg:left-64 z-20">
                <div class="flex items-center justify-between h-full px-6">
                    <!-- Mobile Menu Button -->
                    <button onclick="toggleSidebar()" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <i class='bx bx-menu text-2xl'></i>
                    </button>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-700">{{ auth()->user()->name }}</span>
                        <img src="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : asset('images/default-avatar.png') }}" 
                             alt="Profile" 
                             class="h-8 w-8 rounded-full object-cover">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-16 px-6 py-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    // Hide sidebar by default on mobile
    if (window.innerWidth < 1024) {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    }
    </script>

    @stack('scripts')
</body>
</html>