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
  <div class="container">
    <h2 class="my-4">Shopping Cart</h2>

    <a href="/">Back to Home</a>

    @if(session('cart') && count($cart) > 0)
    <table class="table">
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cart as $productId => $item)
        <tr>
          <td>{{ $item['name'] }}</td>
          <td>{{ number_format($item['price'], 0, ',', '.') }}</td>
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
          <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
          <td>
            <form action="{{ route('cart.remove') }}" method="POST">
              @csrf
              @method('DELETE')
              <input type="hidden" name="product_id" value="{{ $productId }}">
              <button type="submit" class="btn btn-danger">Remove</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="cart-summary">
      <h4>Total Quantity: {{ $totalQuantity }}</h4>
      <h4>Total Price: Rp{{ number_format($totalPrice, 0, ',', '.') }}</h4>
    </div>
    @else
    <p>Your cart is empty.</p>
    @endif
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>