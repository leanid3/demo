<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Order;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['car', 'user'])->paginate(10);
        return view( 'order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if ($order->status === 'new') {

        $request->validate([
            'status' => 'required|string|in:new,confirmed,rejected'
        ]);

        $order->status = $request->status;
        $order->save();
        session()->flash('message', 'Данные успешно сохранены!');
        return response()->json(['success' => true]);
//            $order->update(['status' => $request->status]);
//            notify()->success('Статус заявки изменен');
        }
        session()->flash('error', 'Статус можно изменить только для заявлений со статусом "new"');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
