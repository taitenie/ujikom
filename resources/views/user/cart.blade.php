<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart</title>
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

    .cart-summary {
      margin-top: 2rem;
      padding: 1rem;
      background-color: white;
      border: 1px solid #dee2e6;
      border-radius: 0.5rem;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom px-3 py-2">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <div class="logo-placeholder me-2"></div>
        <span class="fw-bold">shop</span>
      </div>

      <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
      </form>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container my-5">
    <h2 class="mb-4 text-navy">🛒 Shopping Cart</h2>

    <a href="/" class="btn btn-navy-outline mb-3">← Back to Home</a>

    @if(session('cart') && count($cart) > 0)
    <div class="table-responsive">
      <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th style="width: 180px;">Quantity</th>
            <th>Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $productId => $item)
          <tr>
            <td>{{ $item['name'] }}</td>
            <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
            <td>
              <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productId }}">
                <div class="btn-group" role="group">
                  <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary">-</button>
                  <span class="px-2">{{ $item['quantity'] }}</span>
                  <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary">+</button>
                </div>
              </form>
            </td>
            <td>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
            <td>
              <form action="{{ route('cart.remove') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="product_id" value="{{ $productId }}">
                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="cart-summary">
      <h5>Total Quantity: <strong>{{ $totalQuantity }}</strong></h5>
      <h5>Total Price: <strong>Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong></h5>
    </div>
    @else
    <div class="alert alert-info mt-4" role="alert">
      Your cart is empty.
    </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
