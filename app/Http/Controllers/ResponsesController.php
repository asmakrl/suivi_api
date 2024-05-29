<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponsesController extends Controller
{
    public function index()
    {
        $res = Response::with('file')->paginate();;
        return response()->json($res);
    }

    public function show($id)
    {
        $res = Response::find($id);

        if (!empty($res)) {

            return response()->json($res);
        } else {
            return response()->json(['message' => 'Response not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $res = new Response();
        $res ->response = $request-> response;
        $res->response_time = $request->response_time;
        $res->action_id = $request->action_id;
        $res->save();

        // Check if files were uploaded
        if ($request->hasFile('files')) {
            // Iterate over each uploaded file
            foreach ($request->file('files') as $uploadedFile) {
                // Store the file
                $savedFile = $uploadedFile->store('public');

                // Create a new file record in the database
                $file = new File();
                $file->title = $uploadedFile->getClientOriginalName(); // You can adjust this as needed
                $storagePath = Str::replaceFirst('public/', 'storage/', $savedFile);
                $file->file_path = $storagePath;
                //$file->response_id = $res->id;
                $res->file()->save($file);
            }}

        return response()->json(['message' => 'Response has been created successfully'], 201);
    }
}
