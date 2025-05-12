@extends('backend.master')
@section('title','Folafol BD - Daily Sales Report')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Daily Sales Report</h4>
        <p class="text-muted">Sales report for {{ $date->format('F d, Y') }}</p>
    </div>
    <div class="d-flex flex-wrap">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary btn-icon-text me-2">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to Reports
        </a>
        <a href="{{ route('admin.reports.download', ['type' => 'daily', 'date' => $date->format('Y-m-d')]) }}" class="btn btn-primary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="download"></i>
            Download PDF
        </a>
    </div>
</div>

<!-- Date Picker -->
<div class="row mb-4">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Select Date</h6>
                <form action="{{ route('admin.reports.daily') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group flatpickr" id="datePicker">
                        <input type="text" class="form-control bg-transparent" name="date" value="{{ $date->format('Y-m-d') }}" placeholder="Select date" data-input>
                        <span class="input-group-text input-group-addon bg-transparent" data-toggle><i data-feather="calendar"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary ms-2">View Report</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="row">
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Total Sales</h6>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h3 class="mb-2">৳{{ number_format($salesData['total_sales'], 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>{{ $salesData['total_orders'] }} Orders</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Items Sold</h6>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h3 class="mb-2">{{ $salesData['total_items'] }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-muted">
                                <span>Across all orders</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Average Order</h6>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h3 class="mb-2">৳{{ number_format($salesData['average_order'], 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-muted">
                                <span>Avg. value per order</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Peak Sales Hour</h6>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        @php
                        $peakHourIndex = array_search(max($hourlySales['sales']), $hourlySales['sales']);
                        $peakHour = $hourlySales['hours'][$peakHourIndex];
                        @endphp
                        <h3 class="mb-2">{{ $peakHour }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>৳{{ number_format($hourlySales['sales'][$peakHourIndex], 2) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hourly Sales Chart -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Hourly Sales Distribution</h6>
                </div>
                <div id="hourlySalesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Sales by Size Chart -->
<div class="row">
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Sales by Size</h6>
                <div id="sizeChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Top 5 Juices Sold Today</h6>
                <div id="topJuicesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Juices -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Popular Juices</h6>
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Juice Name</th>
                                <th>Quantity Sold</th>
                                <th>Total Sales</th>
                                <th>Average Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($popularJuices as $index => $juice)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $juice->juice_name }}</td>
                                <td>{{ $juice->quantity }}</td>
                                <td>৳{{ number_format($juice->total, 2) }}</td>
                                <td>৳{{ number_format($juice->total / $juice->quantity, 2) }}</td>
                            </tr>
                            @endforeach

                            @if(count($popularJuices) == 0)
                            <tr>
                                <td colspan="5" class="text-center">No sales data available</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        // Initialize Feather icons
        feather.replace();

        // Initialize Flatpickr date picker
        flatpickr("#datePicker", {
            altInput: true
            , altFormat: "F j, Y"
            , dateFormat: "Y-m-d"
        , });

        // Hourly Sales Chart
        if ($('#hourlySalesChart').length) {
            var hourlySalesData = @json($hourlySales);

            var options = {
                chart: {
                    type: 'line'
                    , height: 300
                    , toolbar: {
                        show: false
                    }
                }
                , plotOptions: {
                    bar: {
                        horizontal: false
                        , columnWidth: '55%'
                        , endingShape: 'rounded'
                    }
                , }
                , dataLabels: {
                    enabled: false
                }
                , stroke: {
                    curve: 'smooth'
                    , width: 3
                }
                , series: [{
                    name: 'Sales'
                    , type: 'column'
                    , data: hourlySalesData.sales
                }, {
                    name: 'Orders'
                    , type: 'line'
                    , data: hourlySalesData.orders
                }]
                , xaxis: {
                    categories: hourlySalesData.hours
                , }
                , yaxis: [{
                    title: {
                        text: 'Sales (৳)'
                    , }
                    , labels: {
                        formatter: function(value) {
                            return '৳' + value.toFixed(0);
                        }
                    }
                }, {
                    opposite: true
                    , title: {
                        text: 'Orders'
                    }
                }]
                , colors: ['#4caf50', '#2196f3']
                , tooltip: {
                    y: {
                        formatter: function(value, {
                            series
                            , seriesIndex
                            , dataPointIndex
                            , w
                        }) {
                            return seriesIndex === 0 ? '৳' + value.toFixed(2) : value;
                        }
                    }
                }
                , grid: {
                    borderColor: '#e0e0e0'
                , }
                , legend: {
                    position: 'top'
                }
            };
            new ApexCharts(document.querySelector("#hourlySalesChart"), options).render();
        }

        // Sales by Size Donut Chart
        if ($('#sizeChart').length) {
            var sizeData = @json($sizeData);

            var options = {
                chart: {
                    type: 'donut'
                    , height: 300
                }
                , series: sizeData.quantities
                , labels: sizeData.labels
                , colors: ['#4caf50', '#2196f3', '#ff9800']
                , legend: {
                    position: 'bottom'
                }
                , plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true
                                , total: {
                                    show: true
                                    , label: 'Total Items'
                                    , formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => {
                                            return a + b
                                        }, 0);
                                    }
                                }
                            }
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#sizeChart"), options).render();
        }

        // Top Juices Chart
        if ($('#topJuicesChart').length) {
            var juiceData = @json($popularJuices);
            var topJuiceNames = [];
            var topJuiceQuantities = [];

            juiceData.slice(0, 5).forEach(function(juice) {
                topJuiceNames.push(juice.juice_name);
                topJuiceQuantities.push(juice.quantity);
            });

            var options = {
                chart: {
                    type: 'bar'
                    , height: 300
                    , toolbar: {
                        show: false
                    }
                }
                , plotOptions: {
                    bar: {
                        horizontal: true
                        , barHeight: '50%'
                        , distributed: true
                    }
                }
                , dataLabels: {
                    enabled: false
                }
                , series: [{
                    data: topJuiceQuantities
                }]
                , xaxis: {
                    categories: topJuiceNames
                    , labels: {
                        formatter: function(val) {
                            return Math.abs(Math.round(val));
                        }
                    }
                }
                , yaxis: {
                    title: {
                        text: 'Juice Name'
                    }
                }
                , colors: ['#4caf50', '#2196f3', '#ff9800', '#f44336', '#9c27b0']
                , tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + ' units';
                        }
                    }
                }
                , grid: {
                    borderColor: '#e0e0e0'
                , }
            };
            new ApexCharts(document.querySelector("#topJuicesChart"), options).render();
        }
    });

</script>
@endpush
