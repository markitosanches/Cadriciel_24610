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
                        <a href="#" class="btn btn-sm btn-outline-success">Edit</a>
                        <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
@endsection