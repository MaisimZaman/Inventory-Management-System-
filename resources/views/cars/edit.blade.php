@extends('layout')

@section('content')
<h1>Edit Car</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('cars.update', $car->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Make</label>
        <input type="text" name="make" class="form-control" value="{{ old('make', $car->make) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Year</label>
        <input type="text" name="year" class="form-control" value="{{ old('year', $car->year) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">License Plate</label>
        <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate', $car->license_plate) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Rental Price per Day</label>
        <input type="text" name="rental_price_per_day" class="form-control" value="{{ old('rental_price_per_day', $car->rental_price_per_day) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="available" {{ $car->status === 'available' ? 'selected' : '' }}>Available</option>
            <option value="rented" {{ $car->status === 'rented' ? 'selected' : '' }}>Rented</option>
            <option value="maintenance" {{ $car->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $car->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update Car</button>
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
