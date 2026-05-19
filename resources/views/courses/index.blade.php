@extends('layouts.app')

@section('title', 'Overzicht cursussen')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900">Overzicht cursussen</h2>
        <p class="text-slate-500 mt-1">Beheer al je cursussen op één plek</p>
    </div>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">Totaal</p>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500 flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                Actief
            </p>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['active'] }}</p>
        </div>
        <div class="bg-white border border-slate-200 rounded-xl p-5">
            <p class="text-sm text-slate-500">Inactief</p>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['inactive'] }}</p>
        </div>
    </div>

    @if ($courses->isEmpty())
        <div class="bg-white border border-dashed border-slate-300 rounded-xl p-12 text-center">
            <p class="text-slate-500">Er zijn nog geen cursussen.</p>
            <a href="{{ route('courses.create') }}"
               class="inline-block mt-4 px-4 py-2 text-sm font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Eerste cursus toevoegen
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach ($courses as $course)
                <div class="bg-white border border-slate-200 rounded-xl p-6 flex items-start justify-between gap-4 hover:border-indigo-300 hover:bg-indigo-50/30 hover:shadow-md transition">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-semibold text-slate-900">{{ $course->title }}</h3>
                            @if ($course->active)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-emerald-50 text-emerald-700 rounded-md">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Actief
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-slate-100 text-slate-600 rounded-md">
                                    Inactief
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-600">{{ $course->description }}</p>
                        <p class="text-xs text-slate-400 mt-2">Aangemaakt {{ $course->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <form action="{{ route('courses.toggle', $course) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if ($course->active)
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-md transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L21 21M5.636 5.636L3 3"/>
                                    </svg>
                                    Op inactief
                                </button>
                            @else
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-emerald-50 text-emerald-700 hover:bg-emerald-100 rounded-md transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Op actief
                                </button>
                            @endif
                        </form>

                        <a href="{{ route('courses.edit', $course) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-indigo-50 text-indigo-700 hover:bg-indigo-100 rounded-md transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Bewerken
                        </a>

                        <form action="{{ route('courses.destroy', $course) }}" method="POST"
                              onsubmit="return confirm('Weet je zeker dat je deze cursus wil verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 rounded-md transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                </svg>
                                Verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection