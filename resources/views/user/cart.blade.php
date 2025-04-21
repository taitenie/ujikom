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

    @if($cart && $cart->items->count() > 0)
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
          @foreach($cart->items as $item)
          <tr>
            <td>{{ $item->product->name }}</td>
            <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
            <td>
              <div id="item-{{ $item->id }}" class="d-flex align-items-center gap-2">
                <div class="btn-group" role="group">
                  <button class="btn-update-qty btn btn-sm btn-outline-secondary"
                    data-id="{{ $item->id }}"
                    data-action="decrease">-</button>

                  <span class="px-2" id="qty-{{ $item->id }}">{{ $item->quantity }}</span>

                  <button class="btn-update-qty btn btn-sm btn-outline-secondary"
                    data-id="{{ $item->id }}"
                    data-action="increase">+</button>
                </div>
              </div>
    </div>
    </td>
    <td>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
    <td>
      <form action="{{ route('cart.items.destroy', $item) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Remove</button>
      </form>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
  </div>

  <div class="cart-summary">
    <h5>Total Quantity: <strong>{{ $cart->items->sum('quantity') }}</strong></h5>
    <h5>Total Price:
      <strong>
        Rp{{ number_format($cart->items->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
      </strong>
    </h5>
  </div>

  <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4">
    @csrf

    <div class="mb-3">
      <label for="payment_type" class="form-label">Payment Type</label>
      <select name="payment_type" id="payment_type" class="form-select" required>
        <option value="prepaid">Prepaid</option>
        <option value="postpaid">Postpaid</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="payment_method" class="form-label">Payment Method</label>
      <select name="payment_method" id="payment_method" class="form-select" required>
        <option value="bank">Bank Transfer</option>
        <option value="paypal">Paypal</option>
        <option value="cash">Cash</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="bank_name" class="form-label">Bank Name (Opsional)</label>
      <input type="text" name="bank_name" id="bank_name" class="form-control">
    </div>

    <button type="submit" class="btn btn-navy">Checkout</button>
  </form>

  @else
  <div class="alert alert-info mt-4" role="alert">
    Your cart is empty.
  </div>
  @endif
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function numberFormat(number) {
      if (typeof number !== 'number' || isNaN(number)) {
        return '0'; // Kembalikan nilai default jika bukan angka
      }
      return number.toLocaleString('id-ID');
    }

    document.addEventListener('DOMContentLoaded', () => {
      const buttons = document.querySelectorAll('.btn-update-qty');

      buttons.forEach(button => {
        button.addEventListener('click', () => {
          const itemId = button.dataset.id;
          const action = button.dataset.action;
          const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          fetch(`/cart/items/${itemId}`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-HTTP-Method-Override': 'PATCH'
              },
              body: JSON.stringify({
                action: action
              })
            })
            .then(res => res.json())
            .then(data => {
              const qtySpan = document.getElementById(`qty-${itemId}`);
              const row = qtySpan.closest('tr');

              console.log(data);

              if (data.deleted) {
                row.remove();
              } else {
                qtySpan.textContent = data.itemQuantity;

                // Update total harga produk
                const totalCell = row.querySelector('td:nth-child(4)');
                totalCell.textContent = 'Rp' + numberFormat(data.itemTotal);
              }

              // Update total quantity dan total harga cart
              const totalQty = document.querySelector('.cart-summary h5 strong');
              const totalPrice = document.querySelectorAll('.cart-summary h5 strong')[1];

              if (totalQty && totalPrice) {
                totalQty.textContent = data.cartTotalQuantity;
                totalPrice.textContent = 'Rp' + numberFormat(data.cartTotalPrice);
              }

              // Update cart count di navbar (jika ada)
              const cartCount = document.getElementById('cart-count');
              if (cartCount) cartCount.textContent = data.cartCount;
            })
        });
      });
    });
  </script>
</body>

</html>