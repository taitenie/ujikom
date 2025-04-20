<style>
  .sidebar {
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    width: 220px;
    background-color: #343a40;
    padding-top: 60px;
  }

  .sidebar a {
    color: #fff;
    padding: 12px 20px;
    display: block;
    text-decoration: none;
  }

  .sidebar a.active {
    background-color: #007bff;
    color: white;
  }

  .sidebar a:hover {
    background-color: #495057;
  }
</style>

<div class="sidebar">
  @php
    $routes = [
      ['name' => 'users.index', 'label' => 'Manage Users'],
      ['name' => 'orders.index', 'label' => 'Incoming Orders'],
      ['name' => 'categories.index', 'label' => 'Manage Categories'],
      ['name' => 'shops.index', 'label' => 'Approve Shops'],
    ];
  @endphp

  @foreach ($routes as $route)
    <a 
      href="{{ route($route['name']) }}" 
      class="{{ request()->routeIs($route['name']) ? 'active' : '' }}">
      {{ $route['label'] }}
    </a>
  @endforeach
</div>