async function waitForModalInstanceByKey(modalKey) {
    return new Promise((resolve, reject) => {
        const checkInstance = () => {
            const modalInstances = FlowbiteInstances.getInstances('Modal');

            // Verificar si la instancia específica está disponible
            if (modalInstances && modalInstances[modalKey]) {
                resolve(modalInstances[modalKey]); // Devolver solo la instancia deseada
            } else {
                requestAnimationFrame(checkInstance); // Seguir chequeando en el próximo frame
            }
        };
        checkInstance();
    });
}
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    showCloseButton: true,
    timer: 3000,
    timerProgressBar: true,
    width: "27em",
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});
$(document).ready(function() {
    const formulario = $('#formBusquedaPersonaId');
    formulario.on('submit', (event) => {
        buscarPersona(event, formulario);
    })
    initTableUsers();
    eventAgregarUser();
    eventActualizarUser();
    checkPassword();
})
const checkPassword = () => {
    const check = document.getElementById("checkPasswordId");
    const passElement = $("#passwordEditId");
    const passRepElement = $("#passwordRepEditId");
    if (check.checked) {
        passElement.prop("disabled", false).removeClass("cursor-not-allowed bg-gray-200").addClass("bg-gray-50");
        passRepElement.prop("disabled", false).removeClass("cursor-not-allowed bg-gray-200").addClass("bg-gray-50");
    } else {
        passElement.prop("disabled", true).removeClass("bg-gray-50").addClass("cursor-not-allowed bg-gray-200 ");
        passRepElement.prop("disabled", true).removeClass("bg-gray-50").addClass("cursor-not-allowed bg-gray-200 ");
    }
}


const initTableUsers = () => {
    const form = $('#formGetAllUsersId');
    const urlForm = form.attr('action');
    $('#tableUsersId').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json",
        },
        "paging": true,
        "pageLength": 10,
        "ordering": true,
        "info": true,
        "responsive": true,
        "ajax": urlForm,
        "columns": [{
                data: 'row_number',
                render: function(data) {
                    return data;
                }
            },
            {
                data: 'email',
            },
            {
                data: 'name',
            },
            {
                data: 'paternal_surname',
            },
            {
                data: 'maternal_surname',
            },
            {
                data: 'role',
                render: (data) => {
                    if (data == 'admin') {
                        return `
                        <span class=" bg-amber-500 text-white text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            Admin
                        </span>
                        `;
                    } else {
                        return `<span class="bg-slate-200 text-black text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                            User
                        </span>`;
                    }
                }
            },
            {
                data: 'status',
                render: (data) => {
                    if (data == 1) {
                        return `
                         <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                            Activo
                        </span>
                        `
                    } else {
                        return `<span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                            Inactivo
                        </span>`;

                    }
                }
            },

            {
                data: 'created_at',
            },
            {
                data: 'id',
                render: function(data, type, row, meta) {
                    return `
                     <button type="button" onclick="abrirModalEditarUser(${data})" class="py-1 px-2 font-bold bg-gray-200 rounded-lg border-gray-200 text-blue-500 shadow-sm align-middle hover:bg-blue-600 hover:text-white focus:ring-offset-white focus:ring-blue-500 dark:bg-gray-600  dark:border-gray-600  dark:hover:bg-blue-500 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 align-middle " viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844l2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565l6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/></svg>
                    </button>
                    <button type="button" onclick="eliminarUser(${data})" class="py-1 px-2 font-bold bg-gray-200 rounded-lg border-gray-200 text-red-500 shadow-sm align-middle hover:bg-red-500 hover:text-white focus:ring-offset-white focus:ring-red-500 dark:bg-gray-600  dark:border-gray-600  dark:hover:bg-red-500 dark:focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg"  width="1em" height="1em" viewBox="0 0 24 24"><g fill="none"><path fill="currentColor" d="M8 21h8a2 2 0 0 0 2-2V7H6v12a2 2 0 0 0 2 2" opacity="0.16"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 11v6m-4-6v6M6 7v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7M4 7h16M7 7l2-4h6l2 4"/></g></svg>
                    </button>
                    `;
                }
            },

        ],
    });
}
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
        const {
            data,
            status
        } = response;
        if (status === 'success') {
            $('#name-person-id').val(data.nombres);
            $('#ap-person-id').val(data.apellidoPaterno);
            $('#am-person-id').val(data.apellidoMaterno);
            button.prop('disabled', false).removeClass('cursor-not-allowed opacity-50');
            button.html(`Buscar`);


        } else {
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
                console.info("object");

            });
        }
    } catch (error) {
        console.info('Error:', error);
        button.prop('disabled', false).removeClass('cursor-not-allowed opacity-50');
        button.html(`Buscar`);


    }
}

const clearFormNew = (form, arraySelectsIds = []) => {
    form.trigger("reset");
    arraySelectsIds.forEach(row => {
        $("#" + row).val("").trigger("change");
    });
}

const eventAgregarUser = () => {
    const formSave = $("#formCreateUserId");
    formSave.off('submit').on('submit', (e) => agregarUser(e, formSave));
}

