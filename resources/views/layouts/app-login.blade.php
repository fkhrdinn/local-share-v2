<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Icon -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles
        @powerGridStyles

    </head>
    <body class="font-sans antialiased">
        <nav class="bg-black shadow-lg">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between">
                    <div class="flex space-x-7">
                        <div>
                            <a href="{{ route('login') }}" class="flex items-center py-4 px-2">
                                <p class="text-white font-bold pr-5">Powered By :</p>
                                <img src="{{ asset('/img/project_logo.png') }}" alt="Logo" class="h-12 w-18 mr-2 bg-white rounded" />
                            </a>
                        </div>
                    </div>

                    @guest
                    <div class="md:flex items-center space-x-3 py-4">
                        <a
                            href="{{ route('register') }}"
                            class="py-2 px-2 font-medium text-white rounded hover:text-gray-400 transition duration-300"
                            >Sign Up</a
                        >                 
                    </div>
                    @endguest
                </div>
            </div>
            
        </nav>

        <div class="container mx-auto">
            @yield('content')
        </div>

        <footer class="footer bg-gray-800 relative pt-1 border-b-2 border-gray-300">
            <div class="container mx-auto px-6">
                <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center">
                    <div class="sm:w-2/3 text-center py-6">
                        <p class="text-sm text-white font-bold mb-2">
                            © 2021 by Kudin
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        @livewireScripts
        @powerGridScripts
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @yield('scripts')
        <script>

        </script>
    </body>
</html>
