<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-image: url('https://img.freepik.com/free-photo/desk-concept-frame-with-items_23-2148604882.jpg'); background-size: cover;">

    <div class="container text-center" style="padding-top: 100px;">
        <h1>Welcome to Our Application!</h1>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary m-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success m-2">Register</a>
        @endguest
 
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-primary m-2">Go to Dashboard</a>
        @endauth
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
