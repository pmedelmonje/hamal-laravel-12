<?php

namespace App\Http\Controllers;
use App\Models\SkillGroup;
use App\Models\Skill;

use Illuminate\Http\Request;

class SkillGroupsDashboardController extends Controller
{
    public function index()
    {
        $skillGroups = SkillGroup::with('skills')
        ->orderBy('index')
        ->paginate(10);

        return view('dashboards.skill-groups.skill-groups-index',
        compact('skillGroups'));
    }

    public function create()
    {
        return view('dashboards.skill-groups.skill-groups-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:skill_groups,name,skill_groups:id'],
            'index' => ['integer', 'required']
        ]);

        $newGroup = SkillGroup::create($validated);
        
        return redirect()->route('skill-groups-dashboard.index')
        ->with('success', 'Grupo de habilidades creado exitosamente.');
    }

    public function show($id)
    {
        $skillGroup = SkillGroup::findOrFail($id);

        return view('dashboards.skill-groups.skill-groups-show',
        compact('skillGroup'));
    }

    public function update(Request $request, $id)
    {
        $skillGroup = SkillGroup::findOrFail($id);

        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:skill_groups,name,'.$skillGroup->id],
            'index' => ['integer', 'required']
        ]);

        if($request->filled('name'))
        {
            $skillGroup->name = $validated['name'];
        }

        if($request->filled('index'))
        {
            $skillGroup->index = $validated['index'];
        }

        $skillGroup->save();

        return redirect()->route('skill-groups-dashboard.index')
        ->with('success', 'Grupo de habilidades actualizado.');
    }
}
