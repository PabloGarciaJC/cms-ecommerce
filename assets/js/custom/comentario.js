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

    // Método customCommentario
    customCommentario() {
        this.editarComentarioPanelAdministrador();
    }

    // Iniciar aplicación
    init() {
        this.onReady();
    }
}

const appCommentario = new Commentario();
appCommentario.init();