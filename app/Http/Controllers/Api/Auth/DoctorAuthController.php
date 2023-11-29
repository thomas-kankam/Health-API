<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Actors\Doctor\LoginDoctorRequest;
use App\Http\Requests\Actors\Doctor\StoreDoctorRequest;

class DoctorAuthController extends Controller
{
    public function register(StoreDoctorRequest $request)
    {
        $data = $request->validated();

        // Concatenate the parameters and generate a random string
        $alias = Str::slug($data['first_name'] . $data['last_name'] . $data['email'] . $data['phone_number'] . Str::random(5));

        $doctor = Doctor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'agree' => $data['agree'],
            'alias' => $alias,
        ]);

        $token = $doctor->createToken('Api token for ' . $doctor->first_name . ' ' . $doctor->last_name)->plainTextToken;

        return response()->json(['message' => 'Doctor registered successfully', 'data' => $doctor, 'token' => $token, 'status' => 200]);
    }

    public function login(LoginDoctorRequest $request)
    {
        // Perform user authentication, e.g., validate credentials
        $request->validated();

        $doctor = Doctor::where('phone_number', $request->phone_number)->first();

        if (!$doctor || !Hash::check($request->password, $doctor->password)) {
            throw ValidationException::withMessages([
                'phone_number' => ['The provided credentials are incorrect.'],
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $doctor->createToken('Api token for ' . $doctor->first_name . ' ' . $doctor->last_name)->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'data' => $doctor,
        ]);
    }

    // public function logout(Request $request)
    // {
    //     $doctor = $request->user(); // Get the currently authenticated user

    //     if ($doctor) {
    //         $doctor->tokens()->delete(); // Revoke all of the user's tokens
    //     }

    //     return response()->noContent();
    // }

    public function logout(Request $request)
    {

        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        // $request->user->tokens()->delete(); // use this to revoke all tokens (logout from all devices)
        return response()->json(['message' => 'You have successfully been logged out and your token has been deleted', 'data' => '', 'status' => 'Request successful']);
    }
}
