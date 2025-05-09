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
      background-color: #f4f6f9;
    }

    .main-content {
      margin-top: 60px;
      margin-left: 220px;
      padding: 30px;
    }

    .btn-primary {
      background-color: #001f3f;
      border-color: #001f3f;
    }

    .btn-primary:hover {
      background-color: #003366;
      border-color: #003366;
    }

    .btn-warning {
      background-color: #ffc107;
      border-color: #ffc107;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .table thead {
      background-color: #001f3f;
      color: white;
    }

    h2 {
      color: #001f3f;
      font-weight: 600;
    }

    .badge.bg-danger {
      background-color: #d9534f !important;
    }

    .badge.bg-secondary {
      background-color: #6c757d !important;
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
    <div class="container mt-4">
      <h2 class="mb-4">Manage Users</h2>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Add User</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Email</th>
              <th>Birth</th>
              <th>Gender</th>
              <th>Address</th>
              <th>City</th>
              <th>Number</th>
              <th>PayPal ID</th>
              <th>Role</th>
              <th>Registered</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->birth }}</td>
              <td>{{ ucfirst($user->gender) }}</td>
              <td>{{ $user->address }}</td>
              <td>{{ $user->city }}</td>
              <td>{{ $user->number }}</td>
              <td>{{ $user->paypalId }}</td>
              <td>
                <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">
                  {{ ucfirst($user->role) }}
                </span>
              </td>
              <td>{{ $user->created_at->format('d M Y') }}</td>
              <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this user?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="12" class="text-center">No users found.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>