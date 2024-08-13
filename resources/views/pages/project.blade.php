@extends('layouts.app')

@section('content')

<div class="container">

    <h3 align="center" class="mt-5">Project Management</h3>

    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <a href="{{ route('employee.index') }}" class="btn btn-info">Lihat Karyawan</a>
        </div>
    </div>

    <table class="table mt-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Project Name</th>
                <th scope="col">Description</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $key => $project)
            <tr>
                <td scope="col">{{ ++$key }}</td>
                <td scope="col">{{ $project->name }}</td>
                <td scope="col">{{ $project->description }}</td>
                <td scope="col">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d M Y') : 'N/A' }}</td>
                <td scope="col">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('d M Y') : 'N/A' }}</td>
                <td scope="col">
                    <button class="btn btn-secondary btn-sm" onclick="toggleTasks('{{ $project->id }}')">View Tasks</button>
                    <a href="{{ route('projects.edit', $project->id) }}">
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                        </button>
                    </a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <tr id="tasks-{{ $project->id }}" class="task-row" style="display: none;">
                <td colspan="6">
                    <ul id="task-list-{{ $project->id }}" class="list-group">
                        <!-- Tasks will be dynamically inserted here -->
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection

@push('css')
<style>
    .btn-info {
        background-color: #28a745;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .task-row {
        background-color: #f9f9f9;
    }
</style>
@endpush

@push('js')
<script>
    function toggleTasks(projectId) {
        var tasksRow = document.getElementById('tasks-' + projectId);
        var taskList = document.getElementById('task-list-' + projectId);

        if (tasksRow.style.display === 'none') {
            tasksRow.style.display = 'table-row';
            fetchTasks(projectId);
        } else {
            tasksRow.style.display = 'none';
        }
    }

    function fetchTasks(projectId) {
        fetch('{{ url('projects') }}/' + projectId + '/tasks')
            .then(response => response.json())
            .then(data => {
                var taskList = document.getElementById('task-list-' + projectId);
                taskList.innerHTML = ''; // Clear previous tasks

                data.forEach(task => {
                    var listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = task.name + ' - ' + task.status;
                    taskList.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error fetching tasks:', error);
            });
    }
</script>
@endpush
