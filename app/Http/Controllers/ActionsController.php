<?php

namespace App\Http\Controllers;

use App\Models\Action;

use Illuminate\Http\Request;


class ActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $action = Action::all();     //with('sender')->get();;
        return response()->json($action);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $action = New Action;
        $action -> name = $request -> name;
        $action -> action_time = $request -> action_time;
        $action -> type_id = $request -> type_id;
        $action -> save();

        return response()->json(['message','Action Added.'],201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $action = Action::find($id);
        if(!empty($action)){
            return response()->json($action);
        }
        else{
            return response()->json(['message','Action Not Found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if ( Action::where('id',$id)){
            $action = Action::find($id);
            $action -> name = is_null($request->name)? $action->name : $request->name;
            $action->action_time = is_null($request->action_time)? $action->action_time : $request->action_time;
            $action->type_id = is_null($request->type_id)? $action->action_type : $request->type_id;
            $action->save();

            return response()->json(['message','Action Updated.'],200);
        }
        else{
            return response()->json(['message','Action Not Found'],404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if ($action = Action::where('id',$id)){
            $action = Action::find($id);
            $action->delete();
            return response()->json(['message', 'Action Deleted.'], 200);
    }
        else {
            return response()->json(['message', 'Action Not Found'], 404);
        }
    }
}
