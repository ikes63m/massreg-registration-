<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource with search functionality.
     */
    public function index(Request $request): View
    {
        // Start building the query
        $query = Organisation::orderBy('name'); 

        // 1. Get the search term from the request
        $search = $request->input('q');

        if ($search) {
            // 2. Apply the search filter if a query term exists
            // This groups the OR clauses to ensure they only apply if the search term is present
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('industry', 'like', '%' . $search . '%');
            });
        }

        // 3. Paginate the results (passing the search term back to the pagination links)
        // We use withQueryString() to ensure 'q' and 'page' parameters are maintained.
        $organisations = $query->paginate(20)->withQueryString();

        // Pass the organizations and the search term back to the view
        return view('organisations.index', compact('organisations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        Organisation::create($validated);

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisation $organisation): View
    {
        // Eager load related resources for the view
        $organisation->load(['contacts', 'addresses']);

        return view('organisations.show', compact('organisation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisation $organisation): View
    {
        return view('organisations.edit', compact('organisation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisation $organisation): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ]);

        $organisation->update($validated);

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisation $organisation): RedirectResponse
    {
        $organisation->delete();

        return redirect()->route('organisations.index')
            ->with('success', 'Organisation deleted successfully.');
    }
}