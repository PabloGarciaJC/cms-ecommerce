
let mdFormularioRegistro = document.getElementById('mdFormularioRegistro');
let mdUsuarioR = document.getElementById('mdUsuarioRegistro');
let mdEmailR = document.getElementById('mdEmailRegistro');
let mdPasswordR = document.getElementById('mdPasswordRegistro');
let mdConfirmarPasswordR = document.getElementById('mdConfirmarPasswordRegistro');
let mdErrorRegistro = document.getElementById('mdErrorRegistro');
let expresion = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

mdFormularioRegistro.addEventListener('submit', (e) => {

  // Mostrar Errores Generales

  // Usuario:
  if (mdUsuarioR.value == null || mdUsuarioR.value == '') {
    mostrarMensajeError('cErrorUsuario', 'Ingrese Alias');
    e.preventDefault();
  } else if (mdUsuarioR.value.length > 10) {
    mostrarMensajeError('cErrorUsuario', 'El Alias debe de Tener Max. 10 Caracteres');
    e.preventDefault();
  }

  // Email:
  if (mdEmailR.value == null || mdEmailR.value == '') {
    mostrarMensajeError('cErrorEmail', 'Ingrese Email');
    e.preventDefault();
  } else if (!expresion.test(mdEmailR.value)) {
    mostrarMensajeError('cErrorEmail', 'El Email No es Valido');
    e.preventDefault();
  }

  // Password
  if (mdPasswordR.value == null || mdPasswordR.value == '') {
    mostrarMensajeError('cErrorPassword', 'Ingrese Password');
    e.preventDefault();
  }

  // Confirmar Password
  if (mdConfirmarPasswordR.value == null || mdConfirmarPasswordR.value == '') {
    mostrarMensajeError('cErrorConfirmarPassword', 'Ingrese Confirmar Password');
    e.preventDefault();
  } else if (mdConfirmarPasswordR.value != mdPasswordR.value) {
    mostrarMensajeError('cErrorConfirmarPassword', 'Las Password deben de coincidir');
    e.preventDefault();
  }

  // Validar Checked
  let mdCheckedR = document.getElementById('mdCheckedRegistro').checked;
  if (!mdCheckedR) {
    mostrarMensajeError('cErrorChecked', 'Debes Aceptar los Términos y Condiciones');
    e.preventDefault();
  }

  // Funcion para No escribir tanto codigo.
  function mostrarMensajeError(claseInput, mensaje) {
    let elemento = document.querySelector(`.${claseInput}`);
    elemento.lastElementChild.innerHTML = mensaje;
  }

  // Borrar Errores Generales

  // Usuario:
  mdUsuarioR.addEventListener('keypress', (e) => {
    let mdUsuarioR = document.querySelector('.cErrorUsuario');
    mdUsuarioR.lastElementChild.innerHTML = "";
  });

  mdUsuarioR.addEventListener('change', (e) => {
    let mdUsuarioR = document.querySelector('.cErrorUsuario');
    mdUsuarioR.lastElementChild.innerHTML = "";
  });

  // Email
  mdEmailR.addEventListener('keypress', (e) => {
    let mdEmailR = document.querySelector('.cErrorEmail');
    mdEmailR.lastElementChild.innerHTML = "";
  });

  mdEmailR.addEventListener('change', (e) => {
    let mdEmailR = document.querySelector('.cErrorEmail');
    mdEmailR.lastElementChild.innerHTML = "";
  });

  // Password
  mdPasswordR.addEventListener('keypress', (e) => {
    let mdPasswordR = document.querySelector('.cErrorPassword');
    mdPasswordR.lastElementChild.innerHTML = "";
  });

  mdPasswordR.addEventListener('change', (e) => {
    let mdPasswordR = document.querySelector('.cErrorPassword');
    mdPasswordR.lastElementChild.innerHTML = "";
  });

  // Confirmar Password
  mdConfirmarPasswordR.addEventListener('keypress', (e) => {
    let mdConfirmarPasswordR = document.querySelector('.cErrorConfirmarPassword');
    mdConfirmarPasswordR.lastElementChild.innerHTML = "";
  });

  mdConfirmarPasswordR.addEventListener('change', (e) => {
    let mdConfirmarPasswordR = document.querySelector('.cErrorConfirmarPassword');
    mdConfirmarPasswordR.lastElementChild.innerHTML = "";
  });
  // Borrar Errores Generales

});



