<?php

namespace App\Http\Controllers\Front;

use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    function index() {
        $projects = Project::latest('id')->take(5)->get();
        return view('front.index', compact('projects'));
    }

    function project(Project $project) {
        // return $slug;
        // $project = Project::where('slug', $slug)->firstOrFail();

        return view('front.project', compact('project'));
    }

    function project_apply(Request $request, Project $project) {

        $request->validate([
            'price' => 'required|numeric|min:25',
            'duration' => 'required',
            'content' => 'required',
        ]);


        Proposal::create([
            'user_id' => Auth::id()??Auth::guard('admin')->id(),
            'project_id' => $project->id,
            'price' => $request->price,
            'duration' => $request->duration,
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
