@extends('layouts.app')

@section('title', 'Admin Analytics')

@section('content')

    <style>
        /* PAGE BACKGROUND */

        body {
            background: #f6f8f9;
        }

        /* GRID LAYOUT */

        .analytics-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
            gap: 25px;
        }

        /* CARD */

        .analytics-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            padding: 25px;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        /* TITLES */

        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* CHART CONTAINER */

        .chart-container {
            flex: 1;
            position: relative;
            min-height: 280px;
        }

        /* CLIENT LIST */

        .clients-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #f1f1f1;
        }

        .list-group-item:hover {
            background: #f1f7f8;
        }

        /* RESPONSIVE */

        @media(max-width:768px) {

            .analytics-container {
                grid-template-columns: 1fr;
            }

        }
    </style>


    <div class="container py-4">

        <h2 class="mb-4" style="font-weight:700;color:#2c3e50;">
            Analytics Dashboard
        </h2>

        <div class="analytics-container">

            {{-- Orders Over Time --}}

            <div class="analytics-card">

                <h5 class="section-title">Orders Over Time</h5>

                <div class="chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>

            </div>


            {{-- Status Distribution --}}

            <div class="analytics-card">

                <h5 class="section-title">Order Status Distribution</h5>

                <div class="chart-container">
                    <canvas id="statusChart"></canvas>
                </div>

            </div>


            {{-- Popular Items --}}

            <div class="analytics-card">

                <h5 class="section-title">Most Popular Menu Items</h5>

                <div class="chart-container">
                    <canvas id="itemsChart"></canvas>
                </div>

            </div>


            {{-- Most Active Clients --}}

            <div class="analytics-card">

                <h5 class="section-title">Most Active Clients</h5>

                <div class="clients-list">

                    <ul class="list-group">

                        @foreach($topClients as $client)

                            <li class="list-group-item d-flex justify-content-between">

                                {{ $client->user->name }}

                                <span class="text-muted">{{ $client->total }} orders</span>

                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>


        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        /* Orders Over Time */

        new Chart(document.getElementById('ordersChart'), {

            type: 'line',

            data: {
                labels: {!! json_encode($ordersChartLabels) !!},

                datasets: [{

                    label: 'Orders',

                    data: {!! json_encode($ordersChartData) !!},

                    borderColor: '#0a7f8a',

                    backgroundColor: 'rgba(10,127,138,0.15)',

                    tension: 0.4,

                    fill: true

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });


        /* Status Distribution */

        new Chart(document.getElementById('statusChart'), {

            type: 'doughnut',

            data: {

                labels: {!! json_encode($statusLabels) !!},

                datasets: [{

                    data: {!! json_encode($statusData) !!},

                    backgroundColor: [
                        '#ffc107',   // pending
                        '#0a7f8a',   // approved
                        '#dc3545'    // cancelled
                    ]

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });


        /* Popular Items */

        new Chart(document.getElementById('itemsChart'), {

            type: 'bar',

            data: {

                labels: {!! json_encode($itemLabels) !!},

                datasets: [{

                    label: 'Orders',

                    data: {!! json_encode($itemData) !!},

                    backgroundColor: '#0a7f8a'

                }]

            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });

    </script>

@endsection