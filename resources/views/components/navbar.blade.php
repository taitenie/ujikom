<style>
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #001f3f !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    padding: 0.5rem 1rem;
  }

  .navbar .navbar-brand {
    font-weight: 600;
    font-size: 1.25rem;
    color: #ffffff !important;
  }

  .navbar .brand-logo {
    height: 42px;
    width: 42px;
    object-fit: cover;
    border-radius: 50%;
    margin-right: 12px;
  }

  .btn-logout {
    border-color: #ffffff;
    color: #ffffff;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    transition: background-color 0.2s ease, color 0.2s ease;
  }

  .btn-logout:hover {
    background-color: #ffffff;
    color: #001f3f;
  }
</style>

<nav class="navbar navbar-dark">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Logo + App Name -->
    <div class="d-flex align-items-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="brand-logo">
      <span class="fw-bold fs-4 text-light">HealthBud Admin Dashboard</span>
    </div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="mb-0">
      @csrf
      <button class="btn btn-outline-light btn-sm btn-logout">Logout</button>
    </form>
  </div>
</nav>