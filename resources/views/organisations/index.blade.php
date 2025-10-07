<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organizations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- --- NEW SEARCH FORM BLOCK & CREATE BUTTON --- --}}
                    <div class="mb-6 flex justify-between items-center">
                        <form method="GET" action="{{ route('organisations.index') }}" class="flex space-x-2 w-full max-w-md">
                            <x-text-input 
                                type="text" 
                                name="q" 
                                placeholder="Search by name or industry..." 
                                value="{{ $search ?? '' }}" 
                                class="w-full"
                            />
                            <x-primary-button type="submit">
                                {{ __('Search') }}
                            </x-primary-button>
                            @if($search)
                                <a href="{{ route('organisations.index') }}" class="text-gray-500 hover:text-gray-700 self-center text-sm">
                                    Clear
                                </a>
                            @endif
                        </form>
                        
                        <a href="{{ route('organisations.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Create Organization') }}
                        </a>
                    </div>
                    {{-- --- END NEW SEARCH FORM BLOCK --- --}}

                    @if (session('success'))
                        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        {{ $organisations->links() }}
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        @if ($organisations->isEmpty())
                            <p class="p-4 text-center text-gray-500">
                                @if($search)
                                    No organizations found matching your search term "{{ $search }}".
                                @else
                                    No organizations have been created yet.
                                @endif
                            </p>
                        @else
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Industry
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($organisations as $organisation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <a href="{{ route('organisations.show', $organisation) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ $organisation->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $organisation->industry }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $organisation->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $organisation->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                                <a href="{{ route('organisations.edit', $organisation) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                
                                                <form action="{{ route('organisations.destroy', $organisation) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure? This will delete all associated contacts and addresses.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <div class="mt-6">
                        {{ $organisations->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>