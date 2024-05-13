<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{

    /**
     * Get all locations from the database.
     *
     * @return \Illuminate\Http\JsonResponse The JSON response containing the locations.
     */
    public function locations(Request $request)
    {
        $locations = [];

        foreach (Location::with('user')->get() as $location) {
            if ($request->user_id == $location->user_id) {
                array_push($locations, [
                    'id' => $location->id,
                    'user_id' => $location->user_id,
                    'name' => $location->user->name,
                    'region' => $location->region,
                    'comuna' => $location->comuna,
                    'address' => $location->address,
                    'latitude' => $location->latitude,
                    'longitude' => $location->longitude
                ]);
            }
        }

        return response()->json($locations);
    }

    /**
     * Store a new location in the database.
     *
     * @param Request $request The HTTP request object.
     * @throws Some_Exception_Class If the validation fails.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the message and the stored location.
     */
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $location = new Location();
        $location->user_id = Auth::id();
        $location->region = $request->region;
        $location->comuna = $request->comuna;
        $location->address = $request->address;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return response()->json([
            'message' => 'Location stored successfully',
            'location' => $location
        ]);
    }

    /**
     * Update an existing location in the database.
     *
     * @param Request $request The HTTP request object.
     * @throws Some_Exception_Class If the validation fails.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the message and the updated location.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'region' => 'required',
            'comuna' => 'required',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $location = Location::find($request->id);
        $location->region = $request->region;
        $location->comuna = $request->comuna;
        $location->address = $request->address;
        $location->latitude = $request->latitude;
        $location->longitude = $request->longitude;
        $location->save();

        return response()->json([
            'message' => 'Location updated successfully',
            'location' => $location
        ]);
    }
}
