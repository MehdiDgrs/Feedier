<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Inertia\Inertia;
use Inertia\Response;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
                ->with('success', 'Votre feedback a été enregistré avec succès.');
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return redirect(route('feedbacks.create'))
                ->with('error', 'error, try again please');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
