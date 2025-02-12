

//FUNCIONES PARA OBTENER EL ID -> NOMBRE DE USUARIO Y FECHA EN LA QUE SE CAPTURO LA INFORMACION


/*
|--------------------------------------------------------------------------
| Funcion para obtener el id de usuario y fecha
|--------------------------------------------------------------------------
| La funcion obtiene el id de usuario y fecha, si alguno de los dos trae datos en 0, es decir datos vacios
| se agregara un _ caso contrario se asignara el valor y se llamara la funcion la cual traera el nombre de usuario
| y la fecha de captura.
|
*/
function isGetUser(id_user, date, hour) {

    console.log(id_user);
    console.log(date);
    console.log(hour);

    /*
    let _id_user = id_user != false ? id_user : ' _';
    let _date = date != false ? date : ' _';
    let _hour = hour != false ? hour : ' _';

    if (_id_user != ' _') {
        getDataUser(_id_user, _date, _hour)
    } else {
        showModalUser(_id_user, _date, _hour)
    }*/
}


/*
|--------------------------------------------------------------------------
| Funcion para obtener el nombre de usuario
|--------------------------------------------------------------------------
| La funcion obtiene el nombre de usuario a travez de la funcion de ajax, retornando el nombre del id de usuario
| el cual registro el ultimo movimiento en el sistema
|
*/
function getDataUser(id_user, date, hour) {
    $.post("../../../../App/Controllers/Admin/UsuariosC/GetUserC.php", {
        id_user: id_user
    },
        function (data) {
            showModalUser(data, date, hour)
        }
    );
}

/*
|--------------------------------------------------------------------------
| Funcion para  mostrar el modal con el nombre de usuario y fecha
|--------------------------------------------------------------------------
| Muestra el modal con el usuario y la fecha en que se capturo
|
*/
function showModalUser(id_user, date, hour) {
    let nombre_usuario_ = document.getElementById("nombre_usuario_");
    let fecha_usuario_ = document.getElementById("fecha_usuario_");
    let hora_usuario_ = document.getElementById("hora_usuario_");

    nombre_usuario_.textContent = id_user;
    fecha_usuario_.textContent = date;
    hora_usuario_.textContent = hour;
    $("#modal_mostrar_usuario").modal("show");
}

/*
|--------------------------------------------------------------------------
| Funcion para ocultar el modal de usuario
|--------------------------------------------------------------------------
*/
function hiddenModalUser() {
    $("#modal_mostrar_usuario").modal("hide");
}