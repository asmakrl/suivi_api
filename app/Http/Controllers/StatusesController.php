<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function index()
    {
        $state = Status::all();     //with('sender')->get();;
        return response()->json($state);
    }

    public function show($id)
    {
        $status = Status::find($id);
        if (!empty($status)) {
            return response()->json($status);
        } else {
            return response()->json(['message', 'Action Not Found'], 404);
        }
    }

}
