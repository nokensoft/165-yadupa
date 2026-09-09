@extends('layouts.dashboard')
@section('title', 'Statistik Pengunjung')
@section('page-title', 'Statistik Pengunjung')

@section('content')
    <style>
        @media print {
            body {
                background: #fff !important;
            }

            body * {
                visibility: hidden;
            }

            #print-statistik-content,
            #print-statistik-content * {
                visibility: visible;
            }

            #print-statistik-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            #print-statistik-content .print-hide {
                display: none !important;
            }

            #print-statistik-content .shadow-sm {
                box-shadow: none !important;
            }
        }
    </style>

    <div id="print-statistik-content">
    {{-- Ringkasan --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach ([
            ['icon' => 'fa-eye', 'label' => 'Hari Ini', 'value' => $ringkasan['hari_ini'], 'color' => 'bg-blue-600'],
            ['icon' => 'fa-calendar', 'label' => 'Bulan Ini', 'value' => $ringkasan['bulan_ini'], 'color' => 'bg-green-600'],
            ['icon' => 'fa-users', 'label' => 'Total Pengunjung', 'value' => $ringkasan['total'], 'color' => 'bg-primary'],
            ['icon' => 'fa-newspaper', 'label' => 'Total Pembaca Blog', 'value' => $ringkasan['total_pembaca'], 'color' => 'bg-orange-500'],
        ] as $card)
            <div class="bg-white shadow-sm p-5">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 {{ $card['color'] }} text-white flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $card['icon'] }} text-lg"></i>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-dark">{{ number_format($card['value']) }}</p>
                        <p class="text-lg text-gray-500 uppercase font-bold">{{ $card['label'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Filter --}}
    <div class="bg-white shadow-sm p-6">
        @php
            $filterLabels = [
                'harian' => 'Harian',
                'mingguan' => 'Mingguan',
                'bulanan' => 'Bulanan',
                'tahunan' => 'Tahunan',
            ];
            $routePrefix = request()->routeIs('admin.*') ? 'admin' : 'penulis';
        @endphp

        <div class="print-hide flex flex-col gap-3 mb-6 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-wrap gap-2">
                @foreach ($filterLabels as $key => $label)
                    <a href="?filter={{ $key }}"
                       class="px-5 py-2 text-lg font-bold uppercase tracking-wide transition no-round {{ $filter === $key ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route($routePrefix . '.statistik-pengunjung.download', ['filter' => $filter]) }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-lg font-bold uppercase tracking-wide text-white bg-primary hover:bg-primary-700 transition no-round">
                    <i class="fas fa-download"></i>
                    Download CSV
                </a>
                <button type="button" onclick="printStatistikPengunjung()"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-lg font-bold uppercase tracking-wide text-white bg-dark hover:bg-gray-700 transition no-round">
                    <i class="fas fa-print"></i>
                    Cetak/PDF
                </button>
            </div>
        </div>

        <h3 class="text-lg font-extrabold text-dark uppercase mb-4">{{ $data['label'] }}</h3>

        @if (count($data['rows']) > 0)
            <div class="bg-gray-50 border border-gray-100 no-round p-4 mb-6 h-80">
                <canvas id="statistikPengunjungChart"></canvas>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-4 py-3 text-lg font-bold uppercase text-gray-500 w-16">No</th>
                            @foreach ($data['kolom'] as $kolom)
                                <th class="px-4 py-3 text-lg font-bold uppercase text-gray-500">{{ $kolom }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['rows'] as $i => $row)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-lg text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-lg font-medium">{{ $row['periode'] }}</td>
                                @if (isset($row['rentang']))
                                    <td class="px-4 py-3 text-lg text-gray-500">{{ $row['rentang'] }}</td>
                                @endif
                                <td class="px-4 py-3 text-lg font-bold text-primary">{{ number_format($row['jumlah']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50 border-t-2 border-gray-200">
                            <td class="px-4 py-3 text-lg font-bold uppercase" colspan="{{ count($data['kolom']) }}">Total</td>
                            <td class="px-4 py-3 text-lg font-extrabold text-primary">{{ number_format(array_sum(array_column($data['rows'], 'jumlah'))) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @else
            <div class="text-center py-12 text-gray-400">
                <i class="fas fa-chart-bar text-4xl mb-3"></i>
                <p class="text-lg font-bold">Belum ada data pengunjung</p>
            </div>
        @endif
    </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartData = @json($chartData);
            const chartCanvas = document.getElementById('statistikPengunjungChart');

            if (!chartCanvas || !window.Chart || !Array.isArray(chartData.labels) || chartData.labels.length === 0) {
                return;
            }

            const isLineChart = ['harian', 'mingguan'].includes(chartData.filter);
            const chartType = isLineChart ? 'line' : 'bar';

            new Chart(chartCanvas, {
                type: chartType,
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: chartData.dataset_label,
                        data: chartData.values,
                        borderColor: '#2d8057',
                        backgroundColor: isLineChart ? 'rgba(45, 128, 87, 0.15)' : 'rgba(45, 128, 87, 0.7)',
                        borderWidth: 2,
                        pointRadius: isLineChart ? 4 : 0,
                        pointBackgroundColor: '#2d8057',
                        tension: isLineChart ? 0.3 : 0,
                        fill: isLineChart,
                        borderRadius: isLineChart ? 0 : 6,
                        maxBarThickness: 44,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: false,
                                maxRotation: 45,
                                minRotation: 0
                            }
                        }
                    }
                }
            });
        });

        function printStatistikPengunjung() {
            window.print();
        }
    </script>
@endpush
