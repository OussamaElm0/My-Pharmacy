<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   @if(session('success'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __(session('success')) }}
                    </div>
                </div>
            </div>
        </div>
   @endif

   @section('content')
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Welcome, Mr. {{ Auth::user()->name }}! 🌟
                    </div>
                </div>
            </div>
        </div>

        @if(Auth::user()->role->name == "Superuser")
            <x-superuser-dashboard
                :users="$users"
                :pharmacies="$pharmacies"
                :types="$types"
                :products="$products"
                :categories="$categories"
            />
        @endif

    @endsection
</x-app-layout>
