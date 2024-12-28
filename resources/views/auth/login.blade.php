@extends('layouts.auth')
@section('title', 'Iniciar Sesión')
@section('content')
    <!-- Session Status -->
    <section class="">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 ">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-56  mr-2" src="{{ asset('assets/img/logolight.png') }}" alt="logo">
                {{-- <img class="w-56  mr-2" src="{{ asset('assets/img/logo2.png') }}" alt="logo"> --}}

            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Ingresa a tu cuenta
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus autocomplete="username"
                                class="@error('email') bg-red-50 text-red-900 focus:ring-red-600 focus:border-red-600 @enderror bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-puerto-rico-600 focus:border-puerto-rico-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500 " placeholder="name@aula20.edu.pe" required="">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" autocomplete="current-password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-puerto-rico-600 focus:border-puerto-rico-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500" required="">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember_me" name="remember" aria-describedby="remember_me" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-puerto-rico-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-puerto-rico-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember_me" class="text-gray-500 dark:text-gray-300">Recuérdame</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium text-puerto-rico-600 hover:underline dark:text-puerto-rico-500">Olvidaste tu contraseña?</a>
                        </div>
                        <button type="submit" onclick="cargarLogin(this)"
                            class="w-full text-white bg-puerto-rico-600 hover:bg-puerto-rico-700 focus:ring-4 focus:outline-none focus:ring-puerto-rico-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-puerto-rico-600 dark:hover:bg-puerto-rico-700 dark:focus:ring-puerto-rico-800">
                            Iniciar Sesión
                        </button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Aún no tienes una cuenta? <a href="#" class="font-medium text-puerto-rico-600 hover:underline dark:text-puerto-rico-500">Regístrate</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')

    <script>
        const cargarLogin = (element) => {
            element.form.submit();
            element.disabled = true;
            element.classList.add('cursor-not-allowed');
            element.classList.add('opacity-50');
            element.innerHTML = `
                <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-1 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            Cargando...
        `;
        }
    </script>

@endpush
