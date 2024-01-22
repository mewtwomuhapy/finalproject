<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{url('/assign/update2/{id}') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="tech_name" value="{{ __('ช่าง:') }}" />
                <select name="tech_name" x-model="tech_name" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                @foreach($user as $user)
                <option value="{{$user->name}}">{{ $user -> name}}</option>
                @endforeach
                </select>
            </div>


            <form method="POST" action="{{url('/assign/update/{id}') }}">
            @csrf
        <div class="form-group">
        <input type="hidden" class="form-control" name="id" value="{{$id}}"> 
        </div>
           <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                <input type="submit" value="อัพเดด" class='btn btn-primary'>
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<div class="mt-4">