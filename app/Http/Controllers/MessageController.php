<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index()
    {
        return Message::all();
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $message = Message::create($request->all());
        return response()->json($message, 201);
    }
    public function show(Message $message)
    {
        return $message;
    }
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
}