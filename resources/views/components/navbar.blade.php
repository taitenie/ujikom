<style>
  .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
  }
</style>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Admin Dashboard</a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-outline-light btn-sm">Logout</button>
    </form>
  </div>
</nav>