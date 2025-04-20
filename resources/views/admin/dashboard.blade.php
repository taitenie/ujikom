<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            overflow-x: hidden;
        }

        .main-content {
            margin-top: 60px;
            margin-left: 220px;
            padding: 30px;
        }

        h2 {
            color: #001f3f;
            font-weight: 600;
        }

        .card-custom {
            border: none;
            border-radius: 12px;
            color: #fff;
            transition: transform 0.2s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
        }

        .card-users {
            background-color: #001f3f;
        }

        .card-orders {
            background-color: #005f73;
        }

        .card-categories {
            background-color: #0a9396;
        }

        .card-shops {
            background-color: #ae2012;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <x-navbar />

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="main-content">
        <h2>Welcome, {{ Auth::user()->username }}</h2>
        <p>This is your dashboard to manage the medical equipment store.</p>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-custom card-users">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage registered users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-custom card-orders">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text">View and process incoming orders</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-custom card-categories">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text">Create or edit product categories</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card card-custom card-shops">
                    <div class="card-body">
                        <h5 class="card-title">Shop Requests</h5>
                        <p class="card-text">Approve or reject new shop registrations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
