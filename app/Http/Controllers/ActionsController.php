<?php

namespace App\Http\Controllers;

use App\Models\Action;

use App\Models\Request as Requests;
use Illuminate\Http\Request;


class ActionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actions = Action::with(['sender.category', 'response.file', 'type'])
            ->paginate();

        return response()->json($actions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $action = new Action;
        $action->name = $request->name;
        $action->action_time = $request->action_time;
        $action->request_id = $request->request_id;
        $action->sender_id = $request->sender_id;
        $action->type_id = $request->type_id;

        $action->save();



        return response()->json(['message', 'Action Added.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $action = Action::find($id);
        if (!empty($action)) {
            return response()->json($action);
        } else {
            return response()->json(['message', 'Action Not Found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Action::where('id', $id)->exists()) {
            $action = Action::find($id);
            $action->name = is_null($request->name) ? $action->name : $request->name;
            $action->action_time = is_null($request->action_time) ? $action->action_time : $request->action_time;
            //$action->request_id = is_null($request->request_id)? $action->request_id : $request->request_id;
            $action->sender_id = is_null($request->sender_id)? $action->sender_id : $request->sender_id;
            $action->type_id = is_null($request->type_id) ? $action->action_type : $request->type_id;
            $action->save();

            $req = $action->request()->with(['action' => function ($query) {
                $query->with(['sender' => function ($query) {
                    $query->with('category');
                },'type']); // Preload the type relationship within action
            }
            , 'sender'=> function ($query) {
                $query->with('category');},
                'state','file'])->first();

            return response()->json($req, 200);
        } else {
            return response()->json(['message' => 'Action Not Found'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Action::where('id', $id)->exists()) {
            $action = Action::find($id);
            $action->delete();
            return response()->json(['message', 'Action Deleted.'], 200);
        } else {
            return response()->json(['message', 'Action Not Found'], 404);
        }
    }

}
