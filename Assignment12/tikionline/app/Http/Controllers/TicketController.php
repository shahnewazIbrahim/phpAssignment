<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\User;
use App\Models\SeatAllocation;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function showAvailableSeats(Request $request, $tripId)
    {
        $trip = Trip::findOrFail($tripId);
        $availableSeats = $this->getAvailableSeats($trip);

        return view('tickets.show', compact('trip', 'availableSeats'));
    }

    public function purchaseTicket(Request $request, $tripId)
    {
        $trip = Trip::findOrFail($tripId);
        $seatNumber = $request->input('seat_number');

        if ($this->isSeatAvailable($trip, $seatNumber)) {
            $user = User::findOrFail(auth()->id());

            SeatAllocation::create([
                'user_id' => $user->id,
                'trip_id' => $trip->id,
                'seat_number' => $seatNumber,
            ]);

            return redirect()->route('trips.index')->with('success', 'Ticket purchased successfully');
        } else {
            return redirect()->back()->with('error', 'Selected seat is not available');
        }
    }

    private function getAvailableSeats(Trip $trip)
    {
        $occupiedSeats = $this->getOccupiedSeats($trip);
        $allSeats = range(1, 36);

        return array_diff($allSeats, $occupiedSeats);
    }

    private function getOccupiedSeats(Trip $trip)
    {
        return $trip->seatAllocations->pluck('seat_number')->toArray();
    }

    private function isSeatAvailable(Trip $trip, $seatNumber)
    {
        return !in_array($seatNumber, $this->getOccupiedSeats($trip));
    }
}
