<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <div :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}" 
                 class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-indigo-600 to-indigo-800 transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col">
                
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between h-16 px-6 border-b border-indigo-700">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-10 h-10 bg-white rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <span class="hidden md:block text-white font-bold text-lg">Lab Manager</span>
                    </a>
                </div>

                <!-- Sidebar Navigation -->
                <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m2-2l6.414-6.414a2 2 0 012.828 0L19 9m-6 4l-6-6m0 0L3 7m6 6v6m6-6v6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- Equipment -->
                    <div x-data="{ equipmentOpen: {{ request()->routeIs('equipment.*') ? 'true' : 'false' }} }">
                        <button @click="equipmentOpen = !equipmentOpen"
                                class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-200 text-indigo-100 hover:bg-indigo-700 hover:text-white">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                                <span>Equipment</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': equipmentOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>

                        <!-- Equipment Submenu -->
                        <div x-show="equipmentOpen" class="mt-2 ml-4 space-y-1">
                            <a href="{{ route('equipment.index') }}"
                               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('equipment.index') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                All Equipment
                            </a>
                            <a href="{{ route('equipment.create') }}"
                               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('equipment.create') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                Add Equipment
                            </a>
                        </div>
                    </div>

                    <!-- Appointments -->
                    <div x-data="{ appointmentsOpen: {{ request()->routeIs('appointments.*') ? 'true' : 'false' }} }">
                        <button @click="appointmentsOpen = !appointmentsOpen"
                                class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-200 text-indigo-100 hover:bg-indigo-700 hover:text-white">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Appointments</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': appointmentsOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>

                        <!-- Appointments Submenu -->
                        <div x-show="appointmentsOpen" class="mt-2 ml-4 space-y-1">
                            <a href="{{ route('appointments.index') }}"
                               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('appointments.index') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                All Appointments
                            </a>
                            <a href="{{ route('appointments.create') }}"
                               class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-colors duration-200 {{ request()->routeIs('appointments.create') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                                <span class="w-2 h-2 rounded-full bg-current"></span>
                                Schedule Appointment
                            </a>
                        </div>
                    </div>

                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-700 text-white' : 'text-indigo-100 hover:bg-indigo-700 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </nav>

                <!-- Sidebar Footer -->
                <div class="px-4 py-4 border-t border-indigo-700">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-indigo-100 hover:bg-indigo-700 hover:text-white rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Overlay (Mobile) -->
            <div @click="sidebarOpen = false" x-show="sidebarOpen" class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"></div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Header -->
                <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div class="flex-1"></div>

                    <!-- User Menu -->
                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-3 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2 rounded-lg transition-colors">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Lab Manager</p>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff" alt="{{ Auth::user()->name }}" class="w-10 h-10 rounded-full">
                        </button>

                        <!-- Dropdown -->
                        <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Header (if provided) -->
                @isset($header)
                    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        {{ $header }}
                    </div>
                @endisset
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto p-6">
                        {{ $slot }}
                    </main>
                
            </div>
        </div>
    </body>
</html>
