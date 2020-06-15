<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use \Waavi\Sanitizer\Sanitizer;

class BookingController extends Controller
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
        return Booking::all();
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
            'customer_id' => 'digit',
            'showing_id' => 'digit',
            'seats' => 'cast:array',
        ];
        
        $data = \Sanitizer::make($request->all(), $filters)->sanitize();
        $booking = Booking::create($data);

        return response()->json($booking, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $booking
     * @return json Response
     */
    public function showApi(Booking $booking)
    {
        return $booking;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  obj  $request
     * @param  int  $booking
     * @return Response
     */
    public function updateApi(Request $request, Booking $booking)
    {
        $booking->update($request->all());

        return response()->json($booking, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteApi(Booking $booking)
    {
        $booking->delete();

        return response()->json(null, 204);
    }
}
