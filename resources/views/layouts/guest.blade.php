<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'PMB Poltekgo' }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-[#3B1E54] via-[#2A1642] to-[#1B0E2A] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md mx-auto p-6">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8 shadow-2xl">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
