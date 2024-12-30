


function mensajeErrorOK(text) {
  return Swal.fire({
      icon: "error",
      title: "Ocurrio Algo",
      text: text
  });
}

function mensajeExito(text){
   const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  return Toast.fire({
    icon: "success",
    title: text
  });
}

function mensajeError(text){
  const Toast = Swal.mixin({
   toast: true,
   position: "top-end",
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   didOpen: (toast) => {
     toast.onmouseenter = Swal.stopTimer;
     toast.onmouseleave = Swal.resumeTimer;
   }
 });
 return Toast.fire({
   icon: "error",
   title: text
 });
}

function confirmarEliminar(){
 return Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      return true;
    }
  });
}


function validarNull(cadena){
  let bool = false;
  if(cadena.length === 0){
      bool = true;
  }
  return bool;
} 

function validarData(value, fieldName) {
  if (!value) {
      notyf.error(`Campo ${fieldName}* no puede estar vacío`);
      return false;
  }
  return true;
}

/*
function messageErrorLarge(text){
  Swal.fire({
      icon: "error",
      title: "Oops...",
      text: text,
    });
}
    */

function messageErrorLarge(text){
  Swal.fire({
    icon: 'error',
    title: 'Hubo un problema',
    text: text,
    customClass: {
      confirmButton: 'custom-confirm-button'
    },
    didOpen: () => {
      // Estilos en línea para cambiar el color del botón
      const confirmButton = Swal.getConfirmButton();
      confirmButton.style.backgroundColor = '#6c757d'; // Color de fondo del botón
      confirmButton.style.color = '#ffffff'; // Color del texto del botón
      confirmButton.style.border = 'none'; // Quitar borde
      confirmButton.style.padding = '10px 20px'; // Ajustar padding
      confirmButton.style.fontSize = '16px'; // Ajustar tamaño de fuente
      confirmButton.style.borderRadius = '5px'; // Ajustar radio de borde
    }
  });
}