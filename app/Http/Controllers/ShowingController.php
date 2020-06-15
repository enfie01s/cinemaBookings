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
     * Display a listing of the resource.
     *
     * @return json Response
     */
    public function indexApi()
    {
        return Showing::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeApi(Request $request)
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
     * Display the specified resource.
     *
     * @param  int  $showing
     * @return json Response
     */
    public function showApi(Showing $showing)
    {
        return $showing;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  obj  $request
     * @param  int  $showing
     * @return Response
     */
    public function updateApi(Request $request, Showing $showing)
    {
        $showing->update($request->all());

        return response()->json($showing, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteApi(Showing $showing)
    {
        $showing->delete();

        return response()->json(null, 204);
    }
}
