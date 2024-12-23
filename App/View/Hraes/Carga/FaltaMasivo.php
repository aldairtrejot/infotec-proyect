<style>
    .overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: linear-gradient(to bottom, #1e1e1e, #000000);
        opacity: 0.9;
        z-index: 9999;
        display: none;
    }

    .spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
    }
</style>

<div class="card  border-0">
    <div class="card-body">
        <h5 class="card-title">Proceso de Carga Masiva de Faltas</h5>
        <p class="card-text">
            <strong>¿Cómo se realiza el proceso de carga masiva?</strong><br>
            Para realizar el proceso exitoso de carga masiva es necesario considerar los siguientes puntos:
        </p>
        <ul>
            <li><strong>Carga masiva de faltas:</strong> Carga masiva de faltas solo esta disponible para agregar
                información</span>.</li>
            <li><strong>Formatos de fecha:</strong> Deben ser <span class="text-success">(AAAA-MM-DD)</span>.</li>
            <li><strong>Campos con *:</strong> Son <span class="font-weight-bold">requeridos</span>.</li>
            <li><strong>Límite de caracteres:</strong> La columna observaciones tiene un límite de <span
                    class="font-italic">50 caracteres</span> y código certificación <span class="font-italic">10
                    caracteres</span>.</li>
            <li><strong>Validación de CURP:</strong> El sistema valida que el campo CURP esté asociado a un empleado.
            </li>
            <li><strong>Estatus:</strong> Si cumple con las condiciones se marca "AGREGADO"; de lo contrario,
                "OMITIDO" con la observación correspondiente.</li>
            <li><strong>Descarga de Excel:</strong> Al finalizar se descarga un archivo Excel con las observaciones.
            </li>
        </ul>
        <p>
            Para comenzar el proceso de carga masiva, asegúrate de tener el layout adecuado <a download  href="../../../../assets/Formato/FormatoFaltas.xlsx">descargalo aqui</a>. Este archivo
            servirá como guía para preparar tus datos correctamente antes de cargarlos en el sistema.
        </p>
    </div>
</div>

<div class="col text-right">
    <button onclick="mostrarModalCargaFalta();" type="button" class="btn btn-light custom-btn text-button-upload"><i
            class="fa fa-upload mr-2"></i>
        Cargar</button>
</div>



<!-- MODALE_UPLOAD_FALTA -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="modal_carga_masiva_falta">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header background-modal">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <img src="../../../../assets/sirh/logo_carga_masiva.png" style="max-width: 100%;">
                        </div>
                        <div class="col-10">
                            <h1 style="color:white; font-family: 'Montserrat';font-size: 40px;">Carga masiva faltas</h1>
                            <p style="color:white;">Espacio para realizar cargas masivas de faltas: Un área
                                dedicada para facilitar la inserción eficiente en el
                                sistema.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-spacing"></div>
            <div class="card-body">

                <form action="../../../../App/Controllers/Hrae/CentroTrabajoC/CargaC.php" method="POST"
                    enctype="multipart/form-data">
                    <div class="container">
                        <div class="container mt-4">
                            <div class="custom-file-container">
                                <div class="custom-file-caption">Haz clic en el icono para cargar archivos</div>
                                <div class="custom-file-hint">Tamaño máximo: 5 MB</div>
                                <label for="customFile" class="btn btn-ligth">
                                    <i style="background:white" class="fas fa-upload custom-file-icon"></i>
                                </label>
                                <input type="file" class="custom-file-input d-none" id="customFile"
                                    onchange="updateFileName(this)" name="exel_centro_trabajo">
                                <div class="custom-file-name"></div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="div-spacing"></div>
            <div class="modal-footer">
                <button onclick="ocultarModalFalta();" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fas fa-times"></i> Cancelar</button>
                <button type="submit" onclick="return validarCargaFalta();" type="button"
                    class="btn btn-success save-botton-modal"><i class="fa fa-upload"></i>
                    Procesar</button>
            </div>
            </form>

        </div>
    </div>
</div>


