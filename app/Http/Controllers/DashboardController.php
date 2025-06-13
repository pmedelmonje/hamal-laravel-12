<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::all();
        $recentContacts = Contact::orderBy('created_at', 'desc')
        ->take(5)->get();
        $answeredContacts = $contacts->where('is_answered', true);
        $unansweredContacts = $contacts->where('is_answered', false);
        $mostVisitedPosts = BlogPost::orderBy('visits_count')
        ->take(5)->get();

        $totalBlogVisits = BlogPost::where('published', true)
        ->sum('visits_count');

        return view('dashboard',
            [
                'answeredContacts' => $answeredContacts,
                'unansweredContacts' => $unansweredContacts,
                'totalBlogVisits' => $totalBlogVisits,
                'recentContacts' => $recentContacts,
                'mostVisitedPosts' => $mostVisitedPosts
            ]);
    }
}
