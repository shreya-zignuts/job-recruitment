@props(['id' => 'category', 'label' => 'Category', 'categories' => []])

<div class="mt-4">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $id }}" {{ $attributes->merge(['class' => 'block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
        @foreach ($roles as $role)
            <option value="{{ $categories }}" @if(old($id) == $categories || isset($selected) && $selected == $categories) selected @endif>{{ ucfirst($category) }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($id)" class="mt-2" />
</div>