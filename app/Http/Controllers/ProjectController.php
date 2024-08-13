<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    protected $project;

    public function __construct()
    {
        $this->project = new Project();
    }

    public function index()
    {
        $response['projects'] = $this->project->all();
        return view('pages.project')->with($response);
    }

    public function create()
    {
        return view('pages.editproject');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $this->project->create($validatedData);
        return redirect()->route('projects.index');
    }

    public function edit(string $id)
    {
        $response['project'] = $this->project->find($id);
        return view('pages.projects.edit')->with($response);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        $project = $this->project->find($id);
        $project->update($validatedData);
        return redirect()->route('projects.index');
    }

    public function destroy(string $id)
    {
        $project = $this->project->find($id);
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function getTasks($id)
    {
        $project = $this->project->find($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found.'], 404);
        }

        // Fetch all tasks related to the project
        $tasks = $project->tasks;

        return response()->json($tasks);
    }

}
