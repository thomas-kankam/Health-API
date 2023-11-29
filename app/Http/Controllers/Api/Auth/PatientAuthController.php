<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PatientAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate();

        // $data['password'] = Hash::make($data['password']);

        $doctor = Patient::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            "phone" => $data["phone"],
            "password" => Hash::make($data["password"]),
            "agree" => $data["agree"],
            "alias" => Str::random(30)
        ]);

        # Send verification email
        // event(new Registered($doctor));

        $token = $doctor->createToken($data['device_name'])->plainTextToken;

        return response()->json(['message' => 'Patient registered successfully', 'token' => $token]);
    }

    public function login(Request $request)
    {
        // Perform user authentication, e.g., validate credentials
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient || !Hash::check($request->password, $patient->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $patient->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $patient = $request->user(); // Get the currently authenticated user

        if ($patient) {
            $patient->tokens()->delete(); // Revoke all of the user's tokens
        }

        return response()->noContent();
    }
}
