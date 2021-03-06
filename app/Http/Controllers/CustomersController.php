<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    private $fields = ['id', 'company', 'last_name', 'first_name', 'email_address', 'job_title', 'business_phone', 'address', 'city', 'zip_postal_code', 'country_region', 'state_province'];
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
        $data = $request->validate([
            'company' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            ''
        ]);
        return Customer::create($request->toArray());
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

        if(isset($search_term)) {
            $customers = Customer::select($this->fields)
                ->where('company', 'like', "%{$search_term}%")
                ->orWhere('last_name', 'like', "%{$search_term}%")
                ->orWhere('first_name', 'like', "%{$search_term}%")
                ->orWhere('address', 'like', "%{$search_term}%")
                ->orWhere('city', 'like', "%{$search_term}%")
                ->orWhere('country_region', 'like', "%{$search_term}%")
                ->skip($start)
                ->limit($length)
                ->orderBy($this->fields[$oder_by], $oder_direction)
                ->get();
            $filter = $customers->count();
        }
        else {
            $customers = Customer::select($this->fields)
                ->skip($start)
                ->limit($length)
                ->orderBy($this->fields[$oder_by], $oder_direction)
                ->get();
        }
        $totalValue = [];
        $orderValue = [];
        foreach ($customers as $customer) {
            $shippingAndTax = 0;
            $orderTotal = 0;
            foreach ($customer->orders as $order) {
                $shippingAndTax += (float)$order->shipping_fee + (float)$order->taxes;
                foreach ($order->OrderDetails as $order_detail) {
                    $orderTotal += $order_detail->quantity * $order_detail->unit_price;
                }
            }
            $totalValue[] = $shippingAndTax + $orderTotal;
            $orderValue[] = $orderTotal;
        }
        $customerData = $customers->toArray();
        $customer = [];
        $i = 0;
        foreach ($customerData as $key => $aCustomer) {
            $arraySlice = array_slice(array_values($aCustomer), 0,11);
            $country = array_values($aCustomer)[11];
            array_push($arraySlice, $orderValue[$i], $totalValue[$i], $country);
            $customer[] = $arraySlice;
            $i++;
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
        $customer = Customer::select($this->fields)->where('id', $id)->first();
        return json_encode($customer->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'company' => 'required',
            'last_name' => 'required',
            'first_name' => 'required'
        ]);
        $data = $request->toArray();
        array_pop($data);
        return Customer::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orders = Customer::find($id)->orders;
        foreach ($orders as $order) {
            foreach ($order->OrderDetails as $details) {
                $details->delete();
            }
            foreach ($order->invoice as $invoice) {
                $invoice->delete();
            }
            $order->delete();
        }
        return Customer::where('id', $id)->delete();
    }
}
