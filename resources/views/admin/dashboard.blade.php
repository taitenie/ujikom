<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        .main-content {
            margin-top: 50px;
            margin-left: 220px;
            padding: 30px;
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

        <div class="row">
            <div class="col-md-3">
                <div class="card text-bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text">Manage registered users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text">View and process incoming orders</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <p class="card-text">Create or edit product categories</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-bg-danger mb-3">
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