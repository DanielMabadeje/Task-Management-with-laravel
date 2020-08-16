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
                        <form action="{{ url('task') }}" method="POST" class="form-horizontal row">
                            {!! csrf_field() !!}
                
                            <!-- Task Name -->
                            <div class="form-group col-8">
                                {{--  <label for="task" class="col-sm-3 control-label">Task</label>  --}}
                
                                <div class="col-sm-12">
                                    <input type="text" name="name" id="task-name" placeholder="Enter New Task or Todo..." class="form-control">
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

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                          </tr>
                        </tbody>
                      </table>

                    You are logged in as A User!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
