
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'PMB - Pendaftar' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="max-w-md mx-auto min-h-screen bg-gray-50">

        <!-- CONTENT -->
        <main class="pb-24">
            {{ $slot }}
        </main>

        <!-- Bottom Navigation -->
        <nav class="fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white/95 border-t shadow-xl backdrop-blur-md">
            <div class="flex justify-around py-2">

                <a href="{{ route('pendaftar.dashboard') }}" class="flex flex-col items-center text-gray-700">
                    <span class="text-xl">🏠</span>
                    <span class="text-xs mt-1">Beranda</span>
                </a>

                <a href="#" class="flex flex-col items-center text-gray-700">
                    <span class="text-xl">📄</span>
                    <span class="text-xs mt-1">Status</span>
                </a>

                <a href="#" class="flex flex-col items-center text-gray-700">
                    <span class="text-xl">👤</span>
                    <span class="text-xs mt-1">Akun</span>
                </a>

            </div>
        </nav>

    </div>

</body>
</html>
