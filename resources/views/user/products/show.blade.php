<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <div class="container mt-4">
      <div class="row">
        <div class="col-md-6">
          @if ($product->image)
          <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
          @else
          <img src="" class="img-fluid rounded" alt="No Image">
          @endif
        </div>
        <div class="col-md-6">
          <h2>{{ $product->name }}</h2>
          <p class="text-muted">Category: <strong>{{ $product->category->name ?? 'Uncategorized' }}</strong></p>
          <h4 class="text-primary">Rp{{ number_format($product->price, 0, ',', '.') }}</h4>
          <p>{{ $product->description }}</p>

          <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
            @csrf
            <div class="input-group" style="max-width: 200px;">
              <input type="number" name="quantity" class="form-control" value="1" min="1">
              <button class="btn btn-success" type="submit">Add to Cart</button>
            </div>
          </form>

          <a href="{{ route('dashboard') }}" class="btn btn-link mt-3">← Back to Products</a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>