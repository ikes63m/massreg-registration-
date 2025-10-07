<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

// Added for the Export functionality
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;


class ContactController extends Controller
{
    /**
     * Display a listing of the contacts for a specific organisation.
     */
    public function index(Organisation $organisation): View
    {
        $contacts = $organisation->contacts()
            ->orderBy('last_name')
            ->paginate(15);

        return view('contacts.index', compact('organisation', 'contacts'));
    }

    /**
     * Show the form for creating a new contact for the organisation.
     */
    public function create(Organisation $organisation): View
    {
        $contact = new Contact();
        return view('contacts.create', compact('organisation', 'contact'));
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request, Organisation $organisation): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable', 
                'email', 
                'max:255',
                Rule::unique('contacts', 'email')->ignore(null, 'id')
            ],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $organisation->contacts()->create($data);

        return redirect()->route('organisations.contacts.index', $organisation)
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified contact.
     */
    public function show(Organisation $organisation, Contact $contact): View
    {
        $contact->load('organisation');
        return view('contacts.show', compact('organisation', 'contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Organisation $organisation, Contact $contact): View
    {
        return view('contacts.edit', compact('organisation', 'contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, Organisation $organisation, Contact $contact): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'email' => [
                'nullable', 
                'email', 
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contact->id)
            ],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $contact->update($data);

        return redirect()->route('organisations.contacts.index', $organisation)
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(Organisation $organisation, Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('organisations.contacts.index', $organisation)
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Export the list of contacts for the organisation to an Excel file.
     */
    public function export(Organisation $organisation)
    {
        $filename = 'contacts-' . Str::slug($organisation->name) . '-' . now()->format('Ymd_His') . '.xlsx';
        
        return Excel::download(new ContactsExport($organisation->id), $filename);
    }
}