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
     * Return a listing of the bookings.
     *
     * @return json Response
     */
    public function returnAll()
    {
        return Booking::all();
    }

    /**
     * Return the specified booking.
     *
     * @param  int  $booking
     * @return json Response
     */
    public function returnOne(Booking $booking)
    {
        return $booking;
    }

    /**
     * Store a newly created booking in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeViaApi(Request $request)
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
     * Update the specified booking in storage.
     *
     * @param  obj  $request
     * @param  int  $booking
     * @return Response
     */
    public function updateViaApi(Request $request, Booking $booking)
    {
        $booking->update($request->all());

        return response()->json($booking, 200);
    }

    /**
     * Remove the specified booking from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteViaApi(Booking $booking)
    {
        $booking->delete();

        return response()->json(null, 204);
    }
}
