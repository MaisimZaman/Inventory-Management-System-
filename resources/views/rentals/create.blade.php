@extends('layout')

@section('content')
<h1>Create New Rental</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('rentals.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Select Car</label>
        <select name="car_id" class="form-select">
            @foreach ($availableCars as $car)
                <option value="{{ $car->id }}">
                    {{ $car->make }} {{ $car->model }} ({{ $car->license_plate }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Rental Start Date</label>
        <input type="date" name="rental_start_date" class="form-control" value="{{ old('rental_start_date') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Rental End Date</label>
        <input type="date" name="rental_end_date" class="form-control" value="{{ old('rental_end_date') }}">
    </div>

    <button type="submit" class="btn btn-success">Start Rental</button>
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
