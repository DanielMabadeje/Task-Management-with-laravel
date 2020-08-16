@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task Management App</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="panel-body">
                        <!-- Display Validation Errors -->
                        {{--  @include('common.errors')  --}}
                
                        <!-- New Task Form -->
                        <form action="{{ url('project') }}" method="POST" class="form-horizontal row">
                            {!! csrf_field() !!}
                
                            <!-- Task Name -->
                            <div class="form-group col-8">
                                {{--  <label for="task" class="col-sm-3 control-label">Task</label>  --}}
                
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="task-name" placeholder="Enter New Project..." class="form-control">
                                </div>
                            </div>
                
                            <!-- Add Task Button -->
                            <div class="form-group col-4">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Add Project
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Project Name</th>
                            <th scope="col">No of Tasks</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $project):
                          <tr>
                            <th scope="row">
                               {{-- {{ $i++ }} --}}
                            </th>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->no_of_tasks }}</td>
                            <td><a class="btn btn-secondary" href="{{  url('project/'.$project->id.'/tasks') }}">View</a></td>
                            <td><a class="btn btn-danger" href="{{  url('project/'.$project->id.'/delete') }}">Delete</a></td>
                          </tr>
                          @endforeach;
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
