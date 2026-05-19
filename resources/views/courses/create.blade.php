@extends('layouts.app')

@section('title', 'Nieuwe cursus')

@section('content')
    <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-900 mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Terug naar overzicht
    </a>

    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-900">Nieuwe cursus</h2>
            <p class="text-slate-500 mt-1">Voeg een nieuwe cursus toe aan het overzicht</p>
        </div>

        <form action="{{ route('courses.store') }}" method="POST"
              class="bg-white border border-slate-200 rounded-xl p-8 space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Titel</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-400 @enderror">
                <p class="text-xs text-slate-400 mt-1">Minimaal 3 karakters</p>
                @error('title')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Beschrijving</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-400 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-lg p-4">
                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" name="active" value="1" {{ old('active') ? 'checked' : '' }}
                           class="mt-0.5 w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                    <span>
                        <span class="block text-sm font-medium text-slate-700">Cursus actief</span>
                        <span class="block text-xs text-slate-500 mt-0.5">Actieve cursussen verschijnen meteen op het overzicht</span>
                    </span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Cursus opslaan
                </button>
                <a href="{{ route('courses.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm text-slate-600 hover:text-slate-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@endsection