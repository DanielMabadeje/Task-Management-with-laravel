@extends('layouts.app')

@section('content')
<div class="container">

    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
        
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }
        
        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("text");
            ev.target.appendChild(document.getElementById(data));
        }
        </script>
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
                


                        <a href="{{ url('/project/'.$data->project_id.'/tasks') }}" class="btn btn-secondary m-3">Back to tasks</a>

                        <!-- New Task Form -->
                        <form action="{{ url('project/'.$data->project_id.'/task/edit/'.$data->id) }}" method="POST" class="form-horizontal ">
                            {!! csrf_field() !!}
                
                            <!-- Task Name -->
                            <div class="form-group col-8">
                
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="task-name" placeholder="Edit task..." value="{{ $data->task_name }}" class="form-control">
                                </div>
                            </div>
                
                            <!-- Add Task Button -->
                            <div class="form-group col-4">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Edit Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
