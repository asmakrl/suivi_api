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
        $file = New File;
        $file -> title = $request -> title;
        $file -> file_path = $request -> file_path;
        $file -> file_size = $request ->file_size;
        $file -> save();

        return response()->json(['message','File Added.'],201);
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
        if ($file = File::where('id',$id)){
            $file = File::find($id);
            $file->title = is_null($request->title)? $file->title : $request->title;
            $file->file_path = is_null($request->file_path)? $file->file_path : $request->file_path;
            $file->file_size = is_null($request->file_size)? $file->file_size : $request->file_size;
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
    public function destroy(string $id)
    {
        if ($file = File::where('id',$id)){
            $file = File::find($id);
            $file->delete();
            return response()->json(['message', 'File Deleted.'], 200);
        }
        else {
            return response()->json(['message', 'File Not Found'], 404);
        }
    }
}
