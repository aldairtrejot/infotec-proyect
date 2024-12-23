
function updateFileNameEmp(input) {
    let fileName = input.files[0].name;
    let fileNameContainer = input.parentElement.querySelector('.custom-file-name-empleados');
    fileNameContainer.innerText = fileName;
  }

  function ocultarModalEmpleados(){    
    $("#modal_carga_masiva_empleados").modal("hide");
}

function mostrarModalCargaFaltaEmpleados(){
    $('.custom-file-name-empleados').text('');
    $('#customFileEmpleado').val(null);
    $("#modal_carga_masiva_empleados").modal("show");
}

function validarCargaEmpleados(){
    let bool = false;
    let maxMB = 15;
    let fileInput = document.getElementById('customFileEmpleado');
    let file = fileInput.files[0];
    if (file) {
      let fileSize = file.size;
      let fileSizeKB = fileSize / 1024;
      let fileMb = fileSizeKB/1024;
      let fileExtension = file.name.split('.').pop();

      if (fileMb >= maxMB){
        notyf.error('El archivo debe tener un peso máximo de ' + maxMB + ' MB');
        //mensajeError('El archivo debe tener un peso máximo de ' + maxMB + ' MB');
      } else if (fileExtension != 'xlsx') {
        notyf.error('La extensión del archivo debe terminar .xlsx');
        //mensajeError('La extensión del archivo debe terminar .xlsx');
      } else {
        processDataEmpleado(file);
      }
    } else {
        notyf.error('Campo seleccione un archivo no puede estar vacio');
    }
    return bool;
  }




  function processDataEmpleado(file){
    ocultarModalEmpleados(); 
    fadeIn(); 
    let data = new FormData();
    data.append('file',file);

    $.ajax({
    url:"../../../../App/Controllers/Hrae/EmpleadoC/CargaC.php",
    type:'POST',
    contentType:false,
    data:data,
    processData:false,
    cache:false, 
    success: function (data) {
        fadeOut();
        console.log(data);
        let jsonData = JSON.parse(data);
        let bool = jsonData.bool; 
        let message = jsonData.message; 
        
        if (bool){
           // getFileEmpleado();
           console.log('success');
           notyf.success('El proceso se llevó a cabo con éxito');
        } else {
            fadeOut();
            notyf.error(message);
        }
}
});
}
function getFileEmpleado() {
    $.ajax({
        url: "../../../../App/Controllers/Hrae/FaltaC/DescargaC.php",
        type: 'POST',
        xhrFields: {
            responseType: 'blob' // Configura la respuesta esperada como un blob (archivo binario)
        },
        success: function (data) {
            if (data.size > 0) {
                var blob = new Blob([data], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'Faltas_respuesta_.xlsx'; // Nombre del archivo que se descargará
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                notyf.success('El proceso se llevó a cabo con éxito');
            } else {
                notyf.error('Error al ejecutar la acción');
            }
            fadeOut();
        },
        error: function (xhr, status, error) {
            notyf.error('Error al ejecutar la acción');
            fadeOut();
        }
    });
}


