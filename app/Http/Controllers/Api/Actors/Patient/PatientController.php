<?php

namespace App\Http\Controllers\Api\Actors\Patient;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Actors\PatientResource;
use App\Http\Requests\Actors\Patient\StorePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return PatientResource::collection(Patient::with('category')->get());
        return PatientResource::collection(Patient::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        return new PatientResource(Patient::create($request->validated()));
    }


    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return new PatientResource($patient);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->validated());

        return new PatientResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->noContent();
    }
}
