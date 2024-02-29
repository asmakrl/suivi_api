<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\File;
use App\Models\Request as Requests;
use Illuminate\Http\Request;


class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $size = $request->query('size', 20);
        //$req = Requests::with('action','sender','state')->paginate($size);
        //$page = $request->query('page', 0);
        //$limit =  $request->query('limit', 10);
        // $req = Requests::with('action')->skip($page*$limit)->take($limit)->get();
        $req = Requests::with(['action' => function ($query) {
            $query->with('type');
        },
            'file', 'sender', 'state'])->paginate($size);

        return response()->json($req, 200);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {


        $req = new Requests();
        $req->title = $request->title;
        $req->description = $request->description;
        $req->received_at = $request->received_at;
        $req->sender_id = $request->sender_id;
        $req->state_id = $request->state_id;
        $req->save();
        if ($request->hasFile(key: 'file')) {
            $savedFile = $request->file(key: 'file')->store(options: 'public');
//            $avatar = Storage::disk(name: 'public')->put(path: '/', $request->file(key: 'file'));
            $file = new File();
            $file->title = "aze";
            $file->file_path = $savedFile;
            $file->file_size = "111";
            $file->request_id = $req->id;
            $file->save();
        }

        return response()->json(['message' => 'Request has been created successfully'], 201);

    }

    public function add($request_id, $action_id)
    {
        $req = Requests::find($request_id);
        $action = Action::find($action_id);

        if ($req && $action) {
            //$req = Requests::find($request_id);
            //$action = Action::find($action_id);


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
        if (!empty($req)) {
            return response()->json($req);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Requests::where('id', $id)->exists()) {

            $req = Requests::find($id);
            $req->title = is_null($request->title) ? $req->title : $request->title;
            $req->description = is_null($request->description) ? $req->description : $request->description;
            $req->received_at = is_null($request->received_at) ? $req->received_at : $request->received_at;
            $req->sender_id = is_null($request->sender_id) ? $req->sender_id : $request->sender_id;
            $req->state_id = is_null($request->state_id) ? $req->state_id : $request->state_id;
            $req->save();
            return response()->json(['message' => 'Request has been updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Request Not Found'], 404);
        }
    }

    public function update_relation($request_id, $action_id1, $action_id2)
    {
        $req = Requests::find($request_id);


        if ($req) {
            $action = Action::find($action_id1);
            if ($action) {

                $req->action()->detach($action);
                $newAction = Action::find($action_id2);
                if ($newAction) {
                    $req->action()->attach($newAction);

                } else {
                    return response()->json(['error' => 'New Action not found'], 404);
                }

                return response()->json(['message' => 'Action has been updated successfully'], 200);
            } else {
                return response()->json(['error' => 'Action not found'], 404);
            }
        } else {
            return response()->json(['error' => 'Request not found'], 404);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Requests::where('id', $id)->exists()) {
            $req = Requests::find($id);
            // $req-> action() -> detach();
            $req->delete();

            return response()->json(['message', 'Request Has been Deleted.'], 200);
        } else {
            return response()->json(['message', 'Request Not Found'], 404);
        }
    }

    public function delete_relation($request_id, $action_id)
    {
        $req = Requests::find($request_id);
        $action = Action::find($action_id);

        if ($req && $action) {
            //$req = Requests::find($request_id);


            $req->action()->detach($action_id);


            // return response()->json(Requests::with('action')->where('id', $request_id)->first(), 200);
            return response()->json(['message', 'Request Has been Deleted.'], 200);
        } else {
            return response()->json(['error' => 'Request or Action not found'], 404);
        }
    }

}
