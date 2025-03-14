<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 400px;">
            <div class="card-header text-center">
                <h2>Login</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('register') }}">Don't have an account? Register here</a>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
