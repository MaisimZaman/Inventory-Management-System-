@extends('layout')

@section('content')
<h1>Add New Car</h1>

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

<form action="{{ route('cars.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Make</label>
        <input type="text" name="make" class="form-control" value="{{ old('make') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" value="{{ old('model') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Year</label>
        <input type="text" name="year" class="form-control" value="{{ old('year') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">License Plate</label>
        <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Rental Price per Day</label>
        <input type="text" name="rental_price_per_day" class="form-control" value="{{ old('rental_price_per_day') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>Available</option>
            <option value="rented" {{ old('status') === 'rented' ? 'selected' : '' }}>Rented</option>
            <option value="maintenance" {{ old('status') === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-success">Add Car</button>
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
