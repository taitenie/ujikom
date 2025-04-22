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
      <h2 class="mb-4">Category List</h2>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">+ Add Category</a>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categories as $category)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->description }}</td>
              <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Delete</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center">No categories available.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>