<?php

namespace App\Http\Controllers\Api\Actors\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Actors\DoctorResource;
use App\Http\Requests\Actors\Doctor\StoreDoctorRequest;
use App\Http\Requests\Actors\Doctor\DoctorProfileUpdateRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return DoctorResource::collection(Doctor::with('category')->get());
        return DoctorResource::collection(Doctor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreDoctorRequest $request)
    // {
    //     // $doctor = auth()->user()->doctors()->create($request->validated());

    //     // return new DoctorResource($doctor);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return $this->isNotAuthorized($doctor) ? $this->isNotAuthorized($doctor) : new DoctorResource($doctor);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(DoctorProfileUpdateRequest $req)
    // {
    //     $data = $req->validated();

    //     if ($req->id != auth()->user()->id) {
    //         return response()->json([
    //             'status' => 'Error has occured...',
    //             'message' => "You are not authorized to view this doctor's profile",
    //             'data' => ''
    //         ], 403);
    //     }

    //     return new DoctorResource($doctor);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        return $this->isNotAuthorized($doctor) ? $this->isNotAuthorized($doctor) : $doctor->delete();
    }

    private function isNotAuthorized($doctor)
    {
        if ($doctor->id != auth()->user()->id) {
            return response()->json([
                'status' => 'Error has occured...',
                'message' => "You are not authorized to view this doctor's profile",
                'data' => ''
            ], 403);
        }
    }
}
