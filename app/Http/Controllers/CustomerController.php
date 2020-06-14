<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
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
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeApi(Request $request)
    {
        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $customer
     * @return json Response
     */
    public function showApi(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  obj  $request
     * @param  int  $customer
     * @return Response
     */
    public function updateApi(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteApi(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}
