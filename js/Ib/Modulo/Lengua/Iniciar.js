var id_tbl_empleados_hraes = document.getElementById('id_tbl_empleados_hraes').value;

function buscarLengua(){ //BUSQUEDA
    let buscarNew = clearElement(buscar_lg);
    let buscarlenth = lengthValue(buscarNew);
    
    if (buscarlenth == 0){
        iniciarTabla_lg(null, iniciarBusqueda_lg(),id_tbl_empleados_hraes);
    } else {
        iniciarTabla_lg(buscarNew, iniciarBusqueda_lg(),id_tbl_empleados_hraes);
    }
}

function iniciarTabla_lg(busqueda, paginador, id_tbl_empleados_hraes) { 
    $.post('../../../../App/View/Central/Modulo/Lengua/tabla.php', {
        busqueda: busqueda, 
        paginador: paginador, 
        id_tbl_empleados_hraes:id_tbl_empleados_hraes
    },
        function (data) {
            $("#tabla_lengua").html(data); 
        }
    );
}

function agregarEditarLengua(id_object){
    $("#id_object").val(id_object);
    let titulo = document.getElementById("tituloEspecialidad");
    titulo.textContent = 'Modificar';
    $("#id_object").val(id_object);
    if (id_object == null){
        titulo.textContent = 'Agregar';
        $("#agregar_editar_lengua").find("input,textarea,select").val("");
    }

    $.post("../../../../App/Controllers/Central/LenguaC/DetallesC.php", {
        id_object: id_object
    },
        function (data) {
            let jsonData = JSON.parse(data);
            let response = jsonData.response; 
            let especialidad = jsonData.especialidad; 

            $('#cedula_espec_').val(response.cedula);

            $('#id_cat_especialidad_hraes').empty();
            $('#id_cat_especialidad_hraes').html(especialidad); 
            $('#id_cat_especialidad_hraes').selectpicker('refresh');
            $('.selectpicker').selectpicker();
        }
    );

    $("#agregar_editar_lengua").modal("show");
}

function salirAgregarEditarLengua(){
    $("#agregar_editar_lengua").modal("hide");
}


function guardarCedula() {
    $.post("../../../../App/Controllers/Central/EspecialidadC/AgregarEditarC.php", {
        id_object: $("#id_object").val(),
        cedula: $("#cedula_espec_").val(),
        id_cat_especialidad_hraes: $("#id_cat_especialidad_hraes").val(),
        id_tbl_empleados_hraes:id_tbl_empleados_hraes
    },
        function (data) {
            if (data == 'edit'){
                mensajeExito('Especialidad modificada con éxito');
            } else if (data == 'add') {
                mensajeExito('Especialidad agregada con éxito');  
            } else {
                mensajeError(data);
            }
            $("#agregar_editar_especialidad").modal("hide");
            buscarEspecialidad();
        }
    );
}

function eliminarLengua(id_object) {//ELIMINAR USUARIO
    Swal.fire({
        title: "¿Está seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
        $.post("../../../../App/Controllers/Central/EspecialidadC/EliminarC.php", {
                id_object: id_object
            },
            function (data) {
                if (data == 'delete'){
                    mensajeExito('Especialidad eliminada con éxito')
                } else {
                    mensajeError(data);
                }
                buscarEspecialidad();
            }
        );
    }
    });
}