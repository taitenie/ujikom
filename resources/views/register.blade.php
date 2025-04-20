<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f3f4f6;
        }
        .register-box {
            max-width: 700px;
            margin: 60px auto;
            padding: 30px;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }
        h4 {
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
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h4 class="text-center mb-4">FORM REGISTRASI</h4>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Password:</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Retype Password:</label>
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>E-mail:</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Date of birth:</label>
                <input type="date" name="birth" class="form-control @error('birth') is-invalid @enderror" value="{{ old('birth') }}">
                @error('birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Gender:</label><br>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                    <label class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input @error('gender') is-invalid @enderror" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                    <label class="form-check-label">Female</label>
                </div>
                @error('gender') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Address:</label>
                <textarea name="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>City:</label>
                <select name="city" class="form-select @error('city') is-invalid @enderror">
                    <option value="">-- Pilih Kota --</option>
                    <option value="Ambon" {{ old('city') == 'Ambon' ? 'selected' : '' }}>Ambon</option>
                    <option value="Bandung" {{ old('city') == 'Bandung' ? 'selected' : '' }}>Bandung</option>
                    <option value="Jakarta" {{ old('city') == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                </select>
                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Contact no:</label>
                <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}">
                @error('number') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Pay-pal ID:</label>
                <input type="text" name="paypalId" class="form-control @error('paypalId') is-invalid @enderror" value="{{ old('paypalId') }}">
                @error('paypalId') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>
</body>
</html>