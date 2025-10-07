{{-- The $industries variable is passed from the Controller --}}

{{-- Organization Name --}}
<div class="mb-4">
    <label for="name" class="block text-gray-700 font-semibold mb-2">Organization Name <span class="text-red-500">*</span></label>
    <input type="text" id="name" name="name" value="{{ old('name', $organisation->name) }}"
           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-primary @error('name') border-red-500 @enderror">
    @error('name')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Industry Dropdown --}}
<div class="mb-4">
    <label for="industry" class="block text-gray-700 font-semibold mb-2">Industry <span class="text-red-500">*</span></label>
    <select id="industry" name="industry"
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-primary @error('industry') border-red-500 @enderror">
        <option value="">Select Industry</option>
        @foreach($industries as $type)
            <option value="{{ $type }}" @selected(old('industry', $organisation->industry) == $type)>
                {{ $type }}
            </option>
        @endforeach
    </select>
    @error('industry')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Description --}}
<div class="mb-4">
    <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
    <textarea id="description" name="description" rows="4"
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-primary @error('description') border-red-500 @enderror">{{ old('description', $organisation->description) }}</textarea>
    @error('description')
        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- Is Active Status --}}
<div class="mb-4 flex items-center">
    <input type="checkbox" id="is_active" name="is_active" value="1" 
           {{ old('is_active', $organisation->is_active ?? false) ? 'checked' : '' }}
           class="rounded text-teal-primary border-gray-300 shadow-sm focus:border-teal-primary focus:ring focus:ring-teal-primary focus:ring-opacity-50">
    <label for="is_active" class="ml-2 text-gray-700 font-semibold">Active</label>
</div>