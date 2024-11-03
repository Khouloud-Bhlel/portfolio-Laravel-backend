<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use App\Models\Project;

class MediaController extends Controller
{
    public function uploadAndCreateProject(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10000', // Adjust max size if needed
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Initialize Cloudinary
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        // Upload file to Cloudinary
        try {
            $result = $cloudinary->uploadApi()->upload($request->file('file')->getRealPath());
            $imageUrl = $result['secure_url'];

            // Create a new project using the uploaded image URL
            $project = Project::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => $imageUrl,
                'project_url' => $request->input('project_url') // Optionally accept a project URL
            ]);

            // Return the created project
            return response()->json($project, 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload file: ' . $e->getMessage()], 500);
        }
    }
}
