<header class="bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-6 py-4 flex items-center justify-between">
        <a href="{{ route('courses.index') }}" class="flex items-center gap-2 text-slate-900 font-semibold">
            <span class="inline-flex items-center justify-center w-8 h-8 bg-indigo-600 text-white rounded-lg text-sm">C</span>
            Cursusbeheer
        </a>

        <nav class="flex items-center gap-2">
            <a href="{{ route('courses.index') }}"
               class="px-3 py-2 text-sm font-medium rounded-lg transition
                      {{ request()->routeIs('courses.index') ? 'bg-slate-100 text-slate-900' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                Home
            </a>
            <a href="{{ route('courses.create') }}"
               class="px-4 py-2 text-sm font-medium rounded-lg transition shadow-sm
                      {{ request()->routeIs('courses.create') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}">
                + Nieuwe cursus
            </a>
        </nav>
    </div>
</header>