<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Action;
use App\Models\File;
use App\Models\Request as Requests;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $size = $request->query('size', 20);

        // Fetch requests with their associated relationships including the last status
        $requests = Requests::with([
            'action' => function ($query) {
                $query->with('type');
            },
            'sender' => function ($query) {
                $query->with('category');
            },
            'status' => function ($query) {
                // Subquery to fetch the last status for each request
                $query->orderByDesc('pivot_created_at');//->limit(1); // Order by pivot table creation date
            },
            'file',
            'state',
        ])->paginate($size);

        // Manipulate the response to include the last status for each request
        foreach ($requests as $request) {
            // Access the latest status if available
            $lastStatus = $request->status->first();

            // Set the last_status attribute to the status value or 'N/A' if no status available
            $request->last_status = $lastStatus->status;
        }

        return response()->json($requests, 200);
    }

    public function search(Request $request)
    {
        // Retrieve all input data from the request
        $searchParams = $request->all();

        // Start building the query
        $query = Requests::query();

        // Apply dynamic search criteria based on input parameters
        foreach ($searchParams as $key => $value) {
            if ($value !== null && $value !== '') {
                switch ($key) {
                    case 'title':
                        $query->where('title', 'like', "%{$value}%");
                        break;
                    case 'description':
                        $query->where('description', 'like', "%{$value}%");
                        break;
                    case 'sender_name':
                        $query->whereHas('sender', function ($q) use ($value) {
                            $q->where('name', 'like', "%{$value}%");
                        });
                        break;
                    // Add more cases for additional search criteria as needed
                }
            }
        }

        // Execute the query and retrieve results with pagination
        $results = $query->with(['status', 'file'])->paginate(10);

        foreach ($results as $request) {
            // Access the latest status if available
            $lastStatus = $request->status->first();

            // Set the last_status attribute to the status value or 'N/A' if no status available
            $request->last_status = $lastStatus->status;
        }

        return response()->json($results, 200);
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

        $req->status()->attach(1);

        // Check if files were uploaded
        if ($request->hasFile('files')) {
            // Iterate over each uploaded file
            foreach ($request->file('files') as $uploadedFile) {
                // Store the file
                $savedFile = $uploadedFile->store('public');

                // Create a new file record in the database
                $file = new File();
                $file->title = $uploadedFile->getClientOriginalName(); // You can adjust this as needed
                $storagePath = Str::replaceFirst('public/', 'storage/', $savedFile);
                $file->file_path = $storagePath;
                $file->request_id = $req->id;
                $file->save();
        }}

        return response()->json(['message' => 'Request has been created successfully'], 201);


    }


    public function add($request_id, $status_id)
    {
        $req = Requests::find($request_id);
        $status = Status::find($status_id);

        if ($req && $status) {
            //$req = Requests::find($request_id);
            //$action = Action::find($action_id);


            $req->status()->attach($status);

            //return response()->json(Requests::with('action')->where('id', $request_id)->get(), 201);

            return response()->json(['message' => 'Status has been added successfully'], 201);
        } else {
            return response()->json(['message' => 'Request or Status not found'], 404);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $req = Requests::find($id);

        if (!empty($req)) {
            // Load the request along with its statuses, ordered by the pivot table's timestamp (assuming there's a timestamp field in your pivot table)
            $requestWithStatuses = Requests::with(['status' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])->find($id);

            // Extract the last status from the loaded request
            $lastStatus = $requestWithStatuses->status->first();

            return response()->json($lastStatus);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }

    public function show1($id)
    {
        $req = Requests::find($id);
        if (!empty($req)) {
            return response()->json($req::with('status'));
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

            // Retrieve the updated request with its relations
            $updatedRequest = Requests::with([
                'action' => function ($query) {
                    $query->with('type');
                },
                'sender' => function ($query) {
                    $query->with('category');
                },
                'status' => function ($query) {
                    // Subquery to fetch the last status for each request
                    $query->orderByDesc('pivot_created_at');
                },
                'file',
                'state',
            ])->find($id);

            return response()->json($updatedRequest);
        } else {
            return response()->json(['message' => 'Request Not Found'], 404);
        }
    }

    public function update_relation($request_id, $status_id1, $status_id2)
    {
        $req = Requests::find($request_id);


        if ($req) {
            $status = Action::find($status_id1);
            if ($status) {

                $req->action()->detach($status);
                $newStatus = Action::find($status_id2);
                if ($newStatus) {
                    $req->action()->attach($newStatus);

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
    public function showFile($id)
    {
        $request = Requests::with('file')->find($id); // Eager load the files relationship

        if (!empty($request)) {
            // Return the request along with its associated files
            return response()->json($request);
        } else {
            return response()->json(['message' => 'Request not found'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (Requests::where('id', $id)->exists()) {
            $req = Requests::find($id);
           // $req-> status() -> detach();
            $req->delete();

            return response()->json(['message', 'Request Has been Deleted.'], 200);
        } else {
            return response()->json(['message', 'Request Not Found'], 404);
        }
    }

    public function delete_relation($request_id, $status_id)
    {
        $req = Requests::find($status_id);
        $action = Action::find($status_id);

        if ($req && $action) {
            //$req = Requests::find($request_id);


            $req->action()->detach($status_id);


            // return response()->json(Requests::with('action')->where('id', $request_id)->first(), 200);
            return response()->json(['message', 'Request Has been Deleted.'], 200);
        } else {
            return response()->json(['error' => 'Request or Action not found'], 404);
        }
    }

}
