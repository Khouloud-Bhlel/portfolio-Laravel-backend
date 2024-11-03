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
            'image_url' => 'nullable|url',  // Changed to match expected URL format
            'video_url' => 'nullable|url',  // Changed to match expected URL format
            'project_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Prepare data for saving
        $data = $request->all();

        // No need to handle file uploads if you're using URLs directly
        $project = Project::create($data);
        return response()->json($project, 201);
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'image_url' => 'nullable|url',  // Match expected URL format
            'video_url' => 'nullable|url',  // Match expected URL format
            'project_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->all();
        $project->update($data);
        return response()->json($project, 200);
    }
}
