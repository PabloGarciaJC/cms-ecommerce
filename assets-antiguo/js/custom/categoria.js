class Categoria {

    onReady() {
        this.customCategoria();
    }

    // Método crear
    crear() {
        let $mdFormularioListarCategoria = $('#mdFormularioListarCategoria');
        if ($mdFormularioListarCategoria.length) {
            $mdFormularioListarCategoria.on('submit', function (e) {
                e.preventDefault(); // Freno Submit o Envío;

                let listarCategoria = $('#listarCategoria').val();
                let listarSubcategoria = $('#listarSubcategoria').val();

                // Validación
                if (!listarCategoria) {
                    mostrarMensajeError('errorListarCategoria', 'Ingrese Categoria');
                } else {
                    mostrarMensajeError('errorListarCategoria', '');
                }

                // Función para Mostrar y Borrar los Mensajes:
                function mostrarMensajeError(claseInput, mensaje) {
                    let $elemento = $(`.${claseInput}`);
                    $elemento.find(':last-child').html(mensaje);
                }

                // Registro Usuario Ajax
                $.ajax({
                    type: 'POST',
                    url: baseUrl + 'Categoria/listar',
                    data: {
                        listarCategoria: listarCategoria,
                        listarSubcategoria: listarSubcategoria
                    },
                })
                    .done(function (response) {
                        $("#respuestaPhplistarCategoria").html(response);
                        if (response == 1) {
                            Swal.fire({
                                title: 'Registro Completo',
                                icon: 'success',
                                timer: 500,
                                showConfirmButton: false
                            }).then(function () {
                                window.location = baseUrl + "Categoria/gestionarCategorias";
                            });
                        }
                    });
            });
        }
    }

    edit() {
        let $mdFormularioActualizarCategoria = $("#mdFormularioActualizarCategoria");
        if ($mdFormularioActualizarCategoria.length) {
            $mdFormularioActualizarCategoria.on("submit", function (e) {
                e.preventDefault(); // Freno Submit o Envío;

                // Capturo el Valor de los Inputs MODAL
                let id = $("#idCategoria").val();
                let categoria = $("#editarCategoria").val();

                // Validación
                if (!categoria) {
                    mostrarMensajeError("errorCategoria", "Ingrese Categoria");
                } else {
                    mostrarMensajeError("errorCategoria", "");
                }

                // Función para Mostrar y Borrar los Mensajes:
                function mostrarMensajeError(claseInput, mensaje) {
                    let $elemento = $(`.${claseInput}`);
                    $elemento.find(":last-child").html(mensaje);
                }

                // Categoria Ajax
                $.ajax({
                    type: "POST",
                    url: baseUrl + "Categoria/editar",
                    data: { id: id, categoria: categoria }, // Usar objeto para evitar errores con espacios o caracteres especiales
                }).done(function (response) {
                    $("#respuestaPhpEditarCategoria").html(response);
                    if (response == 1) {
                        Swal.fire({
                            title: "Completado",
                            icon: "success",
                            timer: 500,
                            showConfirmButton: false,
                        }).then(function () {
                            window.location = baseUrl + "Categoria/gestionarCategorias";
                        });
                    }
                });
            });
        }
    }

    eliminar() {
        $('.btn-delete-categorias').on("click", function () {
            // Obtener los datos del botón
            let idCategoriaBd = $(this).data("id-delete-categorias");
            let nombreCategoriaBd = $(this).data("nombre-delete-categorias");
        
            // Mostrar la alerta de confirmación
            Swal.fire({
                title: "¿Estás Seguro?",
                text: "Se borrará de forma permanente: " + nombreCategoriaBd,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "¡Sí, Eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar la solicitud AJAX
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "Categoria/eliminar", // Ruta del servidor para eliminar
                        data: { id: idCategoriaBd }, // Enviar el ID de la categoría
                        success: function (response) {
                            if (response == 1) {
                                // Mostrar mensaje de éxito
                                Swal.fire({
                                    title: "¡Eliminado!",
                                    text: "La categoría ha sido eliminada con éxito.",
                                    icon: "success",
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    // Recargar la página o redirigir
                                    window.location = baseUrl + "Categoria/gestionarCategorias";
                                });
                            } else {
                                // Mostrar mensaje de error
                                Swal.fire({
                                    icon: "error",
                                    title: "¡IMPORTANTE!",
                                    text: "Error: No se puede eliminar categorías que tienen productos asociados.",
                                });
                            }
                        },
                        error: function () {
                            // Manejar errores de la solicitud
                            Swal.fire({
                                icon: "error",
                                title: "¡Error!",
                                text: "Hubo un problema al intentar eliminar la categoría.",
                            });
                        }
                    });
                }
            });
        });
    }

    repoblarModal() {
        $('.btn-edit-categorias').on("click", function () {
            let id = $(this).data("id-edit-categorias");
            let categoria = $(this).data("lista-edit-categorias");
            $("#idCategoria").val(id);
            $("#editarCategoria").val(categoria);
        });
    }

    // Método customCategoria
    customCategoria() {
        this.crear();
        this.edit();
        this.repoblarModal();
        this.eliminar();
    }

    // Iniciar aplicación
    init() {
        this.onReady();
    }
}

// Instanciamos e iniciamos
const appCategoria = new Categoria();
appCategoria.init();