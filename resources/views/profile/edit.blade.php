@extends('layouts.main')
@section('content')
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid px-3">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-white align-middle">
                        {{ __('Perfil') }}
                    </h2>
                    <a type="button" href="{{ route('dashboard') }}"
                    class="text-gray-700 bg-white border border-gray-200  hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-puerto-rico-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:border-gray-500 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        <svg class="rotate-180 w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white  dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
