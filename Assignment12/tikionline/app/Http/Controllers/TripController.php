<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Location;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::all();
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $locations = Location::all();
        return view('trips.create', compact('locations'));
    }

    public function store(Request $request)
    {
        Trip::create([
            'trip_date' => $request->input('trip_date'),
            'location_id' => $request->input('location_id'),
        ]);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully');
    }
}
