<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $data }}"> 
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @yield('css')
        <!-- Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

        <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.min.css" />
        @livewireStyles
        @powerGridStyles

    </head>
    <body class="font-sans antialiased bg-gray-200 dark:bg-gray-700">
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
            <div @click.away="open = false" class="flex flex-col flex-shrink-0 text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800 shadow-2xl" x-data="{ open: false }">
                <div class="flex flex-row items-center justify-between md:justify-center flex-shrink-0 px-8 py-4">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark:text-white focus:outline-none focus:shadow-outline">
                        <img src="{{ asset('/img/project_logo.png') }}" alt="Logo" class="h-12 w-18 mr-2 bg-transparent rounded" />
                    </a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <i x-show="!open" class="material-icons">&#xe5d2;</i>
                        <i x-show="open" class="material-icons">&#xe5cd;</i>
                    </button>
                </div>
                <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto shadow-2xl">
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/dashboard') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('dashboard') }}">Dashboard</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/product') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('product') }}">Products</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/invoices') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('invoices') }}">Purchases</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/merchants') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('merchants') }}">Merchants</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/voucher') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('voucher') }}">Voucher</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/category') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('category') }}">Product Category</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/faq') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('faq') }}">FAQ</a>
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left rounded-lg dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/user') || request()->is('admin/role') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}">
                            <span>Access Control</span>
                            <i x-show="!open" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"

                            class="material-icons align-middle pb-1">&#xe313;</i>
                            <i x-show="open" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90"
                            x-transition:enter-end="opacity-100 scale-100"

                            class="material-icons align-middle pb-1">&#xe316;</i>
                        </button>
                        <div x-show="open"  
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/user') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('user') }}">Users</a>
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/role') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('role') }}">Roles & Permission</a>
                            </div>
                        </div>
                    </div>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/broadcasts') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('broadcasts') }}">Broadcasts</a>
                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 rounded-lg dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ request()->is('admin/settings') ? 'bg-gray-200 dark:bg-gray-700' : 'bg-transparent dark:bg-transparent' }}" href="{{ route('settings') }}">Settings</a>
                </nav>
            </div>

            <div class="w-full" x-data="{ logout: false }">
                <header class="bg-white shadow-lg dark:bg-gray-900 flex items-center">
                    <div class="ml-0 max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">Administrator</h3>
                    </div>

                    <div class="block">
                        <button @click="logout = !logout" 
                        class="text-gray-400 hover:text-gray-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:hover:text-white" 
                        type="button">{{ Auth::user()->name }}
                        <i x-show="!logout" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="material-icons align-middle pb-1">&#xe313;</i>
                        <i x-show="logout" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="material-icons align-middle pb-1">&#xe316;</i>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="logout"  
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="absolute bg-white text-base divide-y divide-gray-100 w-36 rounded shadow dark:bg-gray-900 dark:divide-gray-600">
                            <div class="px-4 py-3 text-gray-900 dark:text-white break-all">
                                <span class="block text-sm pb-1">{{ Auth::user()->name }}</span>
                                <span class="block text-sm font-bold pb-1">{{ Auth::user()->email }}</span>
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();" 
                                    class="text-sm hover:bg-gray-100 text-gray-700 block px-4 py-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white cursor-pointer">Sign out</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="mx-auto">
                    @include('sweetalert::alert')

                    @yield('content')
                </div>
            </div>
        </div>

        

        @livewireScripts
        @powerGridScripts
        @livewire('livewire-ui-modal')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        @yield('scripts')
        <script src="https://unpkg.com/@themesberg/flowbite@1.3.0/dist/flowbite.bundle.js"></script>

    </body>
</html>
