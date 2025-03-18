@extends('layout')

@section('content')
<h1>Rentals</h1>
<!-- ✅ Back to Main Page button -->
<a href="{{ route('cars.index') }}" class="btn btn-secondary mb-3">← Back to Cars</a>

<a href="{{ route('rentals.create') }}" class="btn btn-primary mb-3 float-end">New Rental</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Car</th>
            <th>Customer</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rentals as $rental)
            <tr>
                <td>{{ $rental->car->make }} {{ $rental->car->model }} ({{ $rental->car->license_plate }})</td>
                <td>{{ $rental->customer_name }}</td>
                <td>{{ $rental->rental_start_date }}</td>
                <td>{{ $rental->rental_end_date ?? '---' }}</td>
                <td>
                    @if ($rental->status === 'active')
                        <span class="badge bg-warning text-dark">Active</span>
                    @else
                        <span class="badge bg-success">Completed</span>
                    @endif
                </td>
                <td class="d-flex gap-2">
                    @if ($rental->status === 'active')
                        <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-success btn-sm">Complete Rental</a>
                    @endif
                    <form action="{{ route('rentals.destroy', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
