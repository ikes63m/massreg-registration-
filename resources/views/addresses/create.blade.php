<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Address for: ') . $organisation->name }}
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

                    <form method="POST" action="{{ route('organisations.addresses.store', $organisation) }}">
                        @csrf

                        <input type="hidden" name="organisation_id" value="{{ $organisation->id }}">

                        <div class="mb-4">
                            <x-input-label for="building_name" :value="__('Building Name')" />
                            <x-text-input id="building_name" class="block mt-1 w-full" type="text" name="building_name" :value="old('building_name')" required autofocus />
                            <x-input-error :messages="$errors->get('building_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="street_name" :value="__('Street Name')" />
                            <x-text-input id="street_name" class="block mt-1 w-full" type="text" name="street_name" :value="old('street_name')" required />
                            <x-input-error :messages="$errors->get('street_name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="country" :value="__('Country')" />
                            <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div class="mb-6">
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" name="is_active" type="checkbox" 
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                                    value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">{{ __('Is Active') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4 space-x-3">
                            <a href="{{ route('organisations.addresses.index', $organisation) }}" 
                               class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Cancel') }}
                            </a>
                            
                            <x-primary-button>
                                {{ __('Save Address') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>