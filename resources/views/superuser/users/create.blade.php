<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- CNI -->
        <div class="mt-4">
            <x-input-label for="cni" :value="__('CNI')" />
            <x-text-input id="cni" class="block mt-1 w-full" type="text" name="cni" :value="old('cni')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('cni')" class="mt-2" />
        </div>

        <!-- Pharmacy -->
        <div class="mt-4">
            <label for="pharmacy_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select pharmacy</label>
            <select id="pharmacy_id" name="pharmacy_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a pharmacy</option>
                @foreach ($pharmacies as $pharmacy)
                    <option value="{{ $pharmacy->id }}">{{ $pharmacy->INPE }}</option>
                @endforeach
            </select>
        </div>

        <!-- Role -->
        <div class="mt-4">
            <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Role</label>
            <select id="role_id" name="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Choose a role</option>
                @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Create User') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
