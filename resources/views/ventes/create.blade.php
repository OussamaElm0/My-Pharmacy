<x-guest-layout>
    <form method="post" action="{{ route('ventes.store') }}" >
        @csrf

        <!-- Porduct code -->
        <div>
            <x-input-label for="id" :value="__('Product Code')" />
            <x-text-input id="id" class="block mt-1 w-full" type="text" name="id" :value="old('id')" required autofocus autocomplete="id" />
            <x-input-error :messages="$errors->get('id')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add a sale') }}
            </x-primary-button>
        </div>
    </form>
    @if(session('error'))
        <div class="alert alert-alert mt-1" role="alert">
            {{ session('error') }}
        </div>
    @endif
</x-guest-layout>
