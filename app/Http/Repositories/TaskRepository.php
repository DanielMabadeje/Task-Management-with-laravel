<?php

namespace App\Http\Repositories;

use App\Project;
use App\Task;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;


class TaskRepository
{
    public function __construct(Project $projectModel, Task $taskModel)
    {
        $this->projectModel = $projectModel;
        $this->taskModel = $taskModel;
    }



    public function add($data)
    {

        $this->taskModel->create([
            'user_id' => auth()->user()->id,
            'project_id' => $data->project_id,
            'task_name' => $data->name,
            'priority' => 0
        ]);
    }

    public function view_tasks($project_id)
    {
        $data = $this->taskModel->where('project_id', $project_id)->orderBy('priority', 'ASC')->get();
        return $data;
    }

    public function show($project_id, $task_id)
    {
        $result = $this->taskModel->where('id', $task_id)->first();
        return $result;
    }

    public function edit($project_id, $task_id, $data)
    {
        $task = $this->taskModel->where('id', $task_id)->first();
        $task->task_name = $data->name ? $data->name : $task->task_name;

        // dd($task);
        return $task->save() ? $task : false;
    }
    public function delete($task)
    {
        if ($this->taskModel->where('id', $task)->delete($task)) {
            return true;
        } else {
            return false;
        }
    }
    public function update_tasks_by_priority($project_id, $data)
    {
        $tasks = $this->taskModel->where('project_id', $project_id)->orderBy('priority', 'ASC')->get();

        foreach ($tasks as $task) {
            foreach ($data->priority as $priority) {
                if ($priority['id'] == $task->id) {
                    $task->update(['priority' => $priority['position']]);
                }
            }
        }

        return true;
    }
}
