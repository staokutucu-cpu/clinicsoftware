{{-- Public layout: the common frame (menu + footer) for every public page --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Longevity Lab</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-between">
            <a href="{{ route('home') }}" class="font-bold text-green-700">Longevity Lab</a>
            <div class="space-x-4">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('biomarkers.index') }}">Biomarkers</a>
                @auth
                    <a href="{{ route('dashboard') }}">My area</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <footer class="text-center text-sm text-gray-400 py-8">Longevity Lab &middot; CODE University project</footer>

</body>
</html>
