<style>
  .sidebar {
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    width: 220px;
    background-color: #001f3f;
    padding-top: 60px; /* menyesuaikan tinggi navbar */
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
  }

  .sidebar a {
    color: #f1f1f1;
    padding: 12px 24px;
    display: block;
    text-decoration: none;
    font-size: 0.95rem;
    font-weight: 500;
    transition: all 0.2s ease;
    border-left: 4px solid transparent;
  }

  .sidebar a:hover {
    background-color: #004080;
    color: #ffffff;
    border-left: 4px solid #ffffff;
  }

  .sidebar a.active {
    background-color: #003366;
    color: #ffffff;
    font-weight: 600;
    border-left: 4px solid #00d4ff; /* aksen aktif */
  }
</style>

<div class="sidebar">
  @php
  $routes = [
    ['name' => 'users.index', 'label' => 'Manage Users'],
    ['name' => 'admin.orders.index', 'label' => 'Incoming Orders'],
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