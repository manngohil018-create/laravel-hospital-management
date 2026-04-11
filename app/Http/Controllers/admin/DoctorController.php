<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Doctor;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = Doctor::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $doctors = $query->paginate(10)->withQueryString();

        return view('admin.doctors.index', compact('doctors', 'search'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:doctors,email',
            'about' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'name',
            'specialization',
            'phone',
            'email',
            'about'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        Doctor::create($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor Added Successfully!');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:doctors,email,' . $id,
            'about' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'name',
            'specialization',
            'phone',
            'email',
            'about'
        ]);

        if ($request->hasFile('photo')) {
            // remove old photo if exists
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($data);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor Updated Successfully!');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor Deleted Successfully!');
    }

}
