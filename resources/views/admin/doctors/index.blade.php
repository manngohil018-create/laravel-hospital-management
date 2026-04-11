@extends('layouts.admin')

@section('content')
<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
        flex-wrap: wrap;
    }
    .header h2 {
        margin: 0;
        color: #333;
    }
    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-form input {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        min-width: 240px;
    }
    .search-form button {
        padding: 10px 18px;
        border: none;
        border-radius: 6px;
        background: #667eea;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
    }
    .search-form button:hover {
        opacity: 0.9;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        transition: transform 0.2s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .table-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead tr {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
    }
    tbody tr:hover {
        background: #f8f9fa;
    }
    .action-links {
        display: flex;
        gap: 10px;
    }
    .btn-edit {
        color: #28a745;
        text-decoration: none;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all 0.3s;
    }
    .btn-edit:hover {
        background: #e8f5e9;
    }
    .btn-delete {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all 0.3s;
    }
    .btn-delete:hover {
        background: #ffe8e8;
    }
    .empty {
        text-align: center;
        padding: 40px;
        color: #999;
    }
</style>

<div class="header">
    <div>
        <h2>👨‍⚕️ Manage Doctors</h2>
        @if(!empty($search))
            <p style="margin: 5px 0 0; color: #555;">Search results for: <strong>{{ $search }}</strong></p>
        @endif
    </div>
    <div class="header-actions">
        <form method="GET" action="{{ route('admin.doctors.index') }}" class="search-form">
            <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Search doctor name, specialization, email or phone">
            <button type="submit">Search</button>
        </form>
        <a href="{{ route('admin.doctors.create') }}" class="btn-primary">+ Add Doctor</a>
    </div>
</div>

<div class="table-container">
    @if($doctors->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Specialization</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td>
                    @if(!empty($doctor->photo))
                        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" style="width:56px;height:56px;object-fit:contain;border-radius:6px">
                    @else
                        <div style="width:56px;height:56px;background:#f0f0f0;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#999">👤</div>
                    @endif
                </td>
                <td><strong>{{ $doctor->name }}</strong></td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->phone ?? 'N/A' }}</td>
                <td>
                    <div class="action-links">
                        <a href="{{ route('admin.doctors.edit',$doctor->id) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('admin.doctors.destroy',$doctor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Delete this doctor?');">🗑️ Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty">
        <p>No doctors found. <a href="{{ route('admin.doctors.create') }}">Add one now</a></p>
    </div>
    @endif
</div>

@endsection
