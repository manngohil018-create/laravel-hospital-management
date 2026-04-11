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
        transition: all 0.3s ease;
    }
    tbody tr:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
    .disease-badge {
        display: inline-block;
        background: #fff3cd;
        color: #856404;
        padding: 8px 12px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 500;
    }
    .action-links {
        display: flex;
        gap: 10px;
    }
    .btn-view {
        color: #0072ff;
        text-decoration: none;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 3px;
        transition: all 0.3s;
    }
    .btn-view:hover {
        background: #e7f1ff;
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
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
    .modal-overlay.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content-wrapper {
        background: white;
        padding: 40px;
        border-radius: 10px;
        width: 500px;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }
    .modal-close {
        float: right;
        font-size: 28px;
        cursor: pointer;
        color: #666;
    }
    .modal-close:hover {
        color: #dc3545;
    }
    .modal-detail-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .modal-detail-item {
        margin-bottom: 15px;
    }
    .modal-detail-item strong {
        color: #667eea;
        display: block;
        margin-bottom: 5px;
    }
    .modal-detail-item p {
        margin: 5px 0;
        color: #666;
    }
    .modal-close-btn {
        margin-top: 20px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }
    .modal-close-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
</style>

<div class="header">
    <div>
        <h2>👥 Manage Patients</h2>
        @if(!empty($search))
            <p style="margin: 5px 0 0; color: #555;">Search results for: <strong>{{ $search }}</strong></p>
        @endif
    </div>
    <div class="header-actions">
        <form method="GET" action="{{ route('admin.patients') }}" class="search-form">
            <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Search patient name, email, phone, illness">
            <button type="submit">Search</button>
        </form>
    </div>
</div>

<div class="table-container">
    @if($patients->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Disease/Illness</th>
                <th>Medical History</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td><strong>{{ $patient->name }}</strong></td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone ?? 'N/A' }}</td>
                <td>
                    @if($patient->disease_illness)
                        <span class="disease-badge">{{ $patient->disease_illness }}</span>
                    @else
                        <span style="color: #999;">Not specified</span>
                    @endif
                </td>
                <td>
                    @if($patient->medical_history)
                        <small>{{ substr($patient->medical_history, 0, 40) }}...</small>
                    @else
                        <span style="color: #999;">-</span>
                    @endif
                </td>
                <td>
                    <div class="action-links">
                        <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn-view">👁️ View</a>
                        <form action="{{ route('admin.patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete" onclick="return confirm('Delete this patient?');">🗑️ Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty">
        <p>No patients found.</p>
    </div>
    @endif
</div>

<!-- Modal for viewing patient details -->
<div id="patientModal" class="modal-overlay">
    <div class="modal-content-wrapper">
        <span class="modal-close" onclick="document.getElementById('patientModal').classList.remove('show')">&times;</span>
        <h2 id="patientName"></h2>
        <div class="modal-detail-section">
            <div class="modal-detail-item">
                <strong>Email:</strong>
                <p id="patientEmail"></p>
            </div>
            <div class="modal-detail-item">
                <strong>Phone:</strong>
                <p id="patientPhone"></p>
            </div>
            <div class="modal-detail-item">
                <strong>Disease/Illness:</strong>
                <p id="patientDisease"></p>
            </div>
            <div class="modal-detail-item">
                <strong>Medical History:</strong>
                <p id="patientHistory"></p>
            </div>
        </div>
        <button class="modal-close-btn" onclick="document.getElementById('patientModal').classList.remove('show')">Close</button>
    </div>
</div>

<script>
    function showPatientDetails(id, name, email, phone, disease, history) {
        document.getElementById('patientName').textContent = name;
        document.getElementById('patientEmail').textContent = email || 'N/A';
        document.getElementById('patientPhone').textContent = phone || 'N/A';
        document.getElementById('patientDisease').textContent = disease || 'Not specified';
        document.getElementById('patientHistory').textContent = history || 'Not available';
        document.getElementById('patientModal').classList.add('show');
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('patientModal');
        if (event.target === modal) {
            modal.classList.remove('show');
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            document.getElementById('patientModal').classList.remove('show');
        }
    });
</script>

@endsection
