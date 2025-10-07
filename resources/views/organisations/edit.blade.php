<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Organization: ') . $organisation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                            <p class="font-bold">Whoops! Something went wrong.</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('organisations.update', $organisation) }}">
                        @csrf
                        @method('PATCH') {{-- Use PATCH method for updates --}}

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Organization Name')" />
                            {{-- FIX: Use $organisation->name or old('name') to pre-populate --}}
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" 
                                :value="old('name', $organisation->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="industry" :value="__('Industry')" />
                            <x-text-input id="industry" class="block mt-1 w-full" type="text" name="industry" 
                                :value="old('industry', $organisation->industry)" />
                            <x-input-error :messages="$errors->get('industry')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            {{-- FIX: Use $organisation->description or old('description') to pre-populate --}}
                            <textarea id="description" name="description" rows="4" 
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">{{ old('description', $organisation->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label for="is_active" class="inline-flex items-center">
                                {{-- FIX: Check if the organization is active --}}
                                <input id="is_active" name="is_active" type="checkbox" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                    value="1" {{ old('is_active', $organisation->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Is Active') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-3">
                            <a href="{{ route('organisations.show', $organisation) }}" 
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Cancel') }}
                            </a>
                            
                            <x-primary-button>
                                {{ __('Update Organization') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>