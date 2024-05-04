<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Request as Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function store(Request $request, $id)
    {
       if($request->hasFile('files')){
           foreach ($request->file('files') as $uploadedFile){
               // Store the file
               $savedFile = $uploadedFile->store('public');

               // Create a new file record in the database
               $file = new File();
               $file->title = $uploadedFile->getClientOriginalName(); // You can adjust this as needed
               $storagePath = Str::replaceFirst('public/', 'storage/', $savedFile);
               $file->file_path = $storagePath;
               $file->request_id = $id;
               $file->save();
           }
       }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $req = Requests::find($id);
        if(!empty($req)){
            $updatedFiles = $req->file()->get();
            return response()->json($updatedFiles);
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
    public function destroy($id)
    {
        if (File::where('id', $id)->exists()) {
            $file = File::find($id);
            // $req-> status() -> detach();
            $file->delete();

            return response()->json(['message', 'Request Has been Deleted.'], 200);
        } else {
            return response()->json(['message', 'Request Not Found'], 404);
        }
    }
    public function destroy1( $file)
    {
        // Delete the file from storage
        Storage::delete($file);

        return response()->json(['message' => 'File deleted successfully'], 200);
    }
}
