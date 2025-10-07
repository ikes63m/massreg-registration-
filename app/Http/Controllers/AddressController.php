<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    /**
     * Display a listing of the resources (all addresses for a specific organisation).
     *
     * Route: organisations/{organisation}/addresses
     */
    public function index(Organisation $organisation): View
    {
        $addresses = $organisation->addresses()->orderBy('city')->get();

        return view('addresses.index', compact('organisation', 'addresses'));
    }

    // You will need to add:
    // public function create(Organisation $organisation): View { ... }
    // public function store(Request $request, Organisation $organisation): RedirectResponse { ... }
    // public function show(Organisation $organisation, Address $address): View { ... }
    // public function edit(Organisation $organisation, Address $address): View { ... }
    // public function update(Request $request, Organisation $organisation, Address $address): RedirectResponse { ... }
    // public function destroy(Organisation $organisation, Address $address): RedirectResponse { ... }
}