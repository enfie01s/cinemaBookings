<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use \Waavi\Sanitizer\Sanitizer;

class CustomerController extends Controller
{
    /*
    
    API Responses

     */
    
    /**
     * Return a listing of the customers.
     *
     * @return json Response
     */
    public function returnAll()
    {
        return Customer::all();
    }

    /**
     * Return the specified customer.
     *
     * @param  int  $customer
     * @return json Response
     */
    public function returnOne(Customer $customer)
    {
        return $customer;
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param  obj  $request
     * @return json Response
     */
    public function storeViaApi(Request $request)
    {
        $filters = [
            'name' => 'trim|escape|capitalize',
            'email' => 'trim|escape|lowercase',
        ];
        
        $data = \Sanitizer::make($request->all(), $filters)->sanitize();
        $customer = Customer::create($data);

        return response()->json($customer, 201);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param  obj  $request
     * @param  int  $customer
     * @return Response
     */
    public function updateViaApi(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteViaApi(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }
}
