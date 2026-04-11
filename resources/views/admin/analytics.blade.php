@extends('layouts.admin')

@section('content')
<style>
    .analytics-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e0e0e0;
    }
    .analytics-header h2 {
        margin: 0;
        color: #333;
        font-size: 28px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .stat-card h4 {
        margin: 0 0 10px 0;
        font-size: 14px;
        opacity: 0.9;
    }
    .stat-card .number {
        font-size: 32px;
        font-weight: bold;
    }
    body.dark-mode .stat-card {
        background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
    }
    .chart-container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }
    body.dark-mode .chart-container {
        background: #2d3748;
        color: #e2e8f0;
    }
    .chart-container h3 {
        margin-top: 0;
        color: #333;
    }
    body.dark-mode .chart-container h3 {
        color: #e2e8f0;
    }
    canvas {
        max-height: 400px;
    }
</style>

<div class="analytics-header">
    <h2>📊 Analytics Dashboard</h2>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h4>Total Appointments</h4>
        <div class="number">{{ $totalAppointments }}</div>
    </div>
    
    <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
        <h4>Pending Appointments</h4>
        <div class="number">{{ $pendingAppointments }}</div>
    </div>
    
    <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
        <h4>Completed Appointments</h4>
        <div class="number">{{ $completedAppointments }}</div>
    </div>
    
    <div class="stat-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
        <h4>Total Doctors</h4>
        <div class="number">{{ $totalDoctors }}</div>
    </div>
</div>

<div class="chart-container">
    <h3>📈 Monthly Appointments Trend</h3>
    <canvas id="monthlyChart"></canvas>
</div>

<div class="chart-container">
    <h3>👨‍⚕️ Top Doctors Performance</h3>
    <canvas id="doctorChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
<script>
    // Monthly Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = {
        @foreach($monthlyAppointments as $item)
            '{{ $item->month }}': {{ $item->count }},
        @endforeach
    };
    
    const monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const monthlyValues = [];
    for(let i = 1; i <= 12; i++) {
        const key = String(i).padStart(2, '0');
        monthlyValues.push(monthlyData[key] || 0);
    }

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Appointments',
                data: monthlyValues,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBorderColor: '#667eea',
                pointBackgroundColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: document.body.classList.contains('dark-mode') ? '#e2e8f0' : '#333'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: document.body.classList.contains('dark-mode') ? '#cbd5e0' : '#666'
                    },
                    grid: {
                        color: document.body.classList.contains('dark-mode') ? '#4a5568' : '#f0f0f0'
                    }
                },
                x: {
                    ticks: {
                        color: document.body.classList.contains('dark-mode') ? '#cbd5e0' : '#666'
                    },
                    grid: {
                        color: document.body.classList.contains('dark-mode') ? '#4a5568' : '#f0f0f0'
                    }
                }
            }
        }
    });

    // Doctor Performance Chart
    const doctorCtx = document.getElementById('doctorChart').getContext('2d');
    const doctorLabels = [
        @foreach($doctorStats as $doctor)
            '{{ $doctor->name }}',
        @endforeach
    ];
    const doctorData = [
        @foreach($doctorStats as $doctor)
            {{ $doctor->appointments_count }},
        @endforeach
    ];

    new Chart(doctorCtx, {
        type: 'bar',
        data: {
            labels: doctorLabels,
            datasets: [{
                label: 'Total Appointments',
                data: doctorData,
                backgroundColor: [
                    '#667eea',
                    '#764ba2',
                    '#f093fb',
                    '#f5576c',
                    '#4facfe'
                ],
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: document.body.classList.contains('dark-mode') ? '#e2e8f0' : '#333'
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: document.body.classList.contains('dark-mode') ? '#cbd5e0' : '#666'
                    },
                    grid: {
                        color: document.body.classList.contains('dark-mode') ? '#4a5568' : '#f0f0f0'
                    }
                },
                y: {
                    ticks: {
                        color: document.body.classList.contains('dark-mode') ? '#cbd5e0' : '#666'
                    },
                    grid: {
                        color: document.body.classList.contains('dark-mode') ? '#4a5568' : '#f0f0f0'
                    }
                }
            }
        }
    });
</script>

@endsection
