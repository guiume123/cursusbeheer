@extends('layouts.app')

@section('title', 'Cursus bewerken')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-900">Cursus bewerken</h2>
        <p class="text-slate-500 mt-1">Pas de gegevens van deze cursus aan</p>
    </div>

    <form action="{{ route('courses.update', $course) }}" method="POST"
          class="bg-white border border-slate-200 rounded-xl p-8 space-y-6 max-w-2xl">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Titel</label>
            <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-400 @enderror">
            @error('title')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-slate-700 mb-1.5">Beschrijving</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-slate-300 rounded-lg px-3 py-2 text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-400 @enderror">{{ old('description', $course->description) }}</textarea>
            @error('description')
                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="active" value="1" {{ old('active', $course->active) ? 'checked' : '' }}
                       class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Cursus actief</span>
            </label>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
            <button type="submit"
                    class="px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition shadow-sm">
                Wijzigingen opslaan
            </button>
            <a href="{{ route('courses.index') }}"
               class="px-5 py-2.5 text-sm text-slate-600 hover:text-slate-900">
                Annuleren
            </a>
        </div>
    </form>
@endsection