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

    .dropdown-item {
      color: #000 !important;
      background-color: transparent;
      width: 100%;
      text-align: left;
      padding: 0.25rem 1rem;
      border: none;
      background: none;
    }

    /* Hover style */
    .dropdown-item:hover {
      background-color: #f1f1f1;
      color: #007bff;
      cursor: pointer;
    }

    .btn-outline-light {
      background-color: transparent;
      border: 2px solid #fff;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: transparent;
      color: white;
    }
    
    /* Menjaga warna teks tetap putih dan hindari background putih saat hover */
    .btn-outline-light.dropdown-toggle:hover,
    .btn-outline-light.dropdown-toggle:focus,
    .btn-outline-light.dropdown-toggle:active {
      background-color: var(--navy); /* atau warna lain yang cocok */
      color: #fff;
      border-color: #fff; /* Opsional: supaya border tetap kelihatan */
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
        @auth
        <button class="btn btn-sm btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="rounded-circle" style="width: 35px; height: 35px; background-color: #fff; background-image: url('https://via.placeholder.com/35'); background-size: cover; margin-right: 8px;"></div>
          <span class="fs-6">{{ auth()->user()->username }}</span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
          <li><a class="dropdown-item" href="{{ route('profile.index') }}">
              Profile
            </a></li>
          <li>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="dropdown-item">
                Logout
              </button>
            </form>
          </li>
        </ul>
        @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Login</a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- Product Details -->
  <div class="container my-4">
    <div class="row">
      <h2 class="text-navy mb-3">🛍️ Product Detail</h2>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

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
        <p class="text-muted mb-1">Stock: <strong>{{ $product->stock }}</strong></p>

        <a href="{{ route('dashboard') }}" class="btn btn-link mt-3 text-decoration-none text-navy">← Back to Products</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>