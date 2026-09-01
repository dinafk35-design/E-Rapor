<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>
    <div class="flex h-screen">

        <x-admin.sidebar />

        <div class="w-full overflow-y-auto">
            <x-admin.topbar />

                <div class="bg-gray-100 p-10 h-full">
                    @yield('content')
                </div>
        </div>
    </div>
    {{-- <div class="main-content bg-green-100">
        <x-admin.topbar></x-admin.topbar>
        <!-- CONTENT -->
        <div class="content">

            @yield('content')

        </div>

    </div> --}}
</body>

</html>
