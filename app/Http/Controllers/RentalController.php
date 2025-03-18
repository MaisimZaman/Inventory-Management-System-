<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('car')->orderBy('id', 'desc')->get();
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $availableCars = Car::where('status', 'available')->get();
        return view('rentals.create', compact('availableCars'));
    }

    public function store(Request $request)
    {
    $request->validate([
        'car_id' => 'required|exists:cars,id',
        'customer_name' => 'required|string|max:255',
        'rental_start_date' => 'required|date',
        'rental_end_date' => 'nullable|date|after_or_equal:rental_start_date', // ✅ added end date validation
    ]);

    Rental::create([
        'car_id' => $request->car_id,
        'customer_name' => $request->customer_name,
        'rental_start_date' => $request->rental_start_date,
        'rental_end_date' => $request->rental_end_date,   // ✅ added
        'status' => 'activ  e',
    ]);

    Car::find($request->car_id)->update(['status' => 'rented']);

    return redirect()->route('rentals.index')->with('success', 'Rental created!');
    }

    public function edit(Rental $rental)
    {
        return view('rentals.edit', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
{
    $request->validate([
        'rental_start_date' => 'required|date',
        'rental_end_date' => 'required|date|after_or_equal:rental_start_date',
    ]);

    $rental->update([
        'rental_start_date' => $request->rental_start_date,
        'rental_end_date' => $request->rental_end_date,
        'status' => 'completed',
    ]);

    $rental->car->update(['status' => 'available']);

    return redirect()->route('rentals.index')->with('success', 'Rental completed!');
}


    public function destroy(Rental $rental)
    {
        // If deleting an active rental, return car to available
        if ($rental->status === 'active') {
            $rental->car->update(['status' => 'available']);
        }

        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental deleted!');
    }
}
