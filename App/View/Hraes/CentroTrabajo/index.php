<?php include '../../nav-menu.php' ?>
<div class="container-fluid bg-image nav-padding">
    <br>
    <div class="card border-light shadow-lg">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-auto">
                        <div class="vertical-line"></div>
                    </div>
                    <div class="col padding-left-0">
<<<<<<< HEAD
                        <h4>HRAES</h4>
=======
                        <h4>Hospital Regional de Alta Especialidad</h4>
>>>>>>> parent of 606dea87 (E.CAMPA)
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="card border-light">
        <div class="card-body">
            <div class="row div-spacing">
                <div class="col-6">
                    <h2 class="card-title tittle-card-index">Centro de trabajo</h2>
                </div>
                <div class="col-3">

                    <!--
                    <button onclick="mostrarModalCarga();" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Launch demo modal
                    </button>
-->
                </div>
                <div class="col-3 search-container">
                    <input onkeyup="buscarCentro();" id="buscar" type="text" placeholder="Buscar..."
                        class="form-control mr-sm-2 search-input">
                    <span class="search-icon"><i class="fas fa-search"></i></span>
                </div>
            </div>

            <div class="row div-spacing">
                <div class="col-3">
                    <div class="form-inline">
                        <button onclick="agregarEditarDetalles(null)" type="button" class="btn btn-light"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-plus icono-pequeno-tabla"></i>
                            <span class="hide-menu text-button-add">&nbsp;Agregar</span>
                        </button>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <div class="text-center">
                        <table class="table table-bordered" id="tabla_centro_trabajo" style="width:100%">
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="table-right">
                        <button onclick="anteriorValor()" class="btn btn-light"><i class="fa fa-angle-double-left"></i>
                            <span class="hide-menu" style="font-weight: bold;"></span>
                        </button>
                        <label id="idtable">1</label>
                        <button onclick="siguienteValor()" class="btn btn-light"><i
                                class="fa fa-angle-double-right"></i>
                            <span class="hide-menu" style="font-weight: bold;"></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include '../../librerias.php' ?>
<script src="../../../../js/Hraes/CentroTrabajo/CentroTrabajo.js"></script>
<script src="../../../../js/Hraes/CentroTrabajo/validar.js"></script>
<script src="../../../../js/Hraes/CentroTrabajo/Busqueda.js"></script>
<script src="../../../../js/Hraes/CentroTrabajo/Carga.js"></script>

<?php include 'AgregarEditar.php' ?>
<?php include 'Carga.php' ?>