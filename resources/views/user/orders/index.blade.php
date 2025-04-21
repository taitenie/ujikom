<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Orders</title>
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

    .navbar-custom form button:hover {
      background-color: #dc3545;
      color: white;
    }

    .logo-placeholder {
      width: 50px;
      height: 50px;
      background-color: #ccc;
      border-radius: 50%;
      display: inline-block;
    }

    .btn-navy {
      background-color: var(--navy);
      border-color: var(--navy);
      color: white;
    }

    .btn-navy:hover {
      background-color: var(--navy-hover);
      border-color: var(--navy-hover);
      color: white;
    }

    .btn-navy-outline {
      background-color: transparent;
      border: 2px solid var(--navy);
      color: var(--navy);
    }

    .btn-navy-outline:hover {
      background-color: var(--navy);
      color: white;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .dropdown-item {
      color: #000 !important;
      /* Mengatur warna teks menjadi hitam */
    }

    .dropdown-item:hover {
      background-color: #f1f1f1;
      /* Menambahkan efek hover dengan latar belakang terang */
      color: #007bff;
      /* Mengubah warna teks saat hover */
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom px-3 py-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 50px; width: 50px; object-fit: cover;" class="rounded-circle me-3">
        <span class="fw-bold fs-4 text-light">HealthBud</span>
      </div>
  
      <!-- Dropdown Menu with Avatar Icon -->
      <div class="dropdown">
        <button class="btn btn-sm btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="rounded-circle" style="width: 35px; height: 35px; background-color: #fff; background-image: url('https://via.placeholder.com/35'); background-size: cover; margin-right: 8px;"></div>
          <span class="fs-6">{{ auth()->user()->username }}</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
          <li><a class="dropdown-item" href="{{ route('profile.index') }}">
              <i class="bi bi-person-fill"></i> Profile
            </a></li>
          <li>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-5">
    <h2 class="mb-4 text-navy">📦 Your Orders</h2>

    <a href="/" class="btn btn-navy-outline mb-3">← Back to Home</a>

    @if($orders->count() > 0)
    <div class="table-responsive">
      <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
          <tr>
            <th>Order ID</th>
            <th>Total Quantity</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Payment</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->items->sum('quantity') }}</td>
            <td>Rp{{ number_format($order->items->sum(fn($item) => $item->quantity * $item->product->price), 0, ',', '.') }}</td>
            <td>
              @if($order->status === 'pending')
              <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
              @elseif($order->status === 'shipped')
              <span class="badge bg-primary">{{ ucfirst($order->status) }}</span>
              @elseif($order->status === 'received')
              <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
              @elseif($order->status === 'cancelled')
              <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
              @endif
            </td>
            <td>{{ ucfirst($order->payment_type) }} / {{ ucfirst($order->payment_method) }}</td>
            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            <td>
              <a href="{{ route('struk.show', $order->id) }}" class="btn btn-sm btn-navy">View</a>
              <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger"
                  onclick="return confirm('Are you sure you want to cancel this order?')"
                  {{ $order->status !== 'pending' ? 'disabled' : '' }}>
                  Cancel
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <p>Execution Time: {{ $executionTime }} seconds</p>
    <p>Memory Usage: {{ number_format($memoryUsage / 1024, 2) }} KB</p>
    @else
    <div class="alert alert-info">You have no orders yet.</div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>