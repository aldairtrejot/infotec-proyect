function validarLicencia(){
    let id_cat_tipo_licencia = document.getElementById('id_cat_tipo_licencia').value;
    let id_cat_tipo_dias = document.getElementById('id_cat_tipo_dias').value;
    let horas_max_dia = document.getElementById('horas_max_dia').value;
    let fecha_desde_ = document.getElementById('fecha_desde_licen').value;
    let fecha_hasta_ = document.getElementById('fecha_hasta_licen').value;
    let fecha_inicio_nom = document.getElementById('fecha_inicio_nom').value;
    let fecha_fin_nomina = document.getElementById('fecha_fin_nomina').value;
    let fecha_registro_ = document.getElementById('fecha_registro_licen').value;
    let id_cat_estatus_incidencias = document.getElementById('id_cat_estatus_incidencias').value;
    let id_object = document.getElementById('id_object').value;

    if (validarData(id_cat_tipo_licencia,'Tipo de licencia') &&
    validarData(id_cat_tipo_dias,'Tipo de días') &&
    validarData(fecha_desde_licen,'Fecha inicio') &&
    validarData(fecha_hasta_licen,'Fecha fin') &&
    validarData(fecha_inicio_nom,'Fecha inicio nómina') &&
    validarData(fecha_fin_nomina,'Fecha fin nómina') &&
    validarData(fecha_registro_licen,'Fecha registro') &&
    validarData(id_cat_estatus_incidencias,'Estatus') 
    ){
        if(horas_max_dia.length < 3){
            validateEstatus_(id_object,id_cat_estatus_incidencias); // ---> VALIDA QUE EL ESTATUS CORRESPONDA
        } else {
            notyf.error('Campo Hora debe tener un máximo de 2 caracteres');
        }
    }
}
                            

function validateEstatus_(id_object,id_estatus){
    $.post("../../../../App/Controllers/Central/LicenciaC/ValidarEstatusC.php", {
        id_object:id_object,
        id_estatus: id_estatus,
        id_tbl_empleados_hraes:id_tbl_empleados_hraes
    },
        function (data) {

            let jsonData = JSON.parse(data);
            let bool = jsonData.bool; 
            let message = jsonData.message;

            if (bool){
                guardarLicencia();
            } else {
                notyf.error(message);
            }
        }
    );
}