<!-- resources/views/tickets/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Available Seats for Trip on {{ $trip->trip_date }}</h2>

        <form method="post" action="{{ route('tickets.purchase', ['tripId' => $trip->id]) }}">
            @csrf

            <label for="seat_number">Select Seat:</label>
            <select name="seat_number" required>
                @foreach($availableSeats as $seat)
                    <option value="{{ $seat }}">{{ $seat }}</option>
                @endforeach
            </select>

            <button type="submit">Purchase Ticket</button>
        </form>
    </div>
@endsection
