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

        .sidebar {
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            background-color: #343a40;
            padding-top: 60px;
        }

        .sidebar a {
            color: #fff;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .main-content {
            margin-left: 220px;
            padding: 30px;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Admin Dashboard</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="/">Dashboard Home</a>
        <a href="/">Manage Users</a>
        <a href="/">Incoming Orders</a>
        <a href="/">Manage Categories</a>
        <a href="/">Approve Shops</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h2>Welcome, Admin</h2>
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