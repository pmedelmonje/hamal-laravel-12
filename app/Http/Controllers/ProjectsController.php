<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $project_types = ProjectType::all();
        $projects = Project::paginate(6);

        return view('projects.projects-index', [
            'title' => 'Proyectos | Pedro Medel M.',
            'hero_title' => 'Proyectos',
            'hero_subtitle' => 'Mis proyectos más relevantes',
            'project_types' => $project_types,
            'projects' => $projects
        ]);
    }

    public function filtered_projects(Request $request, $slug)
    {
        $project_types = ProjectType::all();
        $filtered_project_type = ProjectType::where('slug', $slug)->first();
        $projects = Project::where('project_type_id', $filtered_project_type->id)
        ->paginate(6);

        return view('projects.projects-index', [
            'title' => 'Proyectos | Pedro Medel M.',
            'hero_title' => 'Proyectos',
            'hero_subtitle' => 'Mis proyectos más relevantes',
            'project_types' => $project_types,
            'projects' => $projects
        ]);
    }

    public function show(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first();

        //TODO: Crear la vista
        return view('projects.projects-show', [
            'project' => $project,
            'title' => $project->name,
            'hero_title' => 'Información de proyecto',
            'hero_subtitle' => '',
        ]);
    }
}
