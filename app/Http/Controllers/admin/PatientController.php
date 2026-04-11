<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::where('role', 'patient');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('disease_illness', 'like', "%{$search}%")
                    ->orWhere('medical_history', 'like', "%{$search}%");
            });
        }

        $patients = $query->paginate(10)->withQueryString();
        return view('admin.patients.index', compact('patients', 'search'));
    }

    public function show($id)
    {
        $patient = User::findOrFail($id);
        $appointments = $patient->appointments()->with('doctor')->latest()->get();
        return view('admin.patients.show', compact('patient', 'appointments'));
    }

    public function edit($id)
    {
        $patient = User::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'disease_illness' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $patient->update($request->only([
            'name',
            'email',
            'phone',
            'disease_illness',
            'medical_history',
        ]));

        return redirect()->route('admin.patients')->with('success', 'Patient information updated successfully');
    }

    public function destroy($id)
    {
        $patient = User::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patients')->with('success', 'Patient deleted successfully');
    }
}
