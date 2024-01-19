<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Illuminate\Http\Request;

class SendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sender = Sender::all();     //with('sender')->get();;
        return response()->json($sender);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sender = New Sender;
        $sender -> name = $request -> name;
        $sender -> save();

        return response()->json(['message','Sender Added.'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sender = Sender::find($id);
        if(!empty($sender)){
            return response()->json($sender);
        }
        else{
            return response()->json(['message','Sender Not Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if ( Sender::where('id',$id)->exists()){
            $sender = Sender::find($id);
            $sender->name = is_null($request->name)? $sender->name : $request->name;
            $sender->save();

            return response()->json(['message','Sender Updated.'],200);
        }
        else{
            return response()->json(['message','Sender Not Found'],404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if (Sender::where('id',$id)->exists()){
            $sender = Sender::find($id);
            $sender->delete();
            return response()->json(['message', 'Sender Deleted.'], 200);
        }
        else {
            return response()->json(['message', 'Sender Not Found'], 404);
        }
    }
}
