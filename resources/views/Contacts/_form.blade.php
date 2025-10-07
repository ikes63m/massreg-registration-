<div class="space-y-6">
    <div>
        <x-input-label for="value" :value="__('Contact Value')" />
        <x-text-input id="value" name="value" type="text" class="mt-1 block w-full"
                      :value="old('value', $contact->value ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('value')" />
    </div>

    <div>
        <x-input-label for="contact_type_id" :value="__('Contact Type')" />
        <select id="contact_type_id" name="contact_type_id" required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
            <option value="">Select a type</option>
            @foreach ($contactTypes as $type)
                <option value="{{ $type->id }}"
                    {{ old('contact_type_id', $contact->contact_type_id ?? '') == $type->id ? 'selected' : '' }}>
                    {{ $type->type }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('contact_type_id')" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Description (Optional)')" />
        <textarea id="description" name="description" rows="3"
                  class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('description', $contact->description ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="flex items-center">
        <input id="is_active" name="is_active" type="checkbox"
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
               value="1"
               @checked(old('is_active', $contact->is_active ?? true))>
        <x-input-label for="is_active" :value="__('Is Active')" class="ml-2" />
        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
    </div>
</div>