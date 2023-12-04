<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Patient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Actors\Patient\LoginPatientRequest;

class PatientAuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate();

        $patient = Patient::create([
            'full_name' => $data['full_name'],
            "phone" => $data["phone"],
            'email' => $data['email'],
            "password" => Hash::make($data["password"]),
        ]);

        # Send verification email
        // event(new Registered($doctor));

        $token = $patient->createToken('Api token for ' . $patient->first_name . ' ' . $patient->last_name)->plainTextToken;

        return response()->json(['message' => 'Doctor registered successfully', 'data' => $patient, 'token' => $token, 'status' => 200]);
    }

    public function login(LoginPatientRequest $request)
    {
        // Perform user authentication, e.g., validate credentials
        $request->validated();

        $patient = Patient::where('email', $request->email)->first();

        if (!$patient || !Hash::check($request->password, $patient->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $patient->createToken('Api token for ' . $patient->first_name . ' ' . $patient->last_name)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'data' => $patient,
            'status' => 200
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        // $request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)
        return response()->json(['message' => 'You have successfully been logged out and your token has been deleted', 'status' => 504]);
    }
}
