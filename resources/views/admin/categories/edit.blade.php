<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      overflow-x: hidden;
    }

    .main-content {
      margin-top: 50px;
      margin-left: 220px;
      padding: 30px;
    }

    .btn-primary {
      background-color: #001f3f;
      border-color: #001f3f;
    }

    .btn-primary:hover {
      background-color: #003366;
      border-color: #003366;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <x-navbar />

  <!-- Sidebar -->
  <x-sidebar />

  <!-- Main Content -->
  <div class="main-content">
    <div class="container mt-4">
      <h2 class="mb-4">Edit Category</h2>

      <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <input type="text" name="name" id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $category->name) }}" required>
          @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description"
            class="form-control @error('description') is-invalid @enderror"
            rows="4" required>{{ old('description', $category->description) }}</textarea>
          @error('description')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-primary">Update Category</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>