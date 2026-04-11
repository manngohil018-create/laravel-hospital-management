@extends('layouts.admin')

@section('content')
<style>
    .calendar-container {
        background: var(--bg-primary);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
        flex-wrap: wrap;
        gap: 15px;
    }

    .calendar-header h2 {
        margin: 0;
        color: var(--text-primary);
        font-size: 24px;
    }

    .filter-section {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-section select {
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        color: var(--text-primary);
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .filter-section select:hover {
        border-color: #667eea;
    }

    .filter-section select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    #calendar {
        font-family: 'Poppins', sans-serif;
    }

    .fc {
        color: var(--text-primary);
    }

    .fc .fc-button-primary {
        background-color: #667eea;
        border-color: #667eea;
        font-size: 13px;
        padding: 4px 8px;
    }

    .fc .fc-button-primary:hover {
        background-color: #764ba2;
        border-color: #764ba2;
    }

    .fc .fc-button-primary.fc-button-active {
        background-color: #764ba2;
        border-color: #764ba2;
    }

    .fc-daygrid-day:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }

    .fc-event {
        border-radius: 5px;
        border: none;
        padding: 2px !important;
        cursor: pointer;
        transition: all 0.3s;
    }

    .fc-event:hover {
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .event-pending {
        background-color: #ffc107 !important;
    }

    .event-confirmed {
        background-color: #17a2b8 !important;
    }

    .event-completed {
        background-color: #28a745 !important;
    }

    .event-cancelled {
        background-color: #dc3545 !important;
    }

    .event-expired {
        background-color: #6c757d !important;
        opacity: 0.7;
        text-decoration: line-through;
    }

    .fc-daygrid-day-number {
        color: var(--text-primary);
        padding: 8px !important;
    }

    .fc-col-header-cell {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        border-color: var(--border-color);
        font-weight: 600;
        padding: 10px !important;
    }

    .fc-daygrid-day {
        background-color: var(--bg-primary);
        border-color: var(--border-color);
    }

    .fc-daygrid-day.fc-day-other {
        background-color: var(--bg-secondary);
    }

    .fc-button-group {
        gap: 5px;
    }

    .fc-toolbar {
        margin-bottom: 1.5em;
        flex-wrap: wrap;
        gap: 10px;
    }

    .legend {
        display: flex;
        gap: 20px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 3px;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: var(--bg-primary);
        border-radius: 12px;
        padding: 30px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--border-color);
    }

    .modal-header h3 {
        margin: 0;
        color: var(--text-primary);
        font-size: 20px;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: var(--text-secondary);
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: var(--text-primary);
    }

    .appointment-detail {
        margin: 15px 0;
        display: flex;
        gap: 15px;
    }

    .appointment-detail label {
        font-weight: 600;
        color: var(--text-primary);
        min-width: 120px;
        display: flex;
        align-items: center;
    }

    .appointment-detail span {
        color: var(--text-secondary);
        flex: 1;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: white;
        text-transform: capitalize;
    }

    .status-badge.pending {
        background-color: #ffc107;
    }

    .status-badge.confirmed {
        background-color: #17a2b8;
    }

    .status-badge.completed {
        background-color: #28a745;
    }

    .status-badge.cancelled {
        background-color: #dc3545;
    }

    .status-badge.expired {
        background-color: #6c757d;
        text-decoration: line-through;
    }

    .modal-footer {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid var(--border-color);
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background-color: #667eea;
        color: white;
    }

    .btn-primary:hover {
        background-color: #764ba2;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .btn-secondary {
        background-color: var(--bg-secondary);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
    }

    .btn-secondary:hover {
        background-color: var(--border-color);
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .today-indicator {
        background-color: rgba(102, 126, 234, 0.1) !important;
        border-left: 4px solid #667eea;
    }

    body.dark-mode .calendar-container {
        background: #1e2139;
    }

    body.dark-mode .fc {
        background-color: #1e2139;
    }

    body.dark-mode .fc .fc-daygrid-day {
        background-color: #1e2139;
    }

    body.dark-mode .fc .fc-daygrid-day.fc-day-other {
        background-color: #15172a;
    }

    body.dark-mode .fc .fc-col-header-cell {
        background-color: #15172a;
    }

    body.dark-mode .fc .fc-daygrid-day-number {
        color: #e2e2e2;
    }

    body.dark-mode .fc .fc-daygrid-day-frame {
        background-color: #1e2139;
    }

    body.dark-mode .fc-daygrid-day:hover {
        background-color: rgba(102, 126, 234, 0.1) !important;
    }

    body.dark-mode .modal-content {
        background: #1e2139;
        color: #e2e2e2;
    }

    .today-appointments {
        background: var(--bg-primary);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .today-appointments h3 {
        color: var(--text-primary);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .appointment-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        background: var(--bg-secondary);
        border-radius: 6px;
        margin-bottom: 10px;
        border-left: 4px solid #667eea;
    }

    .appointment-item:last-child {
        margin-bottom: 0;
    }

    .appointment-info {
        flex: 1;
    }

    .appointment-time {
        font-weight: 600;
        color: var(--text-primary);
    }

    .appointment-details {
        font-size: 13px;
        color: var(--text-secondary);
        margin-top: 4px;
    }

    @media (max-width: 768px) {
        .calendar-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-section {
            width: 100%;
        }

        .filter-section select {
            flex: 1;
        }

        .fc-toolbar {
            flex-direction: column;
            gap: 0;
        }

        .fc-button-group {
            width: 100%;
        }

        .modal-content {
            width: 95%;
            padding: 20px;
        }

        .modal-footer {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            text-align: center;
        }

        .legend {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<!-- Today's Appointments Section -->
@php
    $todayFormatted = \Carbon\Carbon::today()->format('Y-m-d');
    $todayAppointments = $appointments->filter(function($a) use ($todayFormatted) {
        return \Carbon\Carbon::parse($a->appointment_date)->format('Y-m-d') === $todayFormatted;
    })->sortBy(function($a) {
        return $a->appointment_date;
    });
@endphp

@if($todayAppointments->count())
<div class="today-appointments">
    <h3>📌 Today's Appointments</h3>
    @forelse($todayAppointments as $appt)
        <div class="appointment-item">
            <div class="appointment-info">
                <div class="appointment-time">
                    {{ \Carbon\Carbon::parse($appt->appointment_date)->format('H:i') }} - {{ $appt->patient->name ?? 'Unknown' }}
                </div>
                <div class="appointment-details">
                    👨‍⚕️ {{ $appt->doctor->name ?? 'Unknown' }} | <span class="status-badge {{ $appt->getDisplayStatus() }}">{{ $appt->getDisplayStatus() }}</span>
                </div>
            </div>
        </div>
    @empty
        <p style="color: var(--text-secondary); margin: 0;">No appointments scheduled for today.</p>
    @endforelse
</div>
@endif

<!-- Calendar Container -->
<div class="calendar-container">
    <div class="calendar-header">
        <h2>📅 Appointment Calendar</h2>
        <div class="filter-section">
            <select id="doctorFilter">
                <option value="">All Doctors</option>
                @foreach($doctors as $doc)
                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                @endforeach
            </select>

            <select id="statusFilter">
                <option value="">All Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary" onclick="resetFilters()">Reset Filters</button>
        </div>
    </div>

    <div id="calendar"></div>

    <div class="legend">
        <div class="legend-item">
            <div class="legend-color" style="background-color: #ffc107;"></div>
            <span>Pending</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: #17a2b8;"></div>
            <span>Confirmed</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: #28a745;"></div>
            <span>Completed</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: #dc3545;"></div>
            <span>Cancelled</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background-color: #6c757d;"></div>
            <span>Expired</span>
        </div>
    </div>
</div>

<!-- Appointment Detail Modal -->
<div id="appointmentModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Appointment Details</h3>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>

        <div id="modalBody">
            <!-- Content will be filled dynamically -->
        </div>

        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal()">Close</button>
            <a id="editBtn" href="#" class="btn btn-primary">Edit Appointment</a>
            <button class="btn btn-danger" onclick="deleteAppointment()">Delete</button>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
    let calendar;
    let currentAppointmentId = null;

    document.addEventListener('DOMContentLoaded', function() {
        initializeCalendar();
        setupFilterListeners();
    });

    function initializeCalendar() {
        const calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            height: 'auto',
            eventDisplay: 'block',
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: 'short'
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: 'short'
            },
            events: function(info, successCallback, failureCallback) {
                fetchEvents(successCallback);
            },
            eventClick: function(info) {
                showAppointmentDetails(info.event);
            },
            datesSet: function(info) {
                console.log('Calendar view changed');
            },
            dayCellDidMount: function(info) {
                if (info.date.toDateString() === new Date().toDateString()) {
                    info.el.classList.add('today-indicator');
                }
            }
        });
        calendar.render();
    }

    function fetchEvents(callback) {
        const doctorId = document.getElementById('doctorFilter').value;
        const status = document.getElementById('statusFilter').value;

        let url = '{{ route("admin.calendar.events") }}';
        const params = new URLSearchParams();

        if (doctorId) params.append('doctor_id', doctorId);
        if (status) params.append('status', status);

        if (params.toString()) {
            url += '?' + params.toString();
        }

        fetch(url)
            .then(res => res.json())
            .then(data => callback(data))
            .catch(error => {
                console.error('Error fetching events:', error);
                callback([]);
            });
    }

    function setupFilterListeners() {
        document.getElementById('doctorFilter').addEventListener('change', function() {
            calendar.refetchEvents();
        });

        document.getElementById('statusFilter').addEventListener('change', function() {
            calendar.refetchEvents();
        });
    }

    function resetFilters() {
        document.getElementById('doctorFilter').value = '';
        document.getElementById('statusFilter').value = '';
        calendar.refetchEvents();
    }

    function showAppointmentDetails(event) {
        currentAppointmentId = event.id;
        const props = event.extendedProps;

        const html = `
            <div class="appointment-detail">
                <label>Patient Name:</label>
                <span><strong>${props.patient_name}</strong></span>
            </div>
            <div class="appointment-detail">
                <label>Patient Phone:</label>
                <span>${props.patient_phone}</span>
            </div>
            <div class="appointment-detail">
                <label>Doctor:</label>
                <span><strong>${props.doctor_name}</strong></span>
            </div>
            <div class="appointment-detail">
                <label>Date:</label>
                <span>${props.date}</span>
            </div>
            <div class="appointment-detail">
                <label>Time:</label>
                <span><strong>${props.time}</strong></span>
            </div>
            <div class="appointment-detail">
                <label>Status:</label>
                <span><span class="status-badge ${props.status}">${props.status}</span></span>
            </div>
            ${props.is_emergency ? `
            <div class="appointment-detail">
                <label>Emergency:</label>
                <span><strong style="color: #c81e1e;">Yes</strong></span>
            </div>
            <div class="appointment-detail">
                <label>Emergency Details:</label>
                <span>${props.emergency_details || 'Not provided'}</span>
            </div>
            ` : ''}
        `;

        document.getElementById('modalBody').innerHTML = html;
        document.getElementById('editBtn').href = '/admin/appointments/' + event.id + '/edit';

        const modal = document.getElementById('appointmentModal');
        modal.classList.add('show');
    }

    function closeModal() {
        const modal = document.getElementById('appointmentModal');
        modal.classList.remove('show');
        currentAppointmentId = null;
    }

    function deleteAppointment() {
        if (!currentAppointmentId) return;

        if (!confirm('Are you sure you want to delete this appointment?')) {
            return;
        }

        fetch('/admin/appointments/' + currentAppointmentId, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Content-Type': 'application/json'
            }
        })
        .then(res => {
            if (res.ok) {
                closeModal();
                calendar.refetchEvents();
                alert('Appointment deleted successfully!');
            } else {
                alert('Error deleting appointment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting appointment');
        });
    }

    window.onclick = function(event) {
        const modal = document.getElementById('appointmentModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

@endsection
