<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --navy: #001f3f;
      --navy-hover: #003366;
    }

    body {
      background-color: #f8f9fa;
    }

    .logo-placeholder {
      width: 50px;
      height: 50px;
      background-color: #ccc;
      border-radius: 50%;
      display: inline-block;
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

    .btn-primary {
      background-color: var(--navy);
      border-color: var(--navy);
    }

    .btn-primary:hover {
      background-color: var(--navy-hover);
      border-color: var(--navy-hover);
    }

    .card-header.bg-primary {
      background-color: var(--navy) !important;
    }

    .text-navy {
      color: var(--navy);
    }

    a.text-dark:hover {
      color: var(--navy) !important;
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

    .product-price {
      font-size: 1rem;
      color: var(--navy);
    }
  </style>
</head>

<body>
  <!-- Header -->
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
  <div class="container my-4">
    <h1 class="text-navy text-center mt-1">Welcome, <strong>{{ auth()->user()->username }}</strong></h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-3 text-navy">📋 Product Page</h2>
      <a href="{{ route('cart.index') }}" class="btn position-relative btn-outline-dark">
        🛒
        <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          {{ auth()->user()->cart ? count(auth()->user()->cart->items) : 0 }}
        </span>
      </a>
    </div>

    <div class="row">
      <!-- Product List -->
      <div class="col-md-9">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @foreach ($products as $product)
          <div class="col">
            <div class="card">
              <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
              <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="footer-buttons">
                  <button class="btn btn-navy btn-buy" data-id="{{ $product->id }}">Buy</button>
                </div>
                <div class="quantity-form d-none">
                  <input type="number" class="form-control input-quantity" value="1" min="1">
                  <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel">Cancel</button>
                    <button type="button" class="btn btn-sm btn-navy btn-ok" data-id="{{ $product->id }}">OK</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

      <!-- Sidebar Kategori -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header bg-primary text-white">
            Product Category
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">All</a>
            </li>
            @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <a href="{{ route('product.filter', $category->id) }}" class="text-decoration-none text-dark">
                {{ $category->name }}
              </a>
              <span class="badge bg-secondary">{{ $category->products_count }}</span>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.btn-buy').forEach(button => {
      button.addEventListener('click', function() {
        const card = this.closest('.card');
        card.querySelector('.footer-buttons').classList.add('d-none');
        card.querySelector('.quantity-form').classList.remove('d-none');
      });
    });

    document.querySelectorAll('.btn-cancel').forEach(button => {
      button.addEventListener('click', function() {
        const card = this.closest('.card');
        card.querySelector('.quantity-form').classList.add('d-none');
        card.querySelector('.footer-buttons').classList.remove('d-none');
      });
    });

    document.querySelectorAll('.btn-ok').forEach(button => {
      button.addEventListener('click', function() {
        const card = this.closest('.card');
        const quantity = card.querySelector('.input-quantity').value;
        const productId = this.dataset.id;

        // Menambahkan item ke keranjang
        fetch('{{ route("cart.items.store") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            product_id: productId,
            quantity: Number(quantity)
          })
        }).then(res => res.json()).then(data => {

          console.log(data);
          // Menampilkan kembali tombol beli dan menyembunyikan input quantity
          card.querySelector('.quantity-form').classList.add('d-none');
          card.querySelector('.footer-buttons').classList.remove('d-none');

          // Memperbarui jumlah item di cart
          const badge = document.querySelector('#cart-badge');
          if (badge) badge.innerText = data.cartCount;
        });
      });
    });
  </script>
</body>

</html>