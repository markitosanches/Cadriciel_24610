@extends('layouts.app')
@section('title', 'Task')
@section('content')

    <h1 class="mt-5 mb-4"> Task</h1>
    <div class="row">

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">{{$task->title}}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$task->description}}</p>
                    <ul class="list-unstyled">
                        <li><strong>Completed: {{$task->completed ? 'Yes' : 'No'}}</strong></li>
                        <li><strong>Due Date: {{$task->due_date}}</strong></li>
                        <li><strong>Author: {{$task->user_id}}</strong></li>
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('task.edit', $task->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete Modal
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure to delete the task: <strong>{{ $task->title }}</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="post">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger" value="Delete">
        </form>
      </div>
    </div>
  </div>
</div>
@endsection