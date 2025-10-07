@php
    // Define the current route name to determine which tab is active
    $current = $current ?? '';
    $baseRoute = 'organisations.show';
    if (request()->routeIs('organisations.contacts.*')) {
        $current = 'contacts';
    } elseif (request()->routeIs('organisations.addresses.*')) {
        $current = 'addresses';
    } elseif (request()->routeIs('organisations.show') || request()->routeIs('organisations.edit')) {
         $current = 'details';
    }
@endphp

<div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">

        {{-- Details Tab --}}
        <a href="{{ route('organisations.show', $organisation) }}"
           class="{{ $current === 'details' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} 
                   whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
            Organization Details
        </a>

        {{-- Contacts Tab --}}
        <a href="{{ route('organisations.contacts.index', $organisation) }}"
           class="{{ $current === 'contacts' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} 
                   whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
            Contacts ({{ $organisation->contacts->count() }})
        </a>

        {{-- Addresses Tab --}}
        <a href="{{ route('organisations.addresses.index', $organisation) }}"
           class="{{ $current === 'addresses' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} 
                   whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition duration-150 ease-in-out">
            Addresses ({{ $organisation->addresses->count() }})
        </a>

    </nav>
</div>