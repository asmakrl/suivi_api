<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;


class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $state = State::all();     //with('sender')->get();;
        return response()->json($state);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $state = New State;
        $state -> code = $request -> code;
        $state -> nomAr = $request -> nomAr;
        $state ->nomFr = $request -> NomFr;
        $state -> save();

        return response()->json(['message','State Added.'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $state = State::find($id);
        if(!empty($state)){
            return response()->json($state);
        }
        else{
            return response()->json(['message','State Not Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if ($state = State::where('id',$id)){
            $state = State::find($id);
            $state->code = is_null($request->code)? $state->code : $request->code;
            $state->nomAr = is_null($request->nomAr)? $state->nomAr : $request->nomAr;
            $state->nomFr = is_null($request->nomFr)? $state->nomFr : $request->nomFr;
            $state->save();

            return response()->json(['message','State Updated.'],200);
        }
        else{
            return response()->json(['message','State Not Found'],404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($state = State::where('id',$id)){
            $state = State::find($id);
            $state->delete();
            return response()->json(['message', 'State Deleted.'], 200);
        }
        else {
            return response()->json(['message', 'State Not Found'], 404);
        }
    }
}
