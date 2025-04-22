<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin - View Order</title>
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
    <div class="container mt-4">
      <h2 class="mb-4">Order Details</h2>

      <table class="table table-bordered">
        <tr>
          <th>Order ID</th>
          <td>#{{ $order->id }}</td>
        </tr>
        <tr>
          <th>User</th>
          <td>{{ $order->user->username }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>{{ ucfirst($order->status) }}</td>
        </tr>
        <tr>
          <th>Created At</th>
          <td>{{ $order->created_at->format('d M Y H:i') }}</td>
        </tr>
      </table>

      <h5 class="mt-4">Order Items:</h5>
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach($order->items as $item)
          <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      @if($order->status === 'received')
      <div class="mt-4">
        <h5>Customer Feedback:</h5>
        <p>{{ $order->feedback }}</p>
      </div>
      @endif

      <div class="mt-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>

        <div>
          @if($order->status === 'pending')
          <form action="{{ route('admin.orders.updateStatus', ['order' => $order->id, 'status' => 'shipped']) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-primary">Ship</button>
          </form>
          @elseif($order->status === 'shipped')
          <form action="{{ route('admin.orders.updateStatus', ['order' => $order->id, 'status' => 'arrived']) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success">Arrived</button>
          </form>
          @endif

          <form action="{{ route('admin.orders.updateStatus', ['order' => $order->id, 'status' => 'cancelled']) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-danger" {{ $order->status !== 'pending' ? 'disabled' : '' }}>Reject</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>