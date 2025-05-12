<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Folafol BD Juice Shop Admin Dashboard">
    <meta name="author" content="Folafol BD">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="juice, smoothie, fresh juice, healthy drinks, folafol, bangladesh">

    <title>@yield("title")</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- core:css -->

    <link rel="stylesheet" href="<?= asset('backend/assets/vendors/core/core.css') ?>">
    <link rel="stylesheet" href="<?= asset('backend/assets/vendors/flatpickr/flatpickr.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('backend/assets/fonts/feather-font/css/iconfont.css') ?>">
    <link rel="stylesheet" href="<?= asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('backend/assets/css/demo2/style.css') ?>">
    <!-- End layout styles -->

    <style>
        .toast-success {
            background-color: #28a745 !important;
            color: white !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .toast-info {
            background-color: #ffc107 !important;
            color: white !important;
        }

        .toast-warning {
            background-color: #ffc107 !important;
            color: black !important;
        }

        .toast-title {
            font-weight: bold;
        }

        .toast-message {
            font-size: 14px;
        }

        /* Juice Shop Theme Colors */
        :root {
            --primary-color: #4caf50;
            --secondary-color: #ff9800;
            --accent-color: #f44336;
        }

        .sidebar-brand span {
            color: var(--secondary-color);
        }

        .sidebar .nav .nav-item.active .nav-link {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #388e3c;
            border-color: #388e3c;
        }

    </style>

    @stack('styles')
</head>
<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                    Folafol<span>BD</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Dashboard</span>
                        </a>
                    </li>

                    <!-- POS System -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pos.index') }}" class="nav-link">
                            <i class="link-icon" data-feather="shopping-bag"></i>
                            <span class="link-title">POS System</span>
                        </a>
                    </li>

                    <!-- Juice Management Section -->
                    <li class="nav-item nav-category">Products</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#juiceCollapse" role="button" aria-expanded="false" aria-controls="juiceCollapse">
                            <i class="link-icon" data-feather="coffee"></i>
                            <span class="link-title">Juice Management</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="juiceCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.juices.create') }}" class="nav-link">Add New Juice</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.juices.index') }}" class="nav-link">All Juices</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!-- Order Management Section -->
                    <li class="nav-item nav-category">Orders</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#orderCollapse" role="button" aria-expanded="false" aria-controls="orderCollapse">
                            <i class="link-icon" data-feather="shopping-cart"></i>
                            <span class="link-title">Order Management</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="orderCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.pos.orders') }}" class="nav-link">All Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pos.index') }}" class="nav-link">New Order (POS)</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Inventory Section -->
                    <!-- Inventory Section -->
                    <li class="nav-item nav-category">Inventory</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#inventoryCollapse" role="button" aria-expanded="false" aria-controls="inventoryCollapse">
                            <i class="link-icon" data-feather="package"></i>
                            <span class="link-title">Ingredients Stock</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="inventoryCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.ingredients.create') }}" class="nav-link">Add Ingredients</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.ingredients.index') }}" class="nav-link">Manage Ingredients</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.ingredients.low-stock') }}" class="nav-link">Low Stock Alert</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Reports Section -->
                    <li class="nav-item nav-category">Reports</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#reportsCollapse" role="button" aria-expanded="false" aria-controls="reportsCollapse">
                            <i class="link-icon" data-feather="bar-chart-2"></i>
                            <span class="link-title">Sales Reports</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="reportsCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.reports.index') }}" class="nav-link">Reports Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reports.daily') }}" class="nav-link">Daily Sales</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reports.weekly') }}" class="nav-link">Weekly Sales</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.reports.monthly') }}" class="nav-link">Monthly Sales</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Settings Section -->
                    <li class="nav-item nav-category">Settings</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#settingsCollapse" role="button" aria-expanded="false" aria-controls="settingsCollapse">
                            <i class="link-icon" data-feather="settings"></i>
                            <span class="link-title">Shop Settings</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="settingsCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Shop Information</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Invoice Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Tax Settings</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- User Management -->
                    <li class="nav-item nav-category">Administration</li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#userCollapse" role="button" aria-expanded="false" aria-controls="userCollapse">
                            <i class="link-icon" data-feather="user"></i>
                            <span class="link-title">User Management</span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="userCollapse">
                            <ul class="nav sub-menu">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link">Add User</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">All Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item nav-category">Account</li>
                    <li class="nav-item">
                        <form method="POST" action="">
                            @csrf
                            <button type="submit" class="nav-link bg-transparent border-0 d-flex align-items-center w-100" style="cursor: pointer;">
                                <i class="link-icon" data-feather="log-out"></i>
                                <span class="link-title">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <form class="search-form">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i data-feather="search"></i>
                            </div>
                            <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <!-- Current Date & Time -->
                        <li class="nav-item dropdown me-3">
                            <a class="nav-link d-flex align-items-center" href="#" role="button">
                                <i data-feather="calendar" class="icon-md text-muted me-1"></i>
                                <span id="currentDate"></span>
                            </a>
                        </li>

                        <li class="nav-item dropdown me-3">
                            <a class="nav-link d-flex align-items-center" href="#" role="button">
                                <i data-feather="clock" class="icon-md text-muted me-1"></i>
                                <span id="currentTime"></span>
                            </a>
                        </li>

                        <!-- Notifications -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="bell"></i>
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                                <div class="d-flex align-items-center justify-content-between py-2 px-3 border-bottom">
                                    <div>
                                        <h6 class="mb-0">Notifications</h6>
                                    </div>
                                    <div class="text-muted">
                                        <span>Clear all</span>
                                    </div>
                                </div>
                                <div class="p-1">
                                    <a href="#" class="dropdown-item d-flex align-items-center py-2">
                                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-success rounded-circle me-3">
                                            <i data-feather="shopping-cart" class="text-white"></i>
                                        </div>
                                        <div class="flex-grow-1 me-2">
                                            <p>New order received</p>
                                            <p class="text-muted tx-12">30 min ago</p>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item d-flex align-items-center py-2">
                                        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-warning rounded-circle me-3">
                                            <i data-feather="alert-circle" class="text-white"></i>
                                        </div>
                                        <div class="flex-grow-1 me-2">
                                            <p>Low stock alert: Mango</p>
                                            <p class="text-muted tx-12">1 hour ago</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                                    <a href="#">View all</a>
                                </div>
                            </div>
                        </li>

                        <!-- Admin Profile -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="profile">
                            </a>
                            <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                                <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                                    <div class="mb-3">
                                        <img class="wd-80 ht-80 rounded-circle" src="https://via.placeholder.com/80x80" alt="">
                                    </div>
                                    <div class="text-center">
                                        <p class="tx-16 fw-bolder">Admin</p>
                                        <p class="tx-12 text-muted">admin@folafolbd.com</p>
                                    </div>
                                </div>
                                <ul class="list-unstyled p-1">
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="edit"></i>
                                            <span>Edit Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item py-2">
                                        <a href="#" class="text-body ms-0">
                                            <i class="me-2 icon-md" data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->

            <div class="page-content">
                @yield('dashboard_content')
            </div>

            <!-- partial:partials/_footer.html -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © 2025 <a href="https://folafolbd.com/" target="_blank">Folafol BD</a>.</p>
                <p class="text-muted">Designed and Developed by <a href="https://revencomm.com/">RevenComm</a></p>
            </footer>
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="<?= asset('backend/assets/vendors/core/core.js') ?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?= asset('backend/assets/vendors/flatpickr/flatpickr.min.js') ?>"></script>
    <script src="<?= asset('backend/assets/vendors/apexcharts/apexcharts.min.js') ?>"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="<?= asset('backend/assets/vendors/feather-icons/feather.min.js') ?>"></script>
    <script src="<?= asset('backend/assets/js/template.js') ?>"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="<?= asset('backend/assets/js/dashboard-dark.js') ?>"></script>
    <!-- End custom js for this page -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- toaster --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    @stack('scripts')


    <script>
        @if(session('success'))
        toastr.success("{{ session('success') }}");
        @endif
        @if(session('info'))
        toastr.info("{{ session('info') }}");
        @endif
        @if(session('error'))
        toastr.error("{{ session('error') }}");
        @endif

    </script>

    <script>
        // Function to update the date and time
        function updateDateTime() {
            const now = new Date();

            // Format date: Mar 11, 2025
            const options = {
                year: 'numeric'
                , month: 'short'
                , day: 'numeric'
            };
            const dateStr = now.toLocaleDateString('en-US', options);

            // Format time with seconds: 12:34:56 PM
            const timeStr = now.toLocaleTimeString('en-US', {
                hour: '2-digit'
                , minute: '2-digit'
                , second: '2-digit'
            });

            // Update the elements
            document.getElementById('currentDate').textContent = dateStr;
            document.getElementById('currentTime').textContent = timeStr;
        }

        // Update initially
        updateDateTime();

        // Update every second for real-time accuracy
        setInterval(updateDateTime, 1000);

    </script>

</body>
</html>
