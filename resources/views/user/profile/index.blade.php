<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --navy: #001f3f;
      --navy-hover: #003366;
    }
  
    body {
      background-color: #f8f9fa;
    }
  
    .navbar-custom {
      background-color: var(--navy);
      border-bottom: 1px solid #001533;
    }
  
    .navbar-custom .fw-bold,
    .navbar-custom .btn,
    .navbar-custom form button {
      color: white;
    }

  
    .card-header.bg-primary {
      background-color: var(--navy) !important;
      font-weight: bold;
      font-size: 1.2rem;
      padding: 16px;
    }
  
    .text-navy {
      color: var(--navy);
    }
  
    .profile-table {
      width: 100%;
    }
  
    .profile-table dt {
      background-color: #e9ecef;
      border-bottom: 1px solid #dee2e6;
      color: var(--navy);
      font-weight: 600;
      padding: 12px 16px;
    }
  
    .profile-table dd {
      background-color: #fff;
      border-bottom: 1px solid #dee2e6;
      margin-bottom: 0;
      padding: 12px 16px;
    }
  </style>  
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom px-3 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <div class="logo-placeholder me-2" style="width: 40px; height: 40px; background-color: #ccc; border-radius: 50%;"></div>
        <span class="fw-bold">shop</span>
      </div>
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
          {{ auth()->user()->username }}
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-5">
    <h2 class="mb-4 text-navy">👤 Profile Information</h2>
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        Your Details
      </div>
      <div class="card-body">
        <dl class="row profile-table">
          <dt class="col-sm-4">Username</dt>
          <dd class="col-sm-8">{{ auth()->user()->username }}</dd>

          <dt class="col-sm-4">Email</dt>
          <dd class="col-sm-8">{{ auth()->user()->email }}</dd>

          <dt class="col-sm-4">Date of Birth</dt>
          <dd class="col-sm-8">{{ auth()->user()->birth }}</dd>

          <dt class="col-sm-4">Gender</dt>
          <dd class="col-sm-8">{{ auth()->user()->gender }}</dd>

          <dt class="col-sm-4">Address</dt>
          <dd class="col-sm-8">{{ auth()->user()->address }}</dd>

          <dt class="col-sm-4">City</dt>
          <dd class="col-sm-8">{{ auth()->user()->city }}</dd>

          <dt class="col-sm-4">Phone Number</dt>
          <dd class="col-sm-8">{{ auth()->user()->number }}</dd>

          <dt class="col-sm-4">PayPal ID</dt>
          <dd class="col-sm-8">{{ auth()->user()->paypalId }}</dd>

          <dt class="col-sm-4">Role</dt>
          <dd class="col-sm-8">{{ auth()->user()->role }}</dd>
        </dl>
      </div>
    </div>
  </div>
</body>

</html>
