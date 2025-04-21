<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
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

    .text-navy {
      color: var(--navy);
    }

    .text-price {
      color: var(--navy);
      font-size: 1.4rem;
      font-weight: bold;
    }

    .product-name {
      font-size: 1.8rem;
      font-weight: bold;
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

  <!-- Product Details -->
  <div class="container my-5">
    <div class="row">
      <h2 class="text-navy mb-3">📦 Product Detail</h2>
      <div class="col-md-6">
        @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm" alt="{{ $product->name }}">
        @else
        <img src="" class="img-fluid rounded shadow-sm" alt="No Image">
        @endif
      </div>
      <div class="col-md-6">
        <h2 class="product-name text-navy">{{ $product->name }}</h2>
        <p class="text-muted mb-1">Category: <strong>{{ $product->category->name ?? 'Uncategorized' }}</strong></p>
        <div class="text-price mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
        <p>{{ $product->description }}</p>

        <form action="{{ route('cart.items.store', $product->id) }}" method="POST" class="mt-3">
          @csrf
          <div class="input-group" style="max-width: 200px;">
            <input type="number" name="quantity" class="form-control" value="1" min="1">
            <button class="btn btn-navy" type="submit">Add to Cart</button>
          </div>
        </form>

        <a href="{{ route('dashboard') }}" class="btn btn-link mt-3 text-decoration-none text-navy">← Back to Products</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>