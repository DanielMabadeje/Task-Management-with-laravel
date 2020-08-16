<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepo)
    {
        $this->middleware('auth');
        $this->projectRepository = $projectRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->projectRepository->index();
        return view('projects.project', compact('data'));
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // Create The Project...
        $result = $this->projectRepository->add($request);
        return redirect('/project');
        // Create The Project...
    }

    public function view_tasks($id)
    {
        // dd($);
        $data=$this->projectRepository->view_tasks($id);
        $data->project_id=$id;
        $data->no=1;
        return view('projects.tasks.task', compact('data'));
    }

    public function edit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

    }

    public function delete($id)
    {
        $this->projectRepository->delete($id);
        return redirect('/project');
    }
}
