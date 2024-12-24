class Producto {

    onReady() {
        this.customProducto();
    }

    crear() {
        $(document).ready(function () {
            let $formularioProducto = $("#formularioProducto");

            if ($formularioProducto.length) {
                $formularioProducto.on("submit", function (e) {
                    e.preventDefault();
                    let nombreProducto = $("#nombreProducto").val();
                    let idProducto = $("#idProducto").val();
                    let categoria = $("#categoria").val();
                    let precioProducto = $("#precioProducto").val();
                    let stockProducto = $("#stockProducto").val();
                    let ofertaProducto = $("#ofertaProducto").val();
                    let marcaProducto = $("#marcaProducto").val();
                    let memoriaRamProducto = $("#memoriaRamProducto").val();
                    let descripcionProducto = $("#descripcionProducto").val();
                    let guardarImagenProducto = $("#archivoImagenProducto").val();
                    let datosFormularioProducto = new FormData();
                    let imagenPropiedadesProducto = $("#archivoImagenProducto")[0].files[0];
                    datosFormularioProducto.append("nombreProducto", nombreProducto);
                    datosFormularioProducto.append("idProducto", idProducto);
                    datosFormularioProducto.append("categoria", categoria);
                    datosFormularioProducto.append("precioProducto", precioProducto);
                    datosFormularioProducto.append("stockProducto", stockProducto);
                    datosFormularioProducto.append("ofertaProducto", ofertaProducto);
                    datosFormularioProducto.append("marcaProducto", marcaProducto);
                    datosFormularioProducto.append("memoriaRamProducto", memoriaRamProducto);
                    datosFormularioProducto.append("descripcionProducto", descripcionProducto);
                    datosFormularioProducto.append("guardarImagenProducto", imagenPropiedadesProducto);

                    // Validación
                    if (!nombreProducto) {
                        mostrarMensajeError("errorNombreProducto", "Ingrese Nombre");
                    } else {
                        mostrarMensajeError("errorNombreProducto", "");
                    }

                    if (!precioProducto) {
                        mostrarMensajeError("errorPrecioProducto", "Ingrese Precio");
                    } else if (isNaN(precioProducto)) {
                        mostrarMensajeError("errorPrecioProducto", "Precio No es Válido");
                    } else {
                        mostrarMensajeError("errorPrecioProducto", "");
                    }

                    if (!stockProducto) {
                        mostrarMensajeError("errorStockProducto", "Ingrese Stock");
                    } else if (isNaN(stockProducto)) {
                        mostrarMensajeError("errorStockProducto", "Stock No es Válido");
                    } else {
                        mostrarMensajeError("errorStockProducto", "");
                    }

                    if (!marcaProducto) {
                        mostrarMensajeError("errorMarcaProducto", "Ingrese la Marca");
                    } else {
                        mostrarMensajeError("errorMarcaProducto", "");
                    }

                    if (!memoriaRamProducto) {
                        mostrarMensajeError("errorMemoriaRamProducto", "Ingrese Capacidad");
                    } else if (isNaN(memoriaRamProducto)) {
                        mostrarMensajeError("errorMemoriaRamProducto", "Capacidad No es Válida");
                    } else {
                        mostrarMensajeError("errorMemoriaRamProducto", "");
                    }

                    // Función para Mostrar y Borrar los Mensajes
                    function mostrarMensajeError(claseInput, mensaje) {
                        $(`.${claseInput}`).last().children().html(mensaje);
                    }

                    $.ajax({
                        type: "POST",
                        url: baseUrl + "Producto/guardar",
                        data: datosFormularioProducto,
                        contentType: false,
                        processData: false,
                    }).done(function (response) {
                        $("#respuestaPhpGuardar").html(response);
                        if (response == 1) {
                            Swal.fire({
                                title: "Completado",
                                icon: "success",
                                timer: 500,
                                showConfirmButton: false
                            }).then(function () {
                                window.location = baseUrl + "producto/listar";
                            });
                        }
                    });
                });
            }
        });
    }

    eliminar() {
        function eliminarDatosProducto(idProducto, nombreProductoBd) {
            Swal.fire({
                title: "Estas Seguro ?",
                text: "Se borrará de forma permanente : " + nombreProductoBd,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Si, Eliminar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: baseUrl + "Producto/eliminar",
                        data: { id: idProducto },
                    }).done(function (response) {
                        if (response == 1) {
                            Swal.fire({
                                title: "Eliminado!",
                                text: "Su Producto ha sido eliminado.",
                                icon: "success",
                                timer: 500,
                                showConfirmButton: false
                            }).then(function () {
                                window.location = baseUrl + "Producto/listar";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "¡IMPORTANTE!",
                                text:
                                    "Error, no se pueden Eliminar Los Productos que Tengan Pedidos Pendiente.....",
                            });
                        }
                    });
                }
            });
        }
    }

    mostrarTodos() {
        $(document).ready(function () {
            let $formularioProducto = $("#formularioProducto");

            if ($formularioProducto.length) {
                $formularioProducto.on("submit", function (e) {
                    e.preventDefault();

                    let nombreProducto = $("#nombreProducto").val();
                    let idProducto = $("#idProducto").val();
                    let categoria = $("#categoria").val();
                    let precioProducto = $("#precioProducto").val();
                    let stockProducto = $("#stockProducto").val();
                    let ofertaProducto = $("#ofertaProducto").val();
                    let marcaProducto = $("#marcaProducto").val();
                    let memoriaRamProducto = $("#memoriaRamProducto").val();
                    let descripcionProducto = $("#descripcionProducto").val();
                    let guardarImagenProducto = $("#archivoImagenProducto").val();
                    let datosFormularioProducto = new FormData();
                    let imagenPropiedadesProducto = $("#archivoImagenProducto")[0].files[0];
                    datosFormularioProducto.append("nombreProducto", nombreProducto);
                    datosFormularioProducto.append("idProducto", idProducto);
                    datosFormularioProducto.append("categoria", categoria);
                    datosFormularioProducto.append("precioProducto", precioProducto);
                    datosFormularioProducto.append("stockProducto", stockProducto);
                    datosFormularioProducto.append("ofertaProducto", ofertaProducto);
                    datosFormularioProducto.append("marcaProducto", marcaProducto);
                    datosFormularioProducto.append("memoriaRamProducto", memoriaRamProducto);
                    datosFormularioProducto.append("descripcionProducto", descripcionProducto);
                    datosFormularioProducto.append("guardarImagenProducto", imagenPropiedadesProducto);

                    // Validación
                    if (!nombreProducto) {
                        mostrarMensajeError("errorNombreProducto", "Ingrese Nombre");
                    } else {
                        mostrarMensajeError("errorNombreProducto", "");
                    }

                    if (!precioProducto) {
                        mostrarMensajeError("errorPrecioProducto", "Ingrese Precio");
                    } else if (isNaN(precioProducto)) {
                        mostrarMensajeError("errorPrecioProducto", "Precio No es Válido");
                    } else {
                        mostrarMensajeError("errorPrecioProducto", "");
                    }

                    if (!stockProducto) {
                        mostrarMensajeError("errorStockProducto", "Ingrese Stock");
                    } else if (isNaN(stockProducto)) {
                        mostrarMensajeError("errorStockProducto", "Stock No es Válido");
                    } else {
                        mostrarMensajeError("errorStockProducto", "");
                    }

                    if (!marcaProducto) {
                        mostrarMensajeError("errorMarcaProducto", "Ingrese la Marca");
                    } else {
                        mostrarMensajeError("errorMarcaProducto", "");
                    }

                    if (!memoriaRamProducto) {
                        mostrarMensajeError("errorMemoriaRamProducto", "Ingrese Capacidad");
                    } else if (isNaN(memoriaRamProducto)) {
                        mostrarMensajeError("errorMemoriaRamProducto", "Capacidad No es Válida");
                    } else {
                        mostrarMensajeError("errorMemoriaRamProducto", "");
                    }

                    // Función para Mostrar y Borrar los Mensajes
                    function mostrarMensajeError(claseInput, mensaje) {
                        $(`.${claseInput}`).last().children().html(mensaje);
                    }

                    $.ajax({
                        type: "POST",
                        url: baseUrl + "Producto/guardar",
                        data: datosFormularioProducto,
                        contentType: false,
                        processData: false,
                    }).done(function (response) {
                        $("#respuestaPhpGuardar").html(response);
                        if (response == 1) {
                            Swal.fire({
                                title: "Completado",
                                icon: "success",
                                timer: 500,
                                showConfirmButton: false
                            }).then(function () {
                                window.location = baseUrl + "producto/listar";
                            });
                        }
                    });
                });
            }
        });
    }

    buscador() {
        // Obtengo Valor de Buscador
        let buscadorProductos = document.getElementById("buscadorProductos");

        if (buscadorProductos) {
            // Inicia en Vacio
            let valorBuscadorProductos = "";

            // Inicia en Vacio
            let paginaActualBuscadorProductos = 1;

            // Carga Primero
            ajaxBuscadorProductos(paginaActualBuscadorProductos, valorBuscadorProductos);

            // Obtener Tiempo Real Datos Buscador
            buscadorProductos.addEventListener("keyup", (event) => {
                let valorBuscadorProductos = event.target.value;
                ajaxBuscadorProductos(
                    paginaActualBuscadorProductos,
                    valorBuscadorProductos
                );
            });

            // Function  Ajax
            function ajaxBuscadorProductos(
                paginaActualBuscadorProductos,
                valorBuscadorProductos
            ) {
                $.ajax({
                    type: "POST",
                    url: baseUrl + "Producto/buscador",
                    data: {
                        paginaActualBuscadorProductos: paginaActualBuscadorProductos,
                        buscadorProductos: valorBuscadorProductos,
                    },
                }).done(function (response) {
                    $("#respuestaPhpBuscadorProductos").html(response);
                });
            }
        }
    }

    imagen() {
        function vistaPreliminarImagenProducto(event) {

            let leerImagenProducto = new FileReader();
            let imagenProducto = document.getElementById('imagenProducto');
            var extensionesArchivo = /(\.jpg|\.jpeg|\.png)$/i;

            leerImagenProducto.onload = () => {
                if (leerImagenProducto.readyState == 2) {
                    imagenProducto.src = leerImagenProducto.result;
                }
            }
            leerImagenProducto.readAsDataURL(event.target.files[0]);

            //validacion
            let archivoImagenProducto = document.getElementById('archivoImagenProducto').value;
            var extensionesArchivo = /(\.jpg|\.jpeg|\.png)$/i;

            if (archivoImagenProducto == '') {
                mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Ingrese Imagen del Producto');
            } else if (!extensionesArchivo.exec(archivoImagenProducto)) {
                mostrarMensajeError('errorFileProducto', '<strong>Error</strong>, Formatos Inválido, Recomendados : JPG, JPEG, PNG');
                return false;
            } else {
                mostrarMensajeError('errorFileProducto', '');
            }

            // Funcion para Mostrar y Borrar los Mensajes:
            function mostrarMensajeError(claseInput, mensaje) {
                let elemento = document.querySelector(`.${claseInput}`);
                elemento.lastElementChild.innerHTML = mensaje;
            }
        }
    }


    // Método customProducto
    customProducto() {
        // this.crear();
        // this.eliminar(); 
        // this.mostrarTodos();
        // this.buscador();
        // this.imagen();

    }

    // Iniciar aplicación
    init() {
        // Llamamos event ready
        this.onReady();
    }
}

// Instanciamos e iniciamos
const appProducto = new Producto();
appProducto.init();