<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - Orders</title>
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

    .btn-primary {
      background-color: #001f3f;
      border-color: #001f3f;
    }

    .btn-primary:hover {
      background-color: #003366;
      border-color: #003366;
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
      <h2 class="mb-4">Order List</h2>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>Order ID</th>
              <th>User</th>
              <th>Status</th>
              <th>Created At</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($orders as $order)
            <tr>
              <td>#{{ $order->id }}</td>
              <td>{{ $order->user->username }}</td>
              <td>
                @if($order->status === 'pending')
                <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
                @elseif($order->status === 'shipped')
                <span class="badge bg-primary">{{ ucfirst($order->status) }}</span>
                @elseif($order->status === 'arrived')
                <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span>
                @elseif($order->status === 'received')
                <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
                @elseif($order->status === 'cancelled')
                <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
                @endif
              </td>
              <td>{{ $order->created_at->format('d M Y H:i') }}</td>
              <td>
                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">View</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center">No orders available.</td>
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