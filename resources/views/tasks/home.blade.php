<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Task Management</h1>

        <div class="row mb-4">
            <div class="col-6">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a>
            </div>
            <div class="col-6 text-end">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add Task</a>
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="bg-success text-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td class="text-center">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>

    </div>
       
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
