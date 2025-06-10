<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return view('contact.contact-index', [
            'title' => 'Contacto | Pedro Medel M.',
            'hero_title' => 'Contacto',
            'hero_subtitle' => 'Texto de prueba',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        //return $data;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ],
        [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'message.required' => 'El mensaje es requerido',
            'message.min' => 'El texto introducido es muy corto'
        ]);

        $new_contact = Contact::create($data);

        return redirect()->route('contact.index')
        ->with('status', 'Formulario ingresado correctamente');
    }
}
