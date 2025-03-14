<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .sidebar {
            height: 100vh;
            background-color: rgb(188, 190, 192);
            padding-top: 20px;
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

        .dashboard-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .task-card {
            cursor: pointer;
            transition: transform 0.2s;
            margin-top: 80px;
        }

        .task-card:hover {
            transform: scale(1.05);
        }

        .card.pending {
            background-color: #FF6384;
            color: #000;
        }

        .card.in-progress {
            background-color: #FFCE56;
            color:#005;
        }

        .card.completed {
            background-color: #36A2EB;
            color:#010;
        }

        .chart-container {
            width: 300px;
            height: 300px;
            margin-top: 80px;
        }

        .task-management-link {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                <a href="{{ url('settings') }}">Settings</a>
                <a href="{{ url('logout') }}" class="text-danger" onclick="return confirm('Are you sure you want to Logut?');">Logout</a>
            </div>

            <!-- Main content -->
            <div class="col-md-9 dashboard-content">

                <!-- Welcome message -->
                <h2 class="mb-4 mt-4">Welcome to Your Dashboard!</h2>

                <!-- Task Management link -->
                <div class="task-management-link">
                    <a href="{{ route('tasks') }}" class="btn btn-primary">Task Management</a>
                </div>

                <!-- Task Status Overview -->
                <div class="row mt-4 text-center">
                    <div class="col-md-4">
                        <a href="{{ route('tasks', ['status' => 'pending']) }}" class="text-decoration-none">
                            <div class="card task-card shadow-sm pending">
                                <div class="card-body">
                                    <h5 class="card-title">Pending Tasks</h5>
                                    <p class="card-text display-6">{{ $pendingCount }}</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('tasks', ['status' => 'in_progress']) }}" class="text-decoration-none">
                            <div class="card task-card shadow-sm in-progress">
                                <div class="card-body">
                                    <h5 class="card-title">In Progress Tasks</h5>
                                    <p class="card-text display-6">{{ $inProgressCount }}</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ route('tasks', ['status' => 'completed']) }}" class="text-decoration-none">
                            <div class="card task-card shadow-sm completed">
                                <div class="card-body">
                                    <h5 class="card-title">Completed Tasks</h5>
                                    <p class="card-text display-6">{{ $completedCount }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Circular Bar Graph -->
                <div class="chart-container">
                    <canvas id="taskChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        const pendingCount = {{ $pendingCount ?? 0 }};
        const inProgressCount = {{ $inProgressCount ?? 0 }};
        const completedCount = {{ $completedCount ?? 0 }};
        
        const ctx = document.getElementById('taskChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Task Distribution',
                    data: [pendingCount, inProgressCount, completedCount],
                    backgroundColor: ['#FF6384', '#FFCE56', '#36A2EB'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>

</body>

</html>
