<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            background-color: rgb(188, 190, 192);
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; 
        }
        .sidebar a {
            color: #000;
            padding: 10px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .profile-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
        }

        .sidebar-links {
            margin-top: auto; 
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 sidebar">
                <h3 class="text-center">Profile</h3>
                <div class="text-left mb-3">
                    @if(auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Profile Image" class="profile-image">
                    @else
                        <div class="profile-icon">
                            <i class="bi bi-person"></i> 
                        </div>
                    @endif
                    <h5>{{ auth()->user()->name }}</h5>
                    <p>{{ auth()->user()->email }}</p>
                    <p><small>On: {{ auth()->user()->created_at->format('M d, Y') }}</small></p>
                </div>

                <div class="sidebar-links">
                    <a href="{{ url('settings') }}">Settings</a>
                    
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Logout?');">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <div class="container mt-4">
                    <h2>Update Profile</h2>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Profile Update Form -->
                    <form action="{{ route('settings.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control" id="profile_image">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" id="email" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password (Leave empty to keep current password)</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                        </div>

                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
