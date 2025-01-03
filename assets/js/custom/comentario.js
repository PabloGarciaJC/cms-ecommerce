class Commentario {

    onReady() {
        this.customCommentario();
    }

    editarComentarioPanelAdministrador() {
        $('.guardar-estado').on('click', function () {
            var comentarioId = $(this).data('id');
            var nuevoEstado = $('#comentario-' + comentarioId).find('.estado-select').val();
            $.ajax({
                url: baseUrl + 'Admin/cambiarEstadoComentario',
                type: 'POST',
                data: {
                    comentario_id: comentarioId,
                    estado: nuevoEstado
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            title: "Completado",
                            text: "El estado del comentario se ha actualizado correctamente.",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        })
                    } else {
                        Swal.fire({
                            text: "Error al actualizar el estado del comentario.",
                            icon: "error",
                            showConfirmButton: true
                        });
                    }
                },
                error: function () {
                    alert('Error al realizar la solicitud.');
                }
            });
        });
    }

    guardarComentarioFronted() {
        $('#submitReview').on('click', function (e) {
            e.preventDefault();
            const formData = $('#reviewForm').serialize();
            $.ajax({
                type: "POST",
                url: baseUrl + 'Comentario/guardar',
                data: formData,
                success: function (response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            title: "Completado",
                            text: data.message,
                            icon: "success",
                            timer: 800,
                            showConfirmButton: false
                        });
                        // Limpiar el textarea
                        $('#comentario').val('');
                        // Desmarcar las estrellas
                        $('input[name="calificacion"]').prop('checked', false);
                    } else {
                        Swal.fire({
                            html: `<ul style="text-align: left;">${data.errors.map(error => `<li>${error}</li>`).join('')}</ul>`,
                            icon: "error",
                            showConfirmButton: true
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    alert("Ocurrió un error. Inténtalo de nuevo.");
                }
            });
        });
    }

    // Método customCommentario
    customCommentario() {
        this.editarComentarioPanelAdministrador();
        this.guardarComentarioFronted();
    }

    // Iniciar aplicación
    init() {
        this.onReady();
    }
}

const appCommentario = new Commentario();
appCommentario.init();