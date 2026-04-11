@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1100px;margin:24px auto">
    <h2>My Appointments</h2>

    @if(session('success'))
        <div style="background:#d1fae5;padding:12px;border-radius:6px;margin-bottom:12px;color:#065f46">{{ session('success') }}</div>
    @endif

    @if(isset($appointments) && $appointments->count())
        <table style="width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden">
            <thead>
                <tr style="background:#f8fafc;color:#334155">
                    <th style="padding:12px">Patient</th>
                    <th style="padding:12px">Date</th>
                    <th style="padding:12px">Status</th>
                    <th style="padding:12px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appt)
                <tr>
                    <td style="padding:12px">{{ optional($appt->patient)->name ?? 'N/A' }}<div style="font-size:12px;color:#64748b">{{ optional($appt->patient)->email ?? '' }}</div></td>
                    <td style="padding:12px">{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M, Y H:i') }}</td>
                    <td style="padding:12px">{{ ucfirst($appt->status) }}</td>
                    <td style="padding:12px">
                        <form action="{{ route('doctor.appointment.update-status', $appt->id) }}" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="status" value="confirmed">
                            <button class="btn" type="submit">Confirm</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:12px">{{ $appointments->links() }}</div>
    @else
        <div style="background:#fff;padding:18px;border-radius:8px">No appointments found.</div>
    @endif
</div>
@endsection
