@extends('layout')

<form action="{{ route('cars.index') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <input type="text" name="make" class="form-control" placeholder="Search by Make" value="{{ request('make') }}">
    </div>

    <div class="col-md-3">
        <input type="text" name="model" class="form-control" placeholder="Search by Model" value="{{ request('model') }}">
    </div>

    <div class="col-md-2">
        <input type="text" name="year" class="form-control" placeholder="Year" value="{{ request('year') }}">
    </div>

    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">All Statuses</option>
            <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
            <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
    </div>

    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Search</button>
    </div>
</form>

@section('content')



<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Car Inventory</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-primary">Add Car</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif



<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>License Plate</th>
            <th>Status</th>
            <th>Price/Day</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cars as $car)
            <tr>
                <td>{{ $car->make }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->year }}</td>
                <td>{{ $car->license_plate }}</td>
                <td>
                    @if ($car->status === 'available')
                        <span class="badge bg-success">Available</span>
                    @elseif ($car->status === 'rented')
                        <span class="badge bg-warning text-dark">Rented</span>
                    @else
                        <span class="badge bg-danger">Maintenance</span>
                    @endif
                </td>
                <td>${{ number_format($car->rental_price_per_day, 2) }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No cars found.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
