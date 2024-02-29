<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
//        if ($request->hasFile('file')) {
//            $file = $request->file('file');
//            $fileName = $file->getClientOriginalName();
//            $file->move(public_path('uploads'), $fileName);
//            return response()->json(['message' => 'File uploaded successfully'], 200);
//        } else {
//            return response()->json(['error' => 'No file uploaded'], 400);
//        }
        if ($request->hasFile( key: 'file') ) {
            $avatar = $request->file(key: 'file')->store(options: 'public');
//            $avatar = Storage::disk(name: 'public')->put(path: '/', $request->file(key: 'file'));
            return response()->json(['message' => 'File uploaded successfully'], 200);
        }
    }
}
