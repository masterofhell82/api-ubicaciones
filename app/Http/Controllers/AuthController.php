<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\LocationController;


class AuthController extends Controller
{

    /**
     * Validate the login request and attempt to log the user in.
     *
     * @param Request $request The request instance
     * @return mixed
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            $request->session()->regenerate();

            $locationData = [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ];

            // Se crea una nueva instancia de Request con los datos de ubicación
            $locationRequest = new Request($locationData);

            // Crea una nueva instancia de LocationController y llama al método store
            $locationController = new LocationController;
            $locationController->store($locationRequest);

            return auth()->user();
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Logs out the user and invalidates the session.
     *
     * @param Request $request The request object.
     * @return \Illuminate\Http\JsonResponse The JSON response with the message 'logout'.
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'logout'], 200);
    }
}
