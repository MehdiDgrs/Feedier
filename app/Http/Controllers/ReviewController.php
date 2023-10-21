<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        return Inertia::render('Reviews/Index',[]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->reviews()->create($validated);
 
        return redirect(route('reviews.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
