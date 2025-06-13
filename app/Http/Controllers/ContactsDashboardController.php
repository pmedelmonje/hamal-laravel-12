<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsDashboardController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::when(
            $request->is_answered !== null,
            function ($query) use ($request) {
                return $query->where('is_answered', $request->is_answered);
            }
        )
            ->orderBy('created_at')
            ->paginate(30);

        return view(
            'dashboards.contacts.contacts-index',
            [
                'contacts' => $contacts,
                'selectedIsAnswered' => $request->is_answered
            ]
        );
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return view(
            'dashboards.contacts.contacts-show',
            compact('contact')
        );
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update([
            'is_answered' => $request->has('is_answered')
        ]);

        return redirect()->route('contacts-dashboard.index')
            ->with('success', 'Estado actualizado correctamente');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->route('contacts-dashboard.index')
            ->with('info', 'Contacto eliminado');
    }
}
