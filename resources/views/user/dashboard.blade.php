<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <div class="row mb-4">
      <div class="col">
        <h3>Welcome, {{ auth()->user()->username }}</h3>
      </div>
    </div>
    
    <h3>Product Page</h3>
    <a href="/" class="btn btn-primary mb-3">Request Shop Creation</a>
    <a href="{{ route('cart.index') }}" class="btn position-relative">
      🛒
      <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ session('cart') ? count(session('cart')) : 0 }}
      </span>
    </a>


    <div class="row mt-4">
      <!-- Daftar Produk -->
      <div class="col-md-9">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @foreach ($products as $product)
          <x-product-card :product="$product" />
          @endforeach
        </div>
      </div>

      <!-- Sidebar Kategori -->
      <div class="col-md-3">
        <div class="border p-3">
          <h5>Product Category</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                All
              </a>
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

        fetch('{{ route("cart.add") }}', {
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
          card.querySelector('.quantity-form').classList.add('d-none');
          card.querySelector('.footer-buttons').classList.remove('d-none');

          // Update badge cart count
          const badge = document.querySelector('#cart-badge');
          if (badge) badge.innerText = data.cartCount;
        });
      });
    });
  </script>


</body>

</html>