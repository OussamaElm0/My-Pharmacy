<x-guest-layout>
    <form method="post" action="{{ route('pharmacies.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Phamracy Name -->
        <div>
            <x-input-label for="inpe" :value="__('Pharmacy INPE')" />
            <x-text-input id="inpe" class="block mt-1 w-full" type="text" name="inpe" :value="old('inpe')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('inpe')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add pharmacy') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
