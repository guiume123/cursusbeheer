<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderBy('title')->get();

        $stats = [
            'total' => $courses->count(),
            'active' => $courses->where('active', true)->count(),
            'inactive' => $courses->where('active', false)->count(),
        ];

        return view('courses.index', compact('courses', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'active' => $request->has('active'),
        ]);

        return redirect()
            ->route('courses.index')
            ->with('status', 'Cursus succesvol aangemaakt!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'active' => $request->has('active'),
        ]);

        return redirect()
            ->route('courses.index')
            ->with('status', 'Cursus succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()
            ->route('courses.index')
            ->with('status', 'Cursus verwijderd.');
    }

    /**
     * Toggle the active status of the specified resource.
     */
    public function toggle(Course $course)
    {
        $course->active = ! $course->active;
        $course->save();

        return redirect()
            ->route('courses.index')
            ->with('status', 'Status van "' . $course->title . '" gewijzigd.');
    }
}