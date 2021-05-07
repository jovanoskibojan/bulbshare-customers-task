<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Load set of rows
     */
    public function load(Request $request) {
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_term = $request->search['value'];
        $total = Customer::select('id')->count();
        $filter = $total;
        $oder_by = $request->order[0]['column'];
        $oder_direction = $request->order[0]['dir'];
        $fields = ['id', 'company', 'last_name', 'first_name', 'email_address', 'job_title', 'business_phone', 'address', 'city', 'zip_postal_code', 'country_region'];

        if(isset($search_term)) {
            $customers = Customer::select($fields)
                ->where('company', 'like', "%{$search_term}%")
                ->orWhere('last_name', 'like', "%{$search_term}%")
                ->orWhere('first_name', 'like', "%{$search_term}%")
                ->orWhere('address', 'like', "%{$search_term}%")
                ->orWhere('city', 'like', "%{$search_term}%")
                ->orWhere('country_region', 'like', "%{$search_term}%")
                ->skip($start)
                ->limit($length)
                ->orderBy($fields[$oder_by], $oder_direction)
                ->get();
            $filter = $customers->count();
        }
        else {
            $customers = Customer::select($fields)
                ->skip($start)
                ->limit($length)
                ->orderBy($fields[$oder_by], $oder_direction)
                ->get();
        }
        $customerData = $customers->toArray();
        $customer = [];
        foreach ($customerData as $key => $customer1) {
            $customer[] = array_values($customer1);
        }
        $data = [
            "draw" => $draw,
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $customer
        ];
        //dd($customers->count(), $filter);
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
