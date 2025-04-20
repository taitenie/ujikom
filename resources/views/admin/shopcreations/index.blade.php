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
      <h2 class="mb-4">Shop Creation Requests</h2>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Shop Name</th>
              <th>Description</th>
              <th>Status</th>
              <th>Requested By</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($shops as $shop)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $shop->name }}</td>
              <td>{{ $shop->description }}</td>
              <td><span class="badge bg-{{ $shop->status === 'approved' ? 'success' : ($shop->status === 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($shop->status) }}</span></td>
              <td>{{ $shop->user->username ?? 'Unknown' }}</td>
              <td>{{ $shop->created_at->format('d M Y') }}</td>
              <td>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal" data-status="approved" data-id="{{ $shop->id }}">Approve</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal" data-status="rejected" data-id="{{ $shop->id }}">Reject</button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center">No shop requests yet.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <x-modal-shopcreation-confirm />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>