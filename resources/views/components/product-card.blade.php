<div class="col">
  <div class="card h-100 text-center">
    <div class="card-body">
      <h5 class="card-title">{{ e($product->name) }}</h5>
      <p class="text-muted mb-2">{{ e($product->category->name) }}</p>
      <p class="fw-semibold product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
    </div>

    <!-- Footer dengan tombol View-->
    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center px-3 py-3 footer-buttons">
      <a href="{{ route('products.show', $product->id) }}" class="btn btn-navy-outline btn-view w-100 me-2 d-flex justify-content-center align-items-center gap-2">
        View
      </a>
      <button class="btn btn-navy btn-buy w-100 ms-2 d-flex justify-content-center align-items-center gap-2" data-id="{{ $product->id }}">
        Buy
      </button>
    </div>

    <!-- Input Quantity, disembunyikan awalnya -->
    <div class="card-footer d-none quantity-form">
      <div class="d-flex flex-column align-items-center w-100">
        <input type="number" min="1" class="form-control mb-2 input-quantity text-center" value="1" style="max-width: 100px;">
        <div class="d-flex justify-content-center gap-2">
          <button class="btn btn-sm btn-primary btn-ok" data-id="{{ $product->id }}">OK</button>
          <button class="btn btn-sm btn-secondary btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>