<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectsDashboardController extends Controller
{
    public function index(Request $request)
    {
        $projectTypes = ProjectType::orderBy('index')->get();
        
        $projects = Project::when($request->type, function($query, $type) {
                return $query->where('project_type_id', $type);
            })
            ->with('projectType')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboards.projects.projects-dashboard-index', [
            'projects' => $projects,
            'projectTypes' => $projectTypes,
            'selectedType' => $request->type
        ]);
    }

    public function create(Request $request)
    {
        $projectTypes = ProjectType::with('projects')->get(['id', 'name']);

        return view('dashboards.projects.projects-dashboard-create',
        compact('projectTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_type_id' => ['required', 'exists:project_types,id'],
            'name' => ['string', 'required', 'unique:projects,name,projects:id'],
            'technologies' => ['string', 'required'],
            'url' => ['nullable', 'string'],
            'short_description' => ['string', 'required'],
            'description' => ['string', 'required'],
            'file' => ['nullable', 'file', 'mimes:png,jpg,jpeg'],
        ]);

        //return $validated;

        if($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/projects'), $filename);

            $validated['filename'] = $filename;
            $validated['filepath'] = 'uploads/projects/' .$filename;
        }

        $validated['is_visible'] = $request->has('is_visible');

        $newProject = Project::create($validated);

        return redirect()->route('projects-dashboard.index')
        ->with('success', "Proyecto {$newProject->name} creado exitosamente");
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();

        $projectTypes = ProjectType::orderBy('index')->get();

        return view('dashboards.projects.projects-dashboard-show', [
            'project' => $project,
            'projectTypes' => $projectTypes
        ]);
    }

    // public function edit($slug)
    // {
    //     $project = Project::where('slug', $slug)->first();

    //     $projectTypes = ProjectType::orderBy('index')->get();
    //     return view('dashboards.projects.projects-dashboard-edit', [
    //         'project' => $project,
    //         'projectTypes' => $projectTypes
    //     ]);
    // }

    public function update(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)->first(); 

        $validated = $request->validate([
            'project_type_id' => ['required', 'exists:project_types,id'],
            'name' => ['string', 'required', 'unique:projects,name,'.$project->id],
            'technologies' => ['string', 'required'],
            'url' => ['nullable', 'string'],
            'short_description' => ['string', 'required'],
            'description' => ['string', 'required'],
            'file' => ['nullable', 'file', 'mimes:png,jpg,jpeg'],
            //'remove_image' => ['nullable', 'boolean'],
        ]);

        // Eliminar imagen si se solicita
        if ($request->has('remove_image') && $project->filename) {
            if (file_exists(public_path($project->filepath))) {
                unlink(public_path($project->filepath));
            }
            $validated['filename'] = null;
            $validated['filepath'] = null;
        }

        // Manejar nueva imagen
        if($request->hasFile('file') && $request->file('file')->isValid()) {
            // Eliminar imagen anterior si existe
            if ($project->filename && file_exists(public_path($project->filepath))) {
                unlink(public_path($project->filepath));
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/projects'), $filename);

            $validated['filename'] = $filename;
            $validated['filepath'] = 'uploads/projects/' .$filename;
        }

        $validated['is_visible'] = $request->has('is_visible', $project->is_visible);

        $project->update($validated);

        return redirect()->route('projects-dashboard.index')
            ->with('success', "Proyecto actualizado exitosamente");
    }

    public function destroy($slug)
    {
        $project = Project::where('slug', $slug)->first();

        // Eliminar imagen si existe
        if ($project->filename && file_exists(public_path($project->filepath))) {
            unlink(public_path($project->filepath));
        }

        $project->delete();

        return redirect()->route('projects-dashboard.index')
            ->with('info', "Proyecto eliminado exitosamente");
    }
}
