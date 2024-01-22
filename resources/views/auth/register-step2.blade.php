<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register-step2.post') }}">
            @csrf

            <div class="mt-4">
                <x-jet-label for="depart_id" value="{{ __('ระบุแผนก:') }}" />
                <select name="depart_id" x-model="depart_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    @foreach($Department as $Department)
                <option value="{{$Department->id}}">{{ $Department->department_name}}</option>
                @endforeach
                </select>
            </div>

        
            <div class="mt-4">
                <x-jet-label for="pros_id" value="{{ __('ระบุตำแหน่ง:') }}" />
                <select name="pros_id" x-model="pros_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                @foreach($pros as $pros)
                <option value="{{$pros->id}}">{{ $pros -> pros_name}}</option>
                @endforeach
                </select>
            </div>


           <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Finish Registration') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
