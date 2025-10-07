<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organization Details: ') . $organisation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Primary Information</h3>
                        <p><strong>Industry:</strong> {{ $organisation->industry }}</p>
                        <p><strong>Status:</strong>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($organisation->is_active) 
                                    bg-green-100 text-green-800
                                @else 
                                    bg-red-100 text-red-800
                                @endif">
                                {{ $organisation->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                        <p class="mt-4"><strong>Description:</strong></p>
                        <p class="text-gray-600">{{ $organisation->description }}</p>
                    </div>

                    <div class="flex space-x-4 mb-8 border-b pb-4">
                        <a href="{{ route('organisations.edit', $organisation) }}"
                           class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            {{ __('Edit Organization') }}
                        </a>
                        <form action="{{ route('organisations.destroy', $organisation) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this entire organization?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                {{ __('Delete Organization') }}
                            </button>
                        </form>
                    </div>

                    <div class="flex space-x-6 border-b border-gray-200 mb-6">
                        <a href="{{ route('organisations.contacts.index', $organisation) }}"
                           class="py-2 text-sm font-medium 
                               @if (request()->routeIs('organisations.contacts.index')) 
                                   text-indigo-600 border-b-2 border-indigo-600 
                               @else 
                                   text-gray-500 hover:text-gray-700 
                               @endif">
                            Contacts
                        </a>

                        <a href="{{ route('organisations.addresses.index', $organisation) }}"
                           class="py-2 text-sm font-medium 
                               @if (request()->routeIs('organisations.addresses.index')) 
                                   text-indigo-600 border-b-2 border-indigo-600 
                               @else 
                                   text-gray-500 hover:text-gray-700 
                               @endif">
                            Addresses
                        </a>
                    </div>
                    
                    <p class="text-gray-500">
                        Use the tabs above to manage the Contacts and Addresses for this organization.
                    </p>

                    <div class="mt-6">
                        <a href="{{ route('organisations.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                            &larr; Back to Organizations List
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>