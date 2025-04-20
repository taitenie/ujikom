<style>
  .sidebar {
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    width: 220px;
    background-color: #001f3f;
    padding-top: 60px;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
  }

  .sidebar a {
    color: #f1f1f1;
    padding: 14px 24px;
    display: block;
    text-decoration: none;
    font-size: 0.95rem;
    transition: background-color 0.2s ease;
  }

  .sidebar a.active {
    background-color: #003366;
    color: #ffffff;
    font-weight: 600;
  }

  .sidebar a:hover {
    background-color: #004080;
    color: #ffffff;
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
