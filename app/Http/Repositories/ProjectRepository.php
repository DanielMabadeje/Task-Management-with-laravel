<?php

namespace App\Http\Repositories;

use App\Project;
use App\Task;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


class ProjectRepository
{
    public function __construct(Project $projectModel, Task $taskModel)
    {
        $this->projectModel = $projectModel;
        $this->taskModel = $taskModel;
    }



    public function index()
    {
        $user_id = auth()->user()->id;
        $data = $this->projectModel->where('user_id', $user_id)->get();
        return $data;
    }

    public function add($data)
    {

        $this->projectModel->create([
            'user_id' => auth()->user()->id,
            'name' => $data->name,
            'no_of_tasks' => 0
        ]);
    }

    public function view_tasks($project_id)
    {
        $data = $this->taskModel->where('project_id', $project_id)->orderBy('priority','ASC')->get();
        return $data;
    }

    public function update_no_of_tasks($id, $action)
    {
        $project = $this->projectModel->where('id', $id)->first();

        $project->no_of_tasks=intval($project->no_of_tasks);
        if ($action == 'add') {
            $project->no_of_tasks = $project->no_of_tasks+1;
            $project->no_of_tasks = $project->no_of_tasks ? $project->no_of_tasks : $project->no_of_tasks;

        } else {
            $project->no_of_tasks = $project->no_of_tasks-1;
            $project->no_of_tasks = $project->no_of_tasks ? $project->no_of_tasks : $project->no_of_tasks;
        }

        return $project->save() ? $project : false;
    }

    public function delete($id)
    {
        if ($this->projectModel->where('id', $id)->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
