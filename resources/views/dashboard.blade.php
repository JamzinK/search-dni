@extends('layouts.main')

@section('title', 'Busqueda')
@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js" integrity="sha256-hMcztVuowqlSORATzoB3LRGsqxhAtCDfpsd1yVk7Okw=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!--Seccion de busqueda-->
    <section>
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:py-8 lg:px-6">
            <div class="max-w-screen-md mx-auto text-center mb-8 lg:mb-8">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Busqueda Personas</h2>
                <p class="mb-8 font-light text-gray-500 dark:text-gray-400 sm:text-xl">Ingrese el DNI</p>
                <form action="{{ route('personas.obtenerPersona') }}" id="formBusquedaPersonaId" method="post">
                    @csrf
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" name="dni"
                            class="block w-full p-4 pl-12 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-puerto-rico-500 focus:border-puerto-rico-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500"
                            placeholder="Ingrese el DNI de 8 digitos">
                        <button type="submit" id="btnBusquedaPersonaId" class="text-white absolute end-2.5 bottom-2.5 bg-puerto-rico-500 hover:bg-puerto-rico-800 focus:ring-4 focus:outline-none focus:ring-puerto-rico-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-puerto-rico-600 dark:hover:bg-puerto-rico-700 dark:focus:ring-puerto-rico-800">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full max-w-3xl mx-auto bg-white dark:bg-gray-800 border-gray-200 border dark:border-gray-700 shadow rounded-lg p-5">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Resultados de búsqueda</h2>
                <label for="name-person-id" class="block mb-2  font-medium text-gray-900 dark:text-white">Nombres</label>
                <div class="relative mb-4">
                    <input id="name-person-id" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-800 font-semibold text-lg rounded-lg focus:ring-puerto-rico-500 focus:border-puerto-rico-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500" placeholder="Nombres" value="" readonly>
                    <button data-copy-to-clipboard-target="name-person-id" data-tooltip-target="tooltip-name-person-id" class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                        <span id="default-icon-name-person-id">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <span id="success-icon-name-person-id" class="hidden inline-flex items-center">
                            <svg class="w-4 h-4 text-puerto-rico-500 dark:text-puerto-rico-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </span>
                    </button>
                    <div id="tooltip-name-person-id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        <span id="default-tooltip-message-name-person-id">Copiar</span>
                        <span id="success-tooltip-message-name-person-id" class="hidden">¡Copiado!</span>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <label for="ap-person-id" class="block mb-2  font-medium text-gray-900 dark:text-white">Apellido Paterno</label>
                <div class="relative mb-4">
                    <input id="ap-person-id" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-800 font-semibold text-lg rounded-lg focus:ring-puerto-rico-500 focus:border-puerto-rico-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500" placeholder="Apellido paterno" value="" readonly>
                    <button data-copy-to-clipboard-target="ap-person-id" data-tooltip-target="tooltip-ap-person-id" class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                        <span id="default-icon-ap-person-id">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <span id="success-icon-ap-person-id" class="hidden inline-flex items-center">
                            <svg class="w-4 h-4 text-puerto-rico-500 dark:text-puerto-rico-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </span>
                    </button>
                    <div id="tooltip-ap-person-id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        <span id="default-tooltip-message-ap-person-id">Copiar</span>
                        <span id="success-tooltip-message-ap-person-id" class="hidden">¡Copiado!</span>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
                <label for="am-person-id" class="block mb-2  font-medium text-gray-900 dark:text-white">Apellido Materno</label>
                <div class="relative mb-6">
                    <input id="am-person-id" type="text" class="col-span-6 bg-gray-50 border border-gray-300 text-gray-800 font-semibold text-lg rounded-lg focus:ring-puerto-rico-500 focus:border-puerto-rico-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-puerto-rico-500 dark:focus:border-puerto-rico-500" placeholder="Apellido materno" value="" readonly>
                    <button data-copy-to-clipboard-target="am-person-id" data-tooltip-target="tooltip-am-person-id" class="absolute end-2 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center">
                        <span id="default-icon-am-person-id">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                            </svg>
                        </span>
                        <span id="success-icon-am-person-id" class="hidden inline-flex items-center">
                            <svg class="w-4 h-4 text-puerto-rico-500 dark:text-puerto-rico-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                        </span>
                    </button>
                    <div id="tooltip-am-person-id" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        <span id="default-tooltip-message-am-person-id">Copiar</span>
                        <span id="success-tooltip-message-am-person-id" class="hidden">¡Copiado!</span>
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection
@push('scripts')
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" integrity="sha256-KIZHD6c6Nkk0tgsncHeNNwvNU1TX8YzPrYn01ltQwFg=" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            const formulario = $('#formBusquedaPersonaId');
            formulario.on('submit', (event) => {
                buscarPersona(event, formulario);
            })

        })
        const buscarPersona = async (event, formSave) => {
            event.preventDefault()
            const button = $('#btnBusquedaPersonaId');
            button.prop('disabled', true).addClass('cursor-not-allowed opacity-50');
            button.html(`<svg aria-hidden="true" role="status" class="inline w-4 h-4 me-1 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
            </svg>
            Cargando...`);
            const form = $(formSave);
            const urlForm = form.attr('action');
            const dataForm = form.serialize();
            $('#name-person-id').val('');
            $('#ap-person-id').val('');
            $('#am-person-id').val('');
            try {
                const response = await $.post(urlForm, dataForm);
                console.log("response:", response);
                const {
                    data,
                    status
                } = response;
                if (status === 'success') {
                    console.log("success");
                    console.log(data);
                    $('#name-person-id').val(data.nombres);
                    $('#ap-person-id').val(data.apellidoPaterno);
                    $('#am-person-id').val(data.apellidoMaterno);
                    button.prop('disabled', false).removeClass('cursor-not-allowed opacity-50');
                    button.html(`Buscar`);


                } else {
                    console.log('error');
                    button.prop('disabled', false).removeClass('cursor-not-allowed opacity-50');
                    button.html(`Buscar`);

                    Swal.fire({
                        title: "Error",
                        text: data,
                        icon: "warning",
                        showCancelButton: !0,
                        showConfirmButton: !1,
                        cancelButtonText: "Ok",
                        showCloseButton: !0,
                    }).then(() => {
                        console.log("object");

                    });
                }
            } catch (error) {
                console.info('Error:', error);
                button.prop('disabled', false).removeClass('cursor-not-allowed opacity-50');
                button.html(`Buscar`);


            }
        }
    </script>
@endpush
