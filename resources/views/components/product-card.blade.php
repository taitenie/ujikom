<div class="col">
  <div class="card h-100 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ e($product->name) }}</h5>
      <p class="text-muted mb-2">{{ e($product->category->name) }}</p>
      <p class="fw-semibold text-success">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
    </div>

    <!-- Footer awal dengan tombol View & Buy -->
    <div class="card-footer d-flex justify-content-around footer-buttons">
      <a href="/" class="btn btn-sm btn-outline-primary">View</a>
      <button class="btn btn-sm btn-success btn-buy" data-id="{{ $product->id }}">Buy</button>
    </div>

    <!-- Input Quantity, disembunyikan awalnya -->
    <div class="card-footer d-none quantity-form">
      <div class="text-center w-100">
        <input type="number" min="1" class="form-control mb-2 input-quantity" value="1">
        <div class="d-flex justify-content-center gap-2">
          <button class="btn btn-sm btn-primary btn-ok" data-id="{{ $product->id }}">OK</button>
          <button class="btn btn-sm btn-secondary btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>