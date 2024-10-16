<?php
namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

    public function show(Project $project)
    {
        return $project;
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'image_url' => 'nullable|url',
            'project_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $project->update($request->all());
        return response()->json($project, 200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}