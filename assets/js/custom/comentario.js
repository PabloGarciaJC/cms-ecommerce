class Commentario {

    onReady() {
        this.customCommentario();
    }

    editarComentarioPanelAdministrador() {
        $('.guardar-estado').on('click', function (e) {

            let protectionLayer = $('#protection-layer').text().trim();
            let protectionTitle = $('#protection-layer').data('title');
            let protectionMessage = $('#protection-layer').data('message');
            let protectionBtnText = $('#protection-layer').data('close');
            if (protectionLayer === '1') {
                e.preventDefault();
                Swal.fire({
                    icon: "info",
                    title: protectionTitle,
                    html: `
                        <p class="contact-message">${protectionMessage}</p>
                        <div class="social-links">
                            <a href="https://www.facebook.com/PabloGarciaJC" target="_blank" title="Facebook"><i class="emoji-48"></i></a>
                            <a href="https://www.instagram.com/pablogarciajc" target="_blank" title="Instagram"><i class="emoji-49"></i></a>
                            <a href="https://www.linkedin.com/in/pablogarciajc" target="_blank" title="LinkedIn"><i class="emoji-50"></i></a>
                            <a href="https://www.youtube.com/channel/UC5I4oY7BeNwT4gBu1ZKsEhw" target="_blank" title="YouTube"><i class="emoji-52"></i></a>
                        </div>`,

                    confirmButtonText: protectionBtnText,
                });
                return;
            }

            // Lógica normal si no hay restricción
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
                        });
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
                            title: data.titulo,
                            icon: "success",
                            showConfirmButton: false,
                            confirmButtonText: data.boton,
                            timer: 1000
                        });
                        $('#comentario').val('');
                        $('input[name="calificacion"]').prop('checked', false);
                    } else {
                        let errorMessage = "";
                        data.message.forEach(function (error) {
                            errorMessage += `<p style="color: red;text-align: justify;"><i class="fa fa-times-circle"></i> ${error}</p>`;
                        });

                        Swal.fire({
                            icon: "error",
                            html: errorMessage,
                            confirmButtonText: data.boton
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