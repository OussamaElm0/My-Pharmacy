<x-guest-layout>
    <form method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Category Name -->
        <div>
            <x-input-label for="name" :value="__('Category Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add category') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
