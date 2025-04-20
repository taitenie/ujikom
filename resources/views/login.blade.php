<!DOCTYPE html>
<html>

<head>
    <title>Login - Toko Alat Kesehatan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 500px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .logo-box {
            width: 80px;
            height: 80px;
            background-color: #e0e0e0;
            text-align: center;
            line-height: 80px;
            font-weight: bold;
            margin-right: 20px;
            border-radius: 10px;
            font-size: 16px;
        }

        .welcome-text {
            font-size: 18px;
            font-weight: 600;
        }

        .btn-login {
            width: 40%;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <!-- Logo kiri + tulisan kanan -->
        <div class="d-flex align-items-center mb-4">
            <div class="logo-box">LOGO</div>
            <div class="welcome-text">
                Selamat datang di <br>
                Toko Alat Kesehatan
            </div>
        </div>


        @if (session('error'))
        <div class="alert alert-danger mt-3 text-center">
            {{ session('error') }}
        </div>
        @endif


        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">User ID</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror"
                    id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" placeholder="Masukkan password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-dark btn-login">LOGIN</button>
            </div>
        </form>

    </div>
</body>

</html>