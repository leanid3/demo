<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('product.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
            Car::create($data);
            return response()->json([
                'success' => true,
                'message' => 'Продукт создан',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('product.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('product.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($car->image){
                Storage::disk('public')->delete($car->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $car->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Товар обновлен'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->image){
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return view('product.index');
    }
}
