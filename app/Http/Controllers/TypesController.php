<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;


class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $type = Type::all();     //with('sender')->get();;
        return response()->json($type);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = New Type;
        $type -> action_type = $request -> action_type;
        $type -> save();

        return response()->json(['message','Type Added.'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $type = Type::find($id);
        if(!empty($type)){
            return response()->json($type);
        }
        else{
            return response()->json(['message','Type Not Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if (Type::where('id',$id)->exists()) {
            $type = Type::find($id);
            $type->action_type = is_null($request->action_type)? $type->action_type : $request->action_type;
            $type->save();

            return response()->json(['message','Type Updated.'],200);
        }
        else{
            return response()->json(['message','Type Not Found'],404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        if (Type::where('id',$id)->exists()) {
            $type = Type::find($id);
            $type->delete();
            return response()->json(['message', 'Type Deleted.'], 200);
        }
        else {
            return response()->json(['message', 'Type Not Found'], 404);
        }
    }
}
