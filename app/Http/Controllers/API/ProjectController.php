<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return $this->message( ProjectResource::collection($projects) , 'New Data');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if(!$request->has('appid')) {
        //     return $this->message([], 'Not Authorized', false, 401);
        // }

        // $user = User::where('appid', $request->appid)->exists();
        // if(!$user) {
        //     return $this->message([], 'Not Authorized', false, 401);
        // }

        // validation
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'status' => 'required',
        ]);

        // upload file
        $path = $request->file('image')->store('images', 'files');

        $data = $request->except('appid');
        $data['image'] = $path;

        $project = Project::create($data);

        return $this->message($project, 'New project added', true, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
