<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Actors\Doctor\LoginDoctorRequest;
use App\Http\Requests\Actors\Doctor\StoreDoctorRequest;

class DoctorAuthController extends Controller
{
    public function register(StoreDoctorRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if (request()->hasFile('profile_image')) {
            $imagePath = request('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $imagePath;
        }

        $doctor = Doctor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'hospital_name' => $data['hospital_name'],
            'national_id' => $data['national_id'],
            'phone_number' => $data['phone_number'],
            'national_id_front_image' => $data['national_id_front_image'],
            'national_id_back_image' => $data['national_id_back_image'],
            'passport_picture' => $data['passport_picture'],
            'profile_image' => $data['profile_image'] ?? null, // Make sure to include the profile_image field
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

    public function storeReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
