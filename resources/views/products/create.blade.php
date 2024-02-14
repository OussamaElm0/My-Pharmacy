<x-guest-layout>
    <form method="post" action="{{ route('products.store') }}">
        @csrf

        <!-- Product Name -->
        <div>
            <x-input-label for="name" :value="__('Product Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Type -->
        <div class="mt-4">
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Type</label>
            <select id="type" name="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div class="mt-4">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
            <select id="category" name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" min="0" name="price" :value="old('price')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Quantity -->
        <div>
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input id="quantity" class="block mt-1 w-full" type="number" step="1" min="0" name="quantity" :value="old('quantity')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>

        <!-- Importation Date -->
        <div class="mt-4">
            <x-input-label for="importation_date" :value="__('Importation Date')" />

            <x-text-input id="importation_date" class="block mt-1 w-full"
                          type="date"
                          :value="$today"
                          name="importation_date" required autocomplete="new-date" />
            <x-input-error :messages="$errors->get('importation_date')" class="mt-2" />
        </div>

        <!-- Expiration Date -->
        <div class="mt-4">
            <x-input-label for="expiration_date" :value="__('Expiration Date')" />

            <x-text-input id="expiration_date" class="block mt-1 w-full"
                          type="date"
                          name="expiration_date" required autocomplete="new-date" />
            <x-input-error :messages="$errors->get('expiration_date')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Add Product') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
