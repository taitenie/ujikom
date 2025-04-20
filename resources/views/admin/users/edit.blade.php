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

    h3 {
      color: #001f3f;
      font-weight: bold;
    }

    .btn-primary {
      background-color: #001f3f;
      border-color: #001f3f;
    }

    .btn-primary:hover {
      background-color: #003366;
      border-color: #003366;
    }

    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .form-label {
      font-weight: 500;
      color: #001f3f;
    }

    .form-control,
    .form-select {
      border: 1px solid #ced4da;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: #001f3f;
      box-shadow: 0 0 0 0.2rem rgba(0, 31, 63, 0.25);
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
      <h3>Edit User - {{ $user->username }}</h3>
      <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username ?? '') }}" required>
          @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email ?? '') }}" required>
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="birth" class="form-label">Birth Date</label>
          <input type="date" name="birth" class="form-control @error('birth') is-invalid @enderror" value="{{ old('birth', $user->birth ?? '') }}" required>
          @error('birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="gender" class="form-label">Gender</label>
          <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
            <option value="male" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
          </select>
          @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $user->address ?? '') }}" required>
          @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $user->city ?? '') }}" required>
          @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="number" class="form-label">Phone Number</label>
          <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number', $user->number ?? '') }}" required>
          @error('number') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="paypalId" class="form-label">PayPal ID</label>
          <input type="text" name="paypalId" class="form-control @error('paypalId') is-invalid @enderror" value="{{ old('paypalId', $user->paypalId ?? '') }}" required>
          @error('paypalId') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Role</label>
          <select name="role" class="form-select @error('role') is-invalid @enderror" required>
            <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
          @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>