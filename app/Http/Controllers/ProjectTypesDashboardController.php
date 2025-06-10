<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use Illuminate\Http\Request;

class ProjectTypesDashboardController extends Controller
{
    public function index(Request $request)
    {
        $projectTypes = ProjectType::orderBy('index')
        ->orderBy('name')
        ->paginate(20);

        return view('dashboards.project-types.project-types-index', compact('projectTypes'));
    }

    public function create(Request $request)
    {
        return view('dashboards.project-types.project-types-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:project_types,name,proyect_types:id'],
            'index' => ['integer', 'required']
        ]);

        $newProjectType = ProjectType::create($validated);
        
        return redirect()->route('project-types-dashboard.index')
        ->with('success', 'Tipo de registro creado exitosamente.');
    }

    public function show(Request $request, $slug)
    {
        $projectType = ProjectType::where('slug', $slug)->first();

        if(empty($projectType))
        {
            abort(404);
        }

        return view('dashboards.project-types.project-types-show',
        compact('projectType'));
    }

    public function update(Request $request, $slug)
    {
        $projectType = ProjectType::where('slug', $slug)->first();

        if(empty($projectType))
        {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:project_types,name,'.$projectType->id],
            'index' => ['integer', 'required']
        ]);

        if($request->filled('name'))
        {
            $projectType->name = $validated['name'];
        }

        if($request->filled('index'))
        {
            $projectType->index = $validated['index'];
        }

        $projectType->save();

        return redirect()->route('project-types-dashboard.index')
        ->with('success', 'Tipo de registro actualizado.');
    }

    public function destroy(Request $request, $slug)
    {
        $projectType = ProjectType::where('slug', $slug)->first();

        if(empty($projectType))
        {
            abort(404);
        }

        $projectType->delete();

        return redirect()->route('project-types-dashboard.index')->with('info', 'Tipo de registro eliminado');
    }
}
