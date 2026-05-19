<nav class="bg-white border-b border-slate-200">
    <div class="max-w-4xl mx-auto px-6 py-3 flex items-center gap-2">
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
    </div>
</nav>