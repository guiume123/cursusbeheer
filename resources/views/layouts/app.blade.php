<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Beheer je cursussen op één plek. Voeg toe, bewerk, activeer of verwijder cursussen.">
    <meta name="theme-color" content="#4f46e5">
    <title>@hasSection('title') @yield('title') · @endif Cursusbeheer</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='8' fill='%234f46e5'/%3E%3Ctext x='16' y='22' text-anchor='middle' font-family='system-ui,-apple-system,sans-serif' font-size='20' font-weight='700' fill='white'%3EC%3C/text%3E%3C/svg%3E">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen text-slate-900 antialiased">

    @include('partials.header')

    @if (session('status'))
        <div class="max-w-4xl mx-auto mt-6 px-6">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg flex items-center gap-2">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main class="max-w-4xl mx-auto px-6 py-10">
        @yield('content')
    </main>
    <footer class="border-t border-slate-200 mt-16 bg-white">
    <div class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2 text-slate-900 font-semibold">
                <span class="inline-flex items-center justify-center w-7 h-7 bg-indigo-600 text-white rounded-lg text-xs">C</span>
                Cursusbeheer
            </div>
            <div class="flex items-center gap-4 text-sm text-slate-500">
                <a href="{{ route('courses.index') }}" class="hover:text-slate-900 transition">Home</a>
                <a href="{{ route('courses.create') }}" class="hover:text-slate-900 transition">Nieuwe cursus</a>
            </div>
        </div>
        <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
            <p>© {{ date('Y') }} Cursusbeheer. Belgisch verenigingsleven, één cursus per keer.</p>
            <p class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.42 13.62c-.31.41-.84.62-1.42.62s-1.11-.21-1.42-.62L8.7 12.5c-.31-.41-.31-1.09 0-1.5.31-.41.84-.62 1.42-.62s1.11.21 1.42.62l.88 1.12c.31.41.31 1.09 0 1.5z"/>
                </svg>
                Built with Laravel {{ app()->version() }}
            </p>
        </div>
    </div>
</footer>

</body>
</html>