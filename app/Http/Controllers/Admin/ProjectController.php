<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    //user_id	title	description	price	price_type	duration	status	created_at	updated_at


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest('id')->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_type' => 'required',
            'duration' => 'required',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::guard('admin')->id();

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('msg', 'Project added successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_type' => 'required',
            'duration' => 'required',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::guard('admin')->id();

        $project = Project::findOrFail($id);

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('msg', 'Project updated successfully')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::destroy($id);

        return redirect()->route('admin.projects.index')->with('msg', 'Project deleted successfully')->with('type', 'danger');
    }
}