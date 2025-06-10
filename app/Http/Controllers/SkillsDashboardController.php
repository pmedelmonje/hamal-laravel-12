<?php

namespace App\Http\Controllers;

use App\Models\SkillGroup;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsDashboardController extends Controller
{
    public function index(Request $request)
    {
        $skillGroups = SkillGroup::orderBy('index')->get();

        $skills = Skill::when($request->group, function ($query, $group){
            return $query->where('skill_group_id', $group);
        })
        ->with('skillGroup')
        ->paginate(20);

        return view('dashboards.skills.skills-index',
        [
           'skillGroups' => $skillGroups,
           'skills' => $skills,
           'selectedGroup' => $request->group 
        ]);
    }

    public function create()
    {   
        $skillGroups = SkillGroup::all();
        return view('dashboards.skills.skills-create',
        compact('skillGroups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'skill_group_id' => ['required', 'exists:skill_groups,id'],
            'name' => ['string', 'required', 'unique:skills,name,skills:id'],
            'index' => ['integer', 'required'],
            'skill_level' => ['required', 'string'],
        ]);

        //return $validated;

        $newSkill = Skill::create($validated);

        return redirect()->route('skills-dashboard.index')
        ->with('success', "Habilidad {$newSkill->name} registrada exitosamente");
    }

    public function show(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $skillGroups = SkillGroup::orderBy('index')->get();

        return view('dashboards.skills.skills-show',
        compact(['skill', 'skillGroups']));
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id); 

        $validated = $request->validate([
            'skill_type_id' => ['required', 'exists:skill_types,id'],
            'name' => ['string', 'required', 'unique:skills,name,'.$skill->id],
            'index' => ['integer', 'required'],
            'skill_level' => ['required', 'string'],
        ]);

        $skill->update($validated);

        return redirect()->route('skills-dashboard.show', $skill->id)
            ->with('success', "Proyecto actualizado exitosamente");
    }

    public function destroy(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $skill->delete();

        return redirect()->route('skills-dashboard.index')
        ->with('info', "Habilidad eliminada.");
    }

}
