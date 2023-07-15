function mostrarFormulario(formulario) {
  var formularios = document.querySelectorAll('form');
  var formularioActual = document.getElementById(formulario);

  for (var i = 0; i < formularios.length; i++) {
    formularios[i].style.display = 'none';
  }

  formularioActual.style.display = 'block';
  formularioActual.classList.add('formulario-animado');
}
