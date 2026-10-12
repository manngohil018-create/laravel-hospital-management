<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\Doctor;
use App\Models\User;
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
       $existingAccount = User::where('email', $request->input('email'))->first();
       $validated = $request->validate([
           'name' => 'required|string',
           'specialization' => 'required|string',
           'phone' => 'required|string',
           'email' => 'required|email|unique:doctors,email',
           'password' => ['required', 'string', 'min:8', 'confirmed'],
           'about' => 'nullable|string',
           'photo' => 'nullable|image|max:2048',
       ]);

       if ($existingAccount && $existingAccount->role !== 'doctor') {
           return back()->withErrors([
               'email' => 'This email is already assigned to a non-doctor account.',
           ])->withInput();
       }

       $data = collect($validated)->only(['name', 'specialization', 'phone', 'email', 'about'])->all();

       if ($request->hasFile('photo')) {
           $data['photo'] = $request->file('photo')->store('doctors', 'public');
       }

       DB::transaction(function () use ($data, $existingAccount, $validated) {
           $doctor = Doctor::create($data);

           if ($existingAccount) {
               $existingAccount->update([
                   'name' => $doctor->name,
                   'phone' => $doctor->phone,
                   'password' => Hash::make($validated['password']),
               ]);
               return;
           }

           User::create([
               'username' => $this->availableDoctorUsername($doctor->id),
               'name' => $doctor->name,
               'email' => $doctor->email,
               'phone' => $doctor->phone,
               'password' => Hash::make($validated['password']),
               'role' => 'doctor',
           ]);
       });

       return redirect()->route('admin.doctors.index')->with('success', 'Doctor and login account added successfully.');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctorAccountExists = User::where('email', $doctor->email)
            ->where('role', 'doctor')
            ->exists();

        return view('admin.doctors.edit', compact('doctor', 'doctorAccountExists'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctorAccount = User::where('email', $doctor->email)
            ->where('role', 'doctor')
            ->first();
        $validated = $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'phone' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('doctors', 'email')->ignore($doctor->id),
                Rule::unique('users', 'email')->ignore($doctorAccount?->id),
            ],
            'password' => [$doctorAccount ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
            'about' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = collect($validated)->only(['name', 'specialization', 'phone', 'email', 'about'])->all();

        if ($request->hasFile('photo')) {
            // remove old photo if exists
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($data);

        if ($doctorAccount) {
            $accountData = [
                'name' => $doctor->name,
                'email' => $doctor->email,
                'phone' => $doctor->phone,
            ];

            if (!empty($validated['password'])) {
                $accountData['password'] = Hash::make($validated['password']);
            }

            $doctorAccount->update($accountData);
        } else {
            User::create([
                'username' => $this->availableDoctorUsername($doctor->id),
                'name' => $doctor->name,
                'email' => $doctor->email,
                'phone' => $doctor->phone,
                'password' => Hash::make($validated['password']),
                'role' => 'doctor',
            ]);
        }

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor and login account updated successfully.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        User::where('email', $doctor->email)
            ->where('role', 'doctor')
            ->delete();

        if ($doctor->photo) {
            Storage::disk('public')->delete($doctor->photo);
        }
        $doctor->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor Deleted Successfully!');
    }

    private function availableDoctorUsername(int $doctorId): string
    {
        $username = 'doctor-' . $doctorId;
        $suffix = 1;

        while (User::where('username', $username)->exists()) {
            $username = 'doctor-' . $doctorId . '-' . $suffix++;
        }

        return $username;
    }

}