const agregarUser = async (e, formSave) => {
    const modal = await waitForModalInstanceByKey('modalAgregarUserId');
    const urlForm = formSave.attr('action');
    const dataForm = formSave.serialize();
    const overlay = $("#overlayAgregarUserId");
    e.preventDefault();
    overlay.show();
    $.ajax({
        type: 'POST',
        url: urlForm,
        data: dataForm,
    }).then((response) => {
        if (response.status === 'ok') {
            setTimeout(function() {
                $('#tableUsersId').DataTable().ajax.reload(null, false);
                clearFormNew(formSave);
                overlay.hide();
                modal.hide();
                Toast.fire({
                    icon: "success",
                    title: `<span class="fs-12 fw-bold ">Guardado con éxito</span>`,
                    html: `<span class="fs-11  ">El registro ha sido agregado</span>`,
                });
            }, 300);

        } else {
            Swal.fire({
                title: response.titulo,
                text: response.message,
                icon: "warning",
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonText: "Ok",
                showCloseButton: !0,
            }).then(() => {
                overlay.hide();
            });
        }
    }).catch((reason) => {
        Swal.fire({
            title: 'Error',
            text: reason,
            icon: "error",
            confirmButtonText: "Ok",
            showCloseButton: !0,
        }).then(() => {
            overlay.hide();
        });
    });
};
const obtenerDatosUser = async (id) => {
    $("#userEditId").val(id);
    const formGet = $('#formGetUserId');
    const urlGet = $('#formGetUserId').attr('action');
    const urlId = urlGet.slice(0, -1) + id;
    await $.get(urlId).then((user) => {
        $("#emailEditId").val(user.email);
        $("#nameEditId").val(user.name);
        $("#paternalSurnameEditId").val(user.paternal_surname);
        $("#maternalSurnameEditId").val(user.maternal_surname);
        $("#roleEditId").val(user.role);
        $('#statusEditId').prop('checked', user.status);
    }).catch((err) => {
        console.error(err);
    });
}
const abrirModalEditarUser = async (id) => {
    await obtenerDatosUser(id);
    const modalEditar = $('#btnEditarUserId');
    modalEditar.trigger('click');
}

const eventActualizarUser = () => {
    const form = $("#formUpdateUserId");
    form.off('submit').on('submit', (e) => actualizarUser(e, form));
}
const actualizarUser = async (e, formSave) => {
    const urlForm = formSave.attr('action');
    const modal = await waitForModalInstanceByKey('modalEditarUserId');
    const dataForm = formSave.serialize();
    const overlay = $("#overlayEditarUserId");
    e.preventDefault();
    overlay.show();
    $.ajax({
        type: 'POST',
        url: urlForm,
        data: dataForm,
    }).then((response) => {
        if (response.status === 'ok') {
            setTimeout(function() {
                $('#tableUsersId').DataTable().ajax.reload(null, false);
                overlay.hide();
                modal.hide();
                Toast.fire({
                    icon: "success",
                    title: `<span class="fs-15 fw-bold ">Actualizado con éxito</span>`,
                    html: `<span class="fs-13">El registro ha sido actualizado</span>`,
                });
            }, 300);
        } else {
            Swal.fire({
                title: response.titulo,
                text: response.message,
                icon: "warning",
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonText: "Ok",
                showCloseButton: !0,
            }).then(() => {
                overlay.hide();
            });
        }
    }).catch((reason) => {
        console.info("reason:", reason);
        Swal.fire({
            title: 'Error',
            text: reason,
            icon: "error",
            confirmButtonText: "Ok",
            showCloseButton: !0,
        }).then(() => {
            overlay.hide();
        });
    });

}
const eliminarUser = (id) => {
    const form = $("#formDeleteUserId");
    const url = form.attr('action');
    $("#userDeleteId").empty().val(id);
    const dataForm = form.serialize();
    Swal.fire({
        title: "¿Eliminar Registro?",
        text: "¿Confirma eliminar Usuario?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Si, Eliminar!",
        showCloseButton: true,
        cancelButtonText: "Cancelar",
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        returnFocus: false,
        preConfirm: function() {
            return new Promise(function(resolve) {
                $.ajax({
                        url: url,
                        type: 'post',
                        data: dataForm,
                    }).done((response) => {
                        // Manejar la respuesta del servidor
                        if (response.status == 'ok') {
                            // Resuelve la promesa para cerrar la alerta
                            resolve(response);
                        } else {
                            Swal.fire({
                                title: response.titulo,
                                text: response.message,
                                icon: "warning",
                                showCancelButton: !0,
                                showConfirmButton: !1,
                                cancelButtonText: "Ok",
                                showCloseButton: !0,
                            });
                        }
                    })
                    .fail((reason) => {
                        // Manejar los errores de la llamada AJAX
                        Swal.fire({
                            title: 'Error',
                            text: reason,
                            icon: "error",
                            confirmButtonText: "Ok",
                            showCloseButton: !0,
                        });
                    });
            });
        }
    }).then((result) => {
        const {
            value: response
        } = result;
        if (result.isConfirmed) {
            Swal.fire({
                title: response.titulo,
                text: response.message,
                icon: "success",
                showCancelButton: !0,
                showConfirmButton: !1,
                cancelButtonText: "Cerrar",
                showCloseButton: !0,
            }).then(() => {
                $('#tableUsersId').DataTable().ajax.reload();
            });
        }
    })

}
