<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sender;
use Illuminate\Http\Request;

class SendersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $senders = Sender::with('category')->get();
            return response()->json($senders);

    }
    public function index2(Request $request)
    {
        $categoryId = $request->input('category_id');

        // Check if category_id parameter is provided
        if ($categoryId !== null) {
            // Filter senders by category_id
            $senders = Sender::where('category_id', $categoryId)->get();
            return response()->json($senders);
        } else {
            // If no category_id provided, return all senders
            $senders = Sender::all();
            return response()->json($senders);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sender = New Sender;
        $sender -> name = $request -> name;
        $sender -> category_id = $request -> category_id;
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
            $sender->category_id = is_null($request->category_id)? $sender->category_id : $request->category_id;
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
