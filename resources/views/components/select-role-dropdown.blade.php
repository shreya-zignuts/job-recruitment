@props(['id' => 'role', 'label' => 'Role', 'roles' => []])

<div class="mt-2">
    <select id="{{ $id }}" name="{{ $id }}" {{ $attributes->merge(['class' => 'block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}>
        @foreach ($roles as $role)
            <option value="{{ $role }}" @if(old($id) == $role || isset($selected) && $selected == $role) selected @endif>
                @if ($role === 'job_seeker')
                    Job Seeker
                @elseif ($role === 'employer')
                    Employer
                @endif
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($id)" class="mt-2" />
</div>