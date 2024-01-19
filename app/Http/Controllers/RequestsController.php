<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Request as Requests;
use Illuminate\Http\Request;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$req = Requests::all();
        $req = Requests::with('action')->get();
        return response()->json($req, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $req = New Requests();
        $req->title = $request->title;
        $req->description = $request->description;
        $req-> received_at = $request->received_at;
        $req->sender_id = $request->sender_id;
        $req->state_id = $request->state_id;
        $req->save();


        return response()->json(['message' => 'Request has been created successfully'],201);

    }

    public function add($request_id, $action_id)
    {
        $requestExists = Requests::find($request_id);
        $actionExists = Action::find($action_id);

        if ($requestExists && $actionExists) {
            $req = Requests::find($request_id);
            $action = Action::find($action_id);


            $req->action()->attach($action);

            //return response()->json(Requests::with('action')->where('id', $request_id)->get(), 201);

            return response()->json(['message' => 'Action has been added successfully'], 201);
        } else {
            return response()->json(['message' => 'Request or Action not found'], 404);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $req = Requests::find($id);
        if(!empty($req)){
            return response()->json($req);
        }
        else {
            return response()->json(['message' => 'Request not found'],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if(Requests::where('id',$id)->exists()){

            $req = Requests::find($id);
            $req->title = is_null($request->title) ? $req->title : $request->title;
            $req->description = is_null($request->description) ? $req->description : $request->description;
            $req->received_at = is_null($request->received_at) ? $req->received_at : $request->received_at;
            $req->sender_id = is_null($request->sender_id) ? $req->sender_id : $request->sender_id;
            $req->state_id = is_null($request->state_id) ? $req->state_id : $request->state_id;
            $req->save();
            return response()->json(['message' => 'Request has been updated successfully'], 200);
        }
        else {
            return response()->json(['message'=> 'Request Not Found'], 404);
        }
    }

    public function update_relation($request_id, $action_id)
    {
        $requestExists = Requests::find($request_id);
        $actionExists = Action::find($action_id);

        if ($requestExists && $actionExists) {
            $req = Requests::find($request_id);
            $action = Action::find($action_id);


            $req->action()->sync([$action_id]);




            //return response()->json(Requests::with('action')->where('id', $request_id)->first(), 200);
            return response()->json(['message' => 'Action has been updated successfully'], 201);
        } else {
            return response()->json(['error' => 'Request or Action not found'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        if (Requests::where('id', $id)->exists()){
            $req = Requests::find($id);
            $req-> action() -> detach();
            $req->delete();

            return response()->json(['message', 'Request Has been Deleted.'],200);
        }
        else{
            return response()->json(['message','Request Not Found'],404);
        }
    }

    public function delete_relation($request_id, $action_id)
    {
        $requestExists = Requests::find($request_id);
        $actionExists = Action::find($action_id);

        if ($requestExists && $actionExists) {
            $req = Requests::find($request_id);


            $req->action()->detach($action_id);




           // return response()->json(Requests::with('action')->where('id', $request_id)->first(), 200);
            return response()->json(['message', 'Request Has been Deleted.'],200);
        } else {
            return response()->json(['error' => 'Request or Action not found'], 404);
        }
    }

}
