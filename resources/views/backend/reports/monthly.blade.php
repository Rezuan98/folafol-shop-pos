@extends('backend.master')
@section('title','Folafol BD - Monthly Sales Report')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Monthly Sales Report</h4>
        <p class="text-muted">Sales report for {{ $month->format('F Y') }}</p>
    </div>
    <div class="d-flex flex-wrap">
        <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary btn-icon-text me-2">
            <i class="btn-icon-prepend" data-feather="arrow-left"></i>
            Back to Reports
        </a>
        <a href="{{ route('admin.reports.download', ['type' => 'monthly', 'month' => $month->format('Y-m')]) }}" class="btn btn-primary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="download"></i>
            Download PDF
        </a>
    </div>
</div>

<!-- Month Picker -->
<div class="row mb-4">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Select Month</h6>
                <form action="{{ route('admin.reports.monthly') }}" method="GET" class="d-flex align-items-center">
                    <div class="input-group flatpickr" id="monthPicker">
                        <input type="text" class="form-control bg-transparent" name="month" value="{{ $month->format('Y-m') }}" placeholder="Select month" data-input>
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
                    <h6 class="card-title mb-0">Daily Average</h6>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        @php
                        $daysInMonth = $month->daysInMonth;
                        $dailyAverage = $salesData['total_sales'] / $daysInMonth;
                        @endphp
                        <h3 class="mb-2">৳{{ number_format($dailyAverage, 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-muted">
                                <span>Avg. daily sales</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Weekly Sales Chart -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Weekly Sales Distribution</h6>
                </div>
                <div id="weeklySalesChart" style="height: 300px;"></div>
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
                <h6 class="card-title">Top 5 Juices Sold This Month</h6>
                <div id="topJuicesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Weekly Sales Breakdown -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Weekly Sales Breakdown</h6>
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Week</th>
                                <th>Period</th>
                                <th>Orders</th>
                                <th>Sales</th>
                                <th>% of Monthly Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($weeklySales as $week)
                            <tr>
                                <td>{{ $week['week'] }}</td>
                                <td>{{ $week['start_date'] }} - {{ $week['end_date'] }}</td>
                                <td>{{ $week['orders'] }}</td>
                                <td>৳{{ number_format($week['sales'], 2) }}</td>
                                <td>
                                    @php
                                    $percentage = $salesData['total_sales'] > 0 ? ($week['sales'] / $salesData['total_sales']) * 100 : 0;
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <div class="progress progress-md flex-grow-1 me-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span>{{ number_format($percentage, 1) }}%</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if(count($weeklySales) == 0)
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

        // Initialize Flatpickr month picker
        flatpickr("#monthPicker", {
            altInput: true
            , altFormat: "F Y"
            , dateFormat: "Y-m"
            , plugins: [
                new monthSelectPlugin({
                    shorthand: true
                    , dateFormat: "Y-m"
                    , altFormat: "F Y"
                })
            ]
        });

        // Weekly Sales Chart
        if ($('#weeklySalesChart').length) {
            var weeklySalesData = @json($weeklySales);

            var categories = [];
            var salesData = [];
            var ordersData = [];

            weeklySalesData.forEach(function(week) {
                categories.push(week.week);
                salesData.push(week.sales);
                ordersData.push(week.orders);
            });

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
                    , data: salesData
                }, {
                    name: 'Orders'
                    , type: 'line'
                    , data: ordersData
                }]
                , xaxis: {
                    categories: categories
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
            new ApexCharts(document.querySelector("#weeklySalesChart"), options).render();
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
