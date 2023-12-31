<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    //user_id	title	description	price	price_type	duration	status	created_at	updated_at


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all_projects');
        // $projects = Project::open()->latest('id')->paginate(10);
        $projects = Project::latest('id')->paginate(10);
        // $projects = Project::latest('id')->dd();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('store_projects');
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('store_projects');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_type' => 'required',
            'duration' => 'required',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::guard('admin')->id();
        $data['slug'] = Str::slug($request->title);

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
        Gate::authorize('edit_projects');
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit_projects');
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
        Gate::authorize('delete_projects');
        Project::destroy($id);

        return redirect()->route('admin.projects.index')->with('msg', 'Project deleted successfully')->with('type', 'danger');
    }

    function trash() {
        $projects = Project::onlyTrashed()->latest('id')->paginate(10);

        return view('admin.projects.trash', compact('projects'));
    }

    function restore($id) {
        Project::onlyTrashed()->find($id)->restore();
        // $project->update(['deleted_at' => null]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project restored successfully')->with('type', 'info');
    }

    function forcedelete($id) {
        $project = Project::onlyTrashed()->find($id);
        File::delete(public_path($project->image));
        $project->forcedelete();
        // $project->update(['deleted_at' => null]);

        return redirect()->route('admin.projects.index')->with('msg', 'Project deleted permanently successfully')->with('type', 'info');
    }
}
