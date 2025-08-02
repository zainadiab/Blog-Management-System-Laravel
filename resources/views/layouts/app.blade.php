<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    @php
        $currentRoute = Route::currentRouteName();
        $homeRoutes = ['posts.index', 'login', 'register'];
    @endphp

    @if (!in_array($currentRoute, $homeRoutes))
        <a class="navbar-brand" href="{{ route('posts.index') }}">← Back to Posts</a>
    @else
        <span class="navbar-brand">Blog Management System</span>
    @endif

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
          </li>
        @else
          <li class="nav-item me-3">
            <span class="nav-link">Hello, {{ auth()->user()->name }}</span>
          </li>
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-link nav-link p-0 m-0">Logout</button>
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
