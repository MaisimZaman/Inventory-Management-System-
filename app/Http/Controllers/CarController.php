<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     */
    public function index(Request $request)
{
    // Start query builder
    $query = Car::query();

    // Apply filters if they exist
    if ($request->filled('make')) {
        $query->where('make', 'like', '%' . $request->make . '%');
    }

    if ($request->filled('model')) {
        $query->where('model', 'like', '%' . $request->model . '%');
    }

    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Get filtered results (or all cars)
    $cars = $query->orderBy('id', 'desc')->get();

    return view('cars.index', compact('cars'));
}

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('cars.create'); // Return the create car form
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'license_plate' => 'required|string|max:50|unique:cars',
            'status' => 'required|in:available,rented,maintenance',
            'rental_price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Create a new car record
        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car')); // Return the edit car form
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
        // Validate incoming request data
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|digits:4',
            'license_plate' => 'required|string|max:50|unique:cars,license_plate,' . $car->id,
            'status' => 'required|in:available,rented,maintenance',
            'rental_price_per_day' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Update car record
        $car->update($request->all());

        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully!');
    }
}
