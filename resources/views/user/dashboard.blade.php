<?php
$user = Auth::user();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Halaman Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h3>Product Page</h3>
    <div class="row mt-4">
      <!-- Daftar Produk -->
      <div class="col-md-9">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <!-- Product Card -->
          <div class="col" *ngFor="let product of products">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 1</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
          <!-- Ulangi 6 kali -->
          <div class="col">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 2</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 3</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 4</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 5</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Product 6</h5>
              </div>
              <div class="card-footer d-flex justify-content-around">
                <button class="btn btn-md btn-outline-primary">View</button>
                <button class="btn btn-md btn-success">Buy</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar Kategori -->
      <div class="col-md-3">
        <div class="border p-3">
          <h5>Product Category</h5>
          <!-- Isi kategori bisa ditambahkan di sini -->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>