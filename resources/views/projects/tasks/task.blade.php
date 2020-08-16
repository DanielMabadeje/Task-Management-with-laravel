@extends('layouts.app')


<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

 
</head>
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
                


                        <a href="{{ url('/project') }}" class="btn btn-secondary m-3">Back to Projects</a>

                        <!-- New Task Form -->
                        <form action="{{ url('project/'.$data->project_id.'/task/add') }}" method="POST" class="form-horizontal row">
                            {!! csrf_field() !!}
                
                            <!-- Task Name -->
                            <div class="form-group col-8">
                                {{--  <label for="task" class="col-sm-3 control-label">Task</label>  --}}
                
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="task-name" placeholder="Enter New task..." class="form-control">
                                </div>
                            </div>
                
                            <!-- Add Task Button -->
                            <div class="form-group col-4">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-plus"></i> Add Task
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <table class="table" id="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th>No</th>
                            <th scope="col">Task</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete Actions</th>
                          </tr>
                        </thead>
                        <tbody id="tablecontents">
                          @foreach($data as $task):
                          <tr class="row1" data-id="{{ $task->id }}">
                            <td class="pl-3"><i class="fa fa-sort"></i></td>
                            <td> {{ $data->no++ }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>{{ $task->priority }}</td>
                            <td><a class="btn btn-secondary" href="{{  url('project/'.$data->project_id.'/task/edit/'.$task->id) }}">Edit</a></td>
                            <td><a class="btn btn-danger" href="{{  url('project/'.$data->project_id.'/task/'.$task->id.'/delete') }}">Delete</a></td>
                          </tr>
                          @endforeach;
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js" defer></script>


<script type="text/javascript">
  $(function () {
    $("#table").DataTable();

    $("#tablecontents").sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendpriority();
      }
    });

    function sendpriority() {
      var priority = [];
      var token = $('meta[name="csrf-token"]').attr('content');
      $('tr.row1').each(function(index,element) {
        priority.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ url('/project/'.$data->project_id.'/task/reorder') }}",
            data: {
          priority: priority,
          _token: token
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

      window.location.reload()
    }
  });
</script>
@endsection
