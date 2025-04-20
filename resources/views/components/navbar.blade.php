<style>
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #001f3f !important;
  }

  .navbar-brand {
    font-weight: 600;
    font-size: 1.2rem;
  }

  .btn-logout {
    border-color: #ffffff;
    color: #ffffff;
    transition: background-color 0.2s ease;
  }

  .btn-logout:hover {
    background-color: #ffffff;
    color: #001f3f;
  }
</style>

<nav class="navbar navbar-dark shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Admin Dashboard</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-outline-light btn-sm btn-logout">Logout</button>
    </form>
  </div>
</nav>
