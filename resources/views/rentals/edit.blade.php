@extends('layout')

@section('content')
<h1>Complete Rental for {{ $rental->car->make }} {{ $rental->car->model }}</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('rentals.update', $rental->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
    <label class="form-label">Rental Start Date</label>
    <input type="date" name="rental_start_date" class="form-control" value="{{ old('rental_start_date', $rental->rental_start_date) }}">
</div>

<div class="mb-3">
    <label class="form-label">Rental End Date</label>
    <input type="date" name="rental_end_date" class="form-control" value="{{ old('rental_end_date', $rental->rental_end_date) }}">
</div>


    <button type="submit" class="btn btn-primary">Complete Rental</button>
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
