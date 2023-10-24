<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;

class FeedbackController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::allows('read-feedbacks')) {
            abort(403);
        }
        // Return every feedbacks as a JSON. 
        return Feedback::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Feedback/Form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate form inputs
            $validated = $request->validate([
                'content' => 'required|string|max:1000',
                'source' => 'required|string|max:255',
            ]);
            Feedback::create($validated);
            // Redirect with success message 
            return redirect(route('feedbacks.create'))
                ->with('success', 'Feedback stored with success.');
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return redirect(route('feedbacks.create'))
                ->with('error', 'error, try again please');
        }
    }
}
