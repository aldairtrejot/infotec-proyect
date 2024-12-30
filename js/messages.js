//MESSAGE ERROR
function messajeError(text) {
    return Swal.fire({
        icon: "error",
        title: "Ocurrio Algo",
        text: text
    });
}

function validarData(data, text) {
    if (!data || data.trim() === '') {
        messajeError('Campo ' + text + '* no puede estar vacío.');
        return false;
    }
    return true;
}
