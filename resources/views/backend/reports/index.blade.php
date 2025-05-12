@extends('backend.master')
@section('title','Folafol BD - Sales Reports')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Sales Reports</h4>
        <p class="text-muted">View and analyze your sales performance</p>
    </div>
    <div>
        <a href="{{ route('admin.reports.download') }}" class="btn btn-secondary btn-icon-text me-2">
            <i class="btn-icon-prepend" data-feather="download"></i>
            Download PDF
        </a>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="row">
    <div class="col-12 col-xl-4 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Today's Sales</h6>
                    <a href="{{ route('admin.reports.daily', ['date' => $todaySales['date']->format('Y-m-d')]) }}" class="text-muted">View Details</a>
                </div>
                <div class="row mt-3">
                    <div class="col-6 col-md-12 col-xl-6">
                        <h3 class="mb-2">৳{{ number_format($todaySales['total_sales'], 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>{{ $todaySales['total_orders'] }} Orders</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-6">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <i data-feather="shopping-bag" class="text-primary icon-lg me-2"></i>
                                <div>
                                    <p class="mb-0 text-muted">Items</p>
                                    <h5 class="mb-0">{{ $todaySales['total_items'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">This Week's Sales</h6>
                    <a href="{{ route('admin.reports.weekly', ['start_date' => $weekSales['start_date']->format('Y-m-d')]) }}" class="text-muted">View Details</a>
                </div>
                <div class="row mt-3">
                    <div class="col-6 col-md-12 col-xl-6">
                        <h3 class="mb-2">৳{{ number_format($weekSales['total_sales'], 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>{{ $weekSales['total_orders'] }} Orders</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-6">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <i data-feather="shopping-bag" class="text-primary icon-lg me-2"></i>
                                <div>
                                    <p class="mb-0 text-muted">Items</p>
                                    <h5 class="mb-0">{{ $weekSales['total_items'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">This Month's Sales</h6>
                    <a href="{{ route('admin.reports.monthly', ['month' => $monthSales['month']->format('Y-m')]) }}" class="text-muted">View Details</a>
                </div>
                <div class="row mt-3">
                    <div class="col-6 col-md-12 col-xl-6">
                        <h3 class="mb-2">৳{{ number_format($monthSales['total_sales'], 2) }}</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>{{ $monthSales['total_orders'] }} Orders</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-6">
                        <div class="d-flex justify-content-end">
                            <div class="d-flex align-items-center">
                                <i data-feather="shopping-bag" class="text-primary icon-lg me-2"></i>
                                <div>
                                    <p class="mb-0 text-muted">Items</p>
                                    <h5 class="mb-0">{{ $monthSales['total_items'] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Report Types -->
<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Report Types</h6>
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.reports.daily') }}" class="card text-decoration-none">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" class="text-primary icon-lg me-3"></i>
                                    <div>
                                        <h5 class="mb-0">Daily Sales Report</h5>
                                        <p class="text-muted mb-0">View sales by hour for any day</p>
                                    </div>
                                </div>
                                <i data-feather="chevron-right" class="text-muted"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.reports.weekly') }}" class="card text-decoration-none">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" class="text-success icon-lg me-3"></i>
                                    <div>
                                        <h5 class="mb-0">Weekly Sales Report</h5>
                                        <p class="text-muted mb-0">View sales by day for any week</p>
                                    </div>
                                </div>
                                <i data-feather="chevron-right" class="text-muted"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="{{ route('admin.reports.monthly') }}" class="card text-decoration-none">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i data-feather="calendar" class="text-warning icon-lg me-3"></i>
                                    <div>
                                        <h5 class="mb-0">Monthly Sales Report</h5>
                                        <p class="text-muted mb-0">View sales by week for any month</p>
                                    </div>
                                </div>
                                <i data-feather="chevron-right" class="text-muted"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Trend Chart -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Sales Trend (Last 30 Days)</h6>
                </div>
                <div id="salesTrendChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Top Selling Juices -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Top Selling Juices</h6>
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
                            @foreach($topJuices as $index => $juice)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $juice->juice_name }}</td>
                                <td>{{ $juice->quantity }}</td>
                                <td>৳{{ number_format($juice->total, 2) }}</td>
                                <td>৳{{ number_format($juice->total / $juice->quantity, 2) }}</td>
                            </tr>
                            @endforeach

                            @if(count($topJuices) == 0)
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

        // Sales Trend Chart
        if ($('#salesTrendChart').length) {
            var salesTrendData = @json($salesTrend);

            var options = {
                chart: {
                    type: 'area'
                    , height: 300
                    , toolbar: {
                        show: false
                    }
                }
                , dataLabels: {
                    enabled: false
                }
                , stroke: {
                    curve: 'smooth'
                    , width: 3
                }
                , series: [{
                    name: 'Sales'
                    , data: salesTrendData.map(item => item.sales)
                }]
                , xaxis: {
                    categories: salesTrendData.map(item => item.date)
                    , labels: {
                        rotateAlways: false
                    }
                }
                , yaxis: {
                    title: {
                        text: 'Sales (৳)'
                    }
                    , labels: {
                        formatter: function(value) {
                            return '৳' + value.toFixed(0);
                        }
                    }
                }
                , colors: ['#4caf50']
                , tooltip: {
                    y: {
                        formatter: function(value) {
                            return '৳' + value.toFixed(2);
                        }
                    }
                }
                , grid: {
                    borderColor: '#e0e0e0'
                , }
            };
            new ApexCharts(document.querySelector("#salesTrendChart"), options).render();
        }
    });

</script>
@endpush
