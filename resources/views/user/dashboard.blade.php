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


    .btn-outline-light {
      background-color: transparent;
      border: 2px solid var(#fff);
      color: var(#fff);
    }

    .btn-outline-light:hover {
      background-color: transparent;
      color: white;
    }

    .product-price {
      font-size: 1rem;
      color: var(--navy);
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
  <!-- Header -->
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
  <div class="container mt-3" id="alert-container"></div>
  <div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-3 text-navy">📋 Product Page</h2>
      <div class="d-flex gap-3">
        <a href="{{ route('cart.index') }}" class="btn position-relative btn-outline-dark">
          🛒
          <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ auth()->user()->cart ? auth()->user()->cart->items->count() : 0 }}
          </span>
        </a>
        <a href="{{ route('orders.index') }}" class="btn position-relative btn-outline-dark">
          📦
          <span id="order-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ auth()->user()->orders ? auth()->user()->orders->count() : 0 }}
          </span>
        </a>
      </div>
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
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center px-3 py-3 footer-buttons">
                  <a href="{{ route('products.show', $product->id) }}" class="btn btn-navy-outline btn-view w-100 me-2 d-flex justify-content-center align-items-center gap-2">
                    View
                  </a>
                  <button class="btn btn-navy btn-buy w-100 ms-2 d-flex justify-content-center align-items-center gap-2" 
                    data-id="{{ $product->id }}" 
                    data-stock="{{ $product->stock }}">
                    Buy
                  </button>
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
            <li class="list-group-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark stretched-link">All</a>
            </li>
            @foreach ($categories as $category)
            <li class="list-group-item position-relative d-flex justify-content-between align-items-center {{ request()->is('filter/'.$category->id) ? 'active' : '' }}">
              <a href="{{ route('product.filter', $category->id) }}" class="text-decoration-none text-dark stretched-link">
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
<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function showAlert(message, type = 'danger') {
    const alertContainer = document.getElementById('alert-container');
    alertContainer.innerHTML = `
      <div class="alert alert-${type} alert-dismissible fade show" role="alert" id="custom-alert">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;
  }

  function removeAlert() {
    const alertEl = document.getElementById('custom-alert');
    if (alertEl) {
      alertEl.remove();
    }
  }

  document.querySelectorAll('.btn-buy').forEach(button => {
    button.addEventListener('click', function () {
      const card = this.closest('.card');
      const quantityInput = card.querySelector('.input-quantity');
      const stock = this.dataset.stock;

      quantityInput.max = stock;
      quantityInput.value = 1;

      card.querySelector('.footer-buttons').classList.add('d-none');
      card.querySelector('.quantity-form').classList.remove('d-none');
    });
  });

  document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', function () {
      const card = this.closest('.card');
      card.querySelector('.quantity-form').classList.add('d-none');
      card.querySelector('.footer-buttons').classList.remove('d-none');
      removeAlert(); // Hapus alert jika ada
    });
  });

  // ✅ Hapus alert jika quantity berubah
  document.querySelectorAll('.input-quantity').forEach(input => {
    input.addEventListener('input', () => {
      removeAlert();
    });
  });

  document.querySelectorAll('.btn-ok').forEach(button => {
    button.addEventListener('click', function () {
      const card = this.closest('.card');
      const quantity = card.querySelector('.input-quantity').value;
      const productId = this.dataset.id;

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
      })
      .then(async res => {
        const data = await res.json();
        if (!res.ok) {
          throw new Error(data.message || 'Terjadi kesalahan.');
        }
        return data;
      })
      .then(data => {
        card.querySelector('.quantity-form').classList.add('d-none');
        card.querySelector('.footer-buttons').classList.remove('d-none');

        const badge = document.querySelector('#cart-badge');
        if (badge) badge.innerText = data.cartCount;

        removeAlert(); // Hapus alert kalau sukses
      })
      .catch(err => {
        showAlert(err.message); // Tampilkan alert error
      });
    });
  });
</script>
</body>

</html>