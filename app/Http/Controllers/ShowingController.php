<?php

namespace App\Http\Controllers;

use App\Showing;
use Illuminate\Http\Request;
use \Waavi\Sanitizer\Sanitizer;

class ShowingController extends Controller
{
    /*
    
    API Responses

     */
    
    /**
     * Return a listing of the showings.
     *
     * @return json Response
     */
    public function returnAll()
    {
        return Showing::all();
    }

    /**
     * Return the specified showing.
     *
     * @param  int  $showing
     * @return json Response
     */
    public function returnOne(Showing $showing)
    {
        return $showing;
    }

    /**
     * Store a newly created showing in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeViaApi(Request $request)
    {
        $filters = [
            'movie_id' => 'digit',
            'start_at' => 'trim',
        ];
        
        $data = \Sanitizer::make($request->all(), $filters)->sanitize();
        $showing = Showing::create($data);

        return response()->json($showing, 201);
    }

    /**
     * Update the specified showing in storage.
     *
     * @param  obj  $request
     * @param  int  $showing
     * @return Response
     */
    public function updateViaApi(Request $request, Showing $showing)
    {
        $showing->update($request->all());

        return response()->json($showing, 200);
    }

    /**
     * Remove the specified showing from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteViaApi(Showing $showing)
    {
        $showing->delete();

        return response()->json(null, 204);
    }
}
