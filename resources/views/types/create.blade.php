<x-guest-layout>
    <form method="post" action="{{ route('types.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- type Name -->
        <div>
            <x-input-label for="name" :value="__('type Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add type') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
