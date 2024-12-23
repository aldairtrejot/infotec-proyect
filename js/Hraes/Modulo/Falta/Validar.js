function validarFalta_(){
    let fecha_desde = document.getElementById('fecha_desde').value;
    let fecha_hasta = document.getElementById('fecha_hasta').value;
    let fecha_registro = document.getElementById('fecha_registro').value;
    let codigo_certificacion = document.getElementById('codigo_certificacion').value;
    let Observaciones_falta = document.getElementById('Observaciones_falta').value;
    
    if (validarData(fecha_desde,'Fecha (Desde)') &&
        validarData(fecha_hasta,'Fecha (Hasta)') &&
        validarData(fecha_registro,'Fecha (Registro)') &&
        validarData(codigo_certificacion,'Código certificación') &&
        validarData(Observaciones_falta,'Observaciones') 
    ){
       guardarFalta();
    }    
}