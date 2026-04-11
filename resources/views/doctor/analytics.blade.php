@extends('layouts.doctor')

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
    .chart-container {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }
    .chart-container h3 {
        margin-top: 0;
        color: #333;
    }
    canvas {
        max-height: 400px;
    }
</style>

<div class="analytics-header">
    <h2>📊 My Analytics</h2>
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
        <h4>Cancelled Appointments</h4>
        <div class="number">{{ $cancelledAppointments }}</div>
    </div>
</div>

<div class="chart-container">
    <h3>📈 Monthly Appointments Trend</h3>
    <canvas id="monthlyChart"></canvas>
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
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#666'
                    },
                    grid: {
                        color: '#f0f0f0'
                    }
                },
                x: {
                    ticks: {
                        color: '#666'
                    },
                    grid: {
                        color: '#f0f0f0'
                    }
                }
            }
        }
    });
</script>

@endsection
