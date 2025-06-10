<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\SkillGroup;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $skill_groups = SkillGroup::all();
        $recent_projects = Project::orderBy('id', 'asc')->take(3)->get();
        //$recent_projects = Project::all();
        return view('home.index', [
            'title' => 'Inicio | Pedro Medel M.',
            'hero_title' => 'Pedro Medel M.',
            'hero_subtitle' => 'Mi sitio web personal',
            'skill_groups' => $skill_groups,
            'recent_projects' => $recent_projects
        ]);
    }

    // Rutas para la sección de contacto

    public function contact(Request $request)
    {
        return view('home.contact');
    }

}
