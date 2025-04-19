<?php
$user = Auth::user();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ $user->username }}, {{ $user->role }}</h1>
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>
