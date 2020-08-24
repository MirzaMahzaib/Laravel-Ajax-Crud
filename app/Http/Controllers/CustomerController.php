<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }

    public function store()
    {
        $data = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
        ]);
        $customer = Customer::create($data);
        return response()->json($customer);
    }

    public function edit(Customer $id)
    {
        return response()->json($id);
    }

    public function update(Customer $id)
    {
        $data = request()->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
        ]);
        $id->update($data);
        return response()->json($id);
    }

    public function destroy(Customer $id)
    {
        $id->delete();
        return response()->json($id);
    }
}
