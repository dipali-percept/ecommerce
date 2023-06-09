<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderstatus = OrderStatus::all();
        return view('order-status.index',compact('orderstatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order-status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);

        OrderStatus::create($request->all());

        return redirect()->route('order_status.index')->with('success','Order status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $order_status)
    {
        return view('order-status.show',compact('order_status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderStatus $order_status)
    {
        return view('order-status.edit',compact('order_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderStatus $order_status)
    {
        request()->validate([
            'name' => 'required',
        ]);

        $order_status->update($request->all());

        return redirect()->route('order_status.index')->with('success','Order status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $order_status)
    {
        $order_status->delete();
        return redirect()->route('order_status.index')->with('success','Order status deleted successfully');
    }
}
