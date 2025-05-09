@extends('backend.master')
@section('title','Folafol BD - Juice Shop Dashboard')

@section('dashboard_content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Welcome to Folafol BD Juice Shop</h4>
        <p class="text-muted">POS System Dashboard</p>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <div class="input-group date datepicker dashboard-date me-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
            <span class="input-group-text input-group-addon bg-transparent border-primary">
                <i data-feather="calendar" class="text-primary"></i>
            </span>
            <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date">
        </div>
        <a href="#" class="btn btn-success btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="coffee"></i>
            New Sale
        </a>
    </div>
</div>

<!-- Quick Stats Cards -->
<div class="row">
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Today's Sales</h6>
                </div>
                <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">34</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>+8.2%</span>
                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="todaySalesChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Today's Revenue</h6>
                </div>
                <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">৳5,480</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-success">
                                <span>+12.3%</span>
                                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="todayRevenueChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Most Popular</h6>
                </div>
                <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">Mango</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-muted">
                                <span>12 Orders Today</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="popularItemChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3 col-lg-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Low Stock Alert</h6>
                </div>
                <div class="row">
                    <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3</h3>
                        <div class="d-flex align-items-baseline">
                            <p class="text-danger">
                                <span>Items Running Low</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12 col-xl-7">
                        <div id="stockAlertChart" class="mt-md-3 mt-xl-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Quick Actions</h6>
                <div class="row mt-3">
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-success btn-block py-3">
                            <i data-feather="shopping-cart" class="icon-md me-2"></i>
                            New Sale
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-primary btn-block py-3">
                            <i data-feather="file-text" class="icon-md me-2"></i>
                            Today's Report
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-warning btn-block py-3">
                            <i data-feather="package" class="icon-md me-2"></i>
                            Manage Stock
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="#" class="btn btn-info btn-block py-3">
                            <i data-feather="plus-circle" class="icon-md me-2"></i>
                            Add Juice Item
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="row">
    <div class="col-12 col-xl-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4">
                    <h6 class="card-title mb-0">Recent Orders</h6>
                    <a href="#" class="text-muted">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#ORD-001238</td>
                                <td>Mango Juice (2), Apple Juice (1)</td>
                                <td>৳350</td>
                                <td>11:20 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-001237</td>
                                <td>Orange Juice (1), Mixed Fruit (1)</td>
                                <td>৳280</td>
                                <td>10:45 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-001236</td>
                                <td>Strawberry Juice (3)</td>
                                <td>৳450</td>
                                <td>10:15 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-001235</td>
                                <td>Watermelon Juice (2)</td>
                                <td>৳240</td>
                                <td>09:30 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                            <tr>
                                <td>#ORD-001234</td>
                                <td>Green Apple Juice (1), Orange Juice (1)</td>
                                <td>৳300</td>
                                <td>09:15 AM</td>
                                <td><span class="badge bg-success">Completed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Low Stock Ingredients</h6>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <i data-feather="alert-circle" class="text-warning icon-sm me-2"></i>
                            <h6 class="mb-0">Strawberry</h6>
                        </div>
                        <span class="badge bg-warning">500g left</span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <i data-feather="alert-circle" class="text-danger icon-sm me-2"></i>
                            <h6 class="mb-0">Mango</h6>
                        </div>
                        <span class="badge bg-danger">200g left</span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <i data-feather="alert-circle" class="text-warning icon-sm me-2"></i>
                            <h6 class="mb-0">Kiwi</h6>
                        </div>
                        <span class="badge bg-warning">400g left</span>
                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <a href="#" class="btn btn-primary">Update Stock</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sales Performance -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Sales Performance</h6>
                    <div class="dropdown mb-2">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            This Week
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">This Week</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                        </div>
                    </div>
                </div>
                <p class="text-muted">Sales performance of your juice items based on quantity sold</p>
                <div class="row">
                    <div class="col-lg-8 grid-margin">
                        <div id="salesPerformanceChart" style="height: 300px;"></div>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="mb-3">Top Juice Items</h6>
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span>Mango Juice</span>
                                </div>
                                <span>24%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span>Orange Juice</span>
                                </div>
                                <span>21%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span>Mixed Fruit</span>
                                </div>
                                <span>17%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span>Strawberry</span>
                                </div>
                                <span>15%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span>Others</span>
                                </div>
                                <span>23%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Juice Item Analytics -->
<div class="row">
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Popular Juice Sizes</h6>
                <div id="popularSizesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Hourly Sales Distribution</h6>
                <div id="hourlySalesChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Inventory Status -->
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Inventory Status</h6>
                    <a href="#" class="btn btn-sm btn-primary">Manage Inventory</a>
                </div>
                <p class="text-muted">Current stock levels of key ingredients</p>
                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ingredient</th>
                                <th>Current Stock</th>
                                <th>Min. Level</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mango</td>
                                <td>200g</td>
                                <td>500g</td>
                                <td><span class="badge bg-danger">Low Stock</span></td>
                                <td>Today, 9:42 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Add Stock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Orange</td>
                                <td>4kg</td>
                                <td>2kg</td>
                                <td><span class="badge bg-success">Sufficient</span></td>
                                <td>Yesterday, 2:15 PM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Add Stock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Strawberry</td>
                                <td>500g</td>
                                <td>1kg</td>
                                <td><span class="badge bg-warning">Running Low</span></td>
                                <td>Today, 10:30 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Add Stock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Apple</td>
                                <td>5kg</td>
                                <td>3kg</td>
                                <td><span class="badge bg-success">Sufficient</span></td>
                                <td>Today, 8:00 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Add Stock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Kiwi</td>
                                <td>400g</td>
                                <td>1kg</td>
                                <td><span class="badge bg-warning">Running Low</span></td>
                                <td>Today, 11:45 AM</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Add Stock</button>
                                </td>
                            </tr>
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

        // Sample chart configurations - you would replace these with real data
        if ($('#todaySalesChart').length) {
            var options = {
                chart: {
                    type: 'line'
                    , height: 60
                    , sparkline: {
                        enabled: true
                    }
                }
                , series: [{
                    data: [5, 10, 7, 11, 9, 13, 12]
                }]
                , stroke: {
                    width: 2
                    , curve: 'smooth'
                }
                , markers: {
                    size: 0
                }
                , colors: ['#4caf50']
                , tooltip: {
                    fixed: {
                        enabled: false
                    }
                    , x: {
                        show: false
                    }
                    , y: {
                        title: {
                            formatter: function(seriesName) {
                                return 'Sales:';
                            }
                        }
                    }
                    , marker: {
                        show: false
                    }
                }
            };
            new ApexCharts(document.querySelector("#todaySalesChart"), options).render();
        }

        // Today's Revenue Chart
        if ($('#todayRevenueChart').length) {
            var options = {
                chart: {
                    type: 'line'
                    , height: 60
                    , sparkline: {
                        enabled: true
                    }
                }
                , series: [{
                    data: [3000, 4500, 3800, 5100, 4800, 5500, 5200]
                }]
                , stroke: {
                    width: 2
                    , curve: 'smooth'
                }
                , markers: {
                    size: 0
                }
                , colors: ['#4caf50']
                , tooltip: {
                    fixed: {
                        enabled: false
                    }
                    , x: {
                        show: false
                    }
                    , y: {
                        title: {
                            formatter: function(seriesName) {
                                return 'Revenue:';
                            }
                        }
                        , formatter: function(value) {
                            return '৳' + value;
                        }
                    }
                    , marker: {
                        show: false
                    }
                }
            };
            new ApexCharts(document.querySelector("#todayRevenueChart"), options).render();
        }

        // Popular Item Chart
        if ($('#popularItemChart').length) {
            var options = {
                chart: {
                    type: 'pie'
                    , height: 60
                    , sparkline: {
                        enabled: true
                    }
                }
                , series: [12, 8, 6, 4]
                , colors: ['#4caf50', '#ff9800', '#f44336', '#2196f3']
                , stroke: {
                    width: 0
                }
            };
            new ApexCharts(document.querySelector("#popularItemChart"), options).render();
        }

        // Stock Alert Chart
        if ($('#stockAlertChart').length) {
            var options = {
                chart: {
                    type: 'radialBar'
                    , height: 60
                    , sparkline: {
                        enabled: true
                    }
                }
                , series: [40]
                , colors: ['#f44336']
                , plotOptions: {
                    radialBar: {
                        hollow: {
                            margin: 0
                            , size: '50%'
                        }
                        , track: {
                            margin: 0
                        }
                        , dataLabels: {
                            show: false
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#stockAlertChart"), options).render();
        }

        // Sales Performance Chart
        if ($('#salesPerformanceChart').length) {
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
                        horizontal: false
                        , columnWidth: '40%'
                        , endingShape: 'rounded'
                    }
                , }
                , dataLabels: {
                    enabled: false
                }
                , stroke: {
                    show: true
                    , width: 2
                    , colors: ['transparent']
                }
                , series: [{
                    name: 'Small'
                    , data: [42, 38, 45, 35, 49, 40, 35]
                }, {
                    name: 'Medium'
                    , data: [56, 65, 70, 82, 58, 55, 65]
                }, {
                    name: 'Large'
                    , data: [30, 25, 40, 35, 25, 35, 30]
                }]
                , xaxis: {
                    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                , }
                , yaxis: {
                    title: {
                        text: 'Quantity Sold'
                    }
                }
                , fill: {
                    opacity: 1
                }
                , colors: ['#4caf50', '#2196f3', '#ff9800']
                , tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " units"
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#salesPerformanceChart"), options).render();
        }

        // Popular Sizes Chart
        if ($('#popularSizesChart').length) {
            var options = {
                chart: {
                    type: 'donut'
                    , height: 300
                }
                , series: [45, 35, 20]
                , labels: ['Medium', 'Large', 'Small']
                , colors: ['#2196f3', '#ff9800', '#4caf50']
                , legend: {
                    position: 'bottom'
                }
            };
            new ApexCharts(document.querySelector("#popularSizesChart"), options).render();
        }

        // Hourly Sales Chart
        if ($('#hourlySalesChart').length) {
            var options = {
                chart: {
                    type: 'line'
                    , height: 300
                    , toolbar: {
                        show: false
                    }
                }
                , stroke: {
                    curve: 'smooth'
                    , width: 3
                }
                , series: [{
                    name: 'Sales'
                    , data: [3, 5, 7, 12, 15, 18, 22, 24, 18, 15, 12, 8]
                }]
                , xaxis: {
                    categories: ['8AM', '9AM', '10AM', '11AM', '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM']
                }
                , colors: ['#4caf50']
                , markers: {
                    size: 4
                    , strokeWidth: 0
                }
                , grid: {
                    borderColor: '#e0e0e0'
                , }
            };
            new ApexCharts(document.querySelector("#hourlySalesChart"), options).render();
        }
    });

</script>
@endpush
