// Recordatorio: Los div donde muestro los errores, estan en banner.php
// Validar los datos 
if (mdUsuarioR == null || mdUsuarioR == '') {
  mostrarMensajeError('cErrorUsuario', 'Ingrese Alias');
} else if (mdUsuarioR.length > 12) {
  mostrarMensajeError('cErrorUsuario', 'El Alias debe de Tener Max. 12 Caracteres');
} else {
  mostrarMensajeError('cErrorUsuario', '');
}

if (mdEmailR == null || mdEmailR == '') {
  mostrarMensajeError('cErrorEmail', 'Ingrese Email');
} else if (!expresion.test(mdEmailR)) {
  mostrarMensajeError('cErrorEmail', 'El Email No es Valido');
} else {
  mostrarMensajeError('cErrorEmail', '');
}

if (mdPasswordR == null || mdPasswordR == '') {
  mostrarMensajeError('cErrorPassword', '<strong>Error</strong>, Ingrese Contraseñas');
} else {
  mostrarMensajeError('cErrorPassword', '');
}

if (mdConfirmarPasswordR == null || mdConfirmarPasswordR == '') {
  mostrarMensajeError('cErrorConfirmarPassword', '<strong>Error</strong>, Las Contraseñas deben de coincidir');
} else if (mdConfirmarPasswordR != mdPasswordR) {
  mostrarMensajeError('cErrorConfirmarPassword', '<strong>Error</strong>, Las Contraseñas deben de coincidir');
} else {
  mostrarMensajeError('cErrorConfirmarPassword', '');
}

if (!mdCheckedR) {
  mostrarMensajeError('cErrorChecked', 'Debes Aceptar los Términos y Condiciones');
} else {
  mostrarMensajeError('cErrorChecked', '');
}

// Funcion para Mostrar y Borrar los Mensajes:
function mostrarMensajeError(claseInput, mensaje) {
  let elemento = document.querySelector(`.${claseInput}`);
  elemento.lastElementChild.innerHTML = mensaje;
}
