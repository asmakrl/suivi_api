<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $file = File::all();     //with('sender')->get();;
        return response()->json($file);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('files/' . $folder, $filename);

            return $folder;
        }

        return '';
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file = File::find($id);
        if(!empty($file)){
            return response()->json($file);
        }
        else{
            return response()->json(['message','File Not Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if (File::where('id',$id)->exists()) {
            $file = File::find($id);
            $file->title = is_null($request->title)? $file->title : $request->title;
            $file->file_path = is_null($request->file_path)? $file->file_path : $request->file_path;
            $file->file_size = is_null($request->file_size)? $file->file_size : $request->file_size;
            $file->request_id = is_null($request->request_id)? $file->request_id : $request->request_id;
            $file->save();

            return response()->json(['message','File Updated.'],200);
        }
        else{
            return response()->json(['message','File Not Found'],404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if (File::where('id',$id)->exists()) {
            $file = File::find($id);
            $file->delete();
            return response()->json(['message', 'File Deleted.'], 200);
        }
        else {
            return response()->json(['message', 'File Not Found'], 404);
        }
    }
}
