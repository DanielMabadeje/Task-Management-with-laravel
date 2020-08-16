<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\ProjectRepository;
use App\Http\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepo, TaskRepository $taskRepo)
    {
        $this->middleware('auth');
        $this->projectRepository = $projectRepo;
        $this->taskRepository = $taskRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function add($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        $request->project_id = $id;

        // Create The Project...
        $result = $this->taskRepository->add($request);
        $this->projectRepository->update_no_of_tasks($id, 'add');
        return redirect('/project/' . $id . '/tasks');
        // Create The Project...
    }

    public function view_tasks($id)
    {
        // dd($);
        $data = $this->projectRepository->view_tasks($id);
        $data->project_id = $id;
        return view('projects.tasks.task', compact('data'));
    }


    public function show($id, $task)
    {
        $data=$this->taskRepository->show($id, $task);
        $data->project_id=$id;
        $data->task_id=$task;
        return view('projects.tasks.edittask', compact('data'));
    }

    public function edit($id,$task, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($this->taskRepository->edit($id, $task, $request)) {
            return redirect('/project/'.$id.'/tasks');
        } else {
            # code...
        };
    }

    public function delete($id,$task)
    {
        $this->taskRepository->delete($task);
        $this->projectRepository->update_no_of_tasks($id, 'subtract');
        return redirect('/project/'.$id.'/tasks');
    }


    public function update_tasks_by_priority($project_id, Request $request){
        if($this->taskRepository->update_tasks_by_priority($project_id, $request)){
            return response('Update Successfully.', 200);
        }else{
            return response('Something went wrong.', 500);
        }
    }
}
