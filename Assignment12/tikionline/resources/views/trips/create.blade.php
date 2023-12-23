<!-- resources/views/trips/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a New Trip</h2>

        <form method="post" action="{{ route('trips.store') }}">
            @csrf

            <div class="form-group">
                <label for="trip_date">Trip Date:</label>
                <input type="date" name="trip_date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="location_id">Select Location:</label>
                <select name="location_id" class="form-control" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Trip</button>
        </form>
    </div>
@endsection
