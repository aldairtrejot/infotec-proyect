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
                        <h4>Hospital Regional de Alta Especialidad</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="card border-light">
        <div class="card-body">
            <div class="row div-spacing">
                <div class="col-9">
                    <h2 class="card-title tittle-card-index">Carga masiva</h2>
                </div>
            </div>

            <div class="div-spacing">
                <div class="row">
                    <div class="col-2">
                        <div class="div-spacing"></div>
                        <div class="card font-size-modulo shadow-lg">
                            <h6 class="card-header text-center background-modal color-text-tittle">Tipo de carga
                            </h6>
                            <div class="nav flex-column nav-pills text-tittle-card-nav-x" id="v-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                <a onclick="" class="nav-link-mod active" id="v-tabs-home-tab" data-toggle="pill"
                                    href="#v-tabs-home" role="tab" aria-controls="v-tabs-home" aria-selected="true">
                                    <i class="	fa fa-folder-open mr-2"></i> Faltas</a>

                                  
                                  
                                <a onclick="" class="nav-link-mod" id="v-tabs-profile-tab" data-toggle="pill"
                                    href="#v-tabs-profile" role="tab" aria-controls="v-tabs-profile"
                                    aria-selected="false">
                                    <i class="	fa fa-folder-open mr-2"></i> Empleados</a>

                                    <!--
                                <a onclick="" class="nav-link-mod" id="v-tabs-messages-tab" data-toggle="pill"
                                    href="#v-tabs-messages" role="tab" aria-controls="v-tabs-messages"
                                    aria-selected="false">
                                    <i class="	fa fa-folder-open mr-2"></i> Empleados</a>
                                <a onclick="" class="nav-link-mod" id="v-tabs-messages-tab" data-toggle="pill"
                                    href="#faltas_hraes_" role="tab" aria-controls="v-tabs-messages"
                                    aria-selected="false">
                                    <i class="	fa fa-folder-open mr-2"></i> Faltas</a>
-->
                            </div>
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="tab-content" id="v-tabs-tabContent">
                            <div class="tab-pane fade show active" id="v-tabs-home" role="tabpanel"
                                aria-labelledby="v-tabs-home-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card font-size-modulo shadow-lg">
                                                <h5 class="card-header text-center background-modal color-text-tittle">
                                                    Faltas</h5>
                                                <div class="card-body">
                                                    <?php include 'FaltaMasivo.php' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-tabs-profile" role="tabpanel"
                                aria-labelledby="v-tabs-profile-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card font-size-modulo shadow-lg">
                                                <h5 class="card-header text-center background-modal color-text-tittle">
                                                    Empleados</h5>
                                                <div class="card-body">
                                                    <?php include 'EmpleadoMasivo.php' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-tabs-messages" role="tabpanel"
                                aria-labelledby="v-tabs-messages-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card font-size-modulo shadow-lg">
                                                <h5 class="card-header text-center background-modal color-text-tittle">
                                                    Empleados</h5>
                                                <div class="card-body">
                                                    <?php // include 'Licencias/index.php' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-tabs-home_" role="tabpanel"
                                aria-labelledby="v-tabs-messages-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card font-size-modulo shadow-lg">
                                                <h5 class="card-header text-center background-modal color-text-tittle">
                                                    Faltas</h5>
                                                <div class="card-body">
                                                    <?php //include 'FaltaMasivo.php' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php include 'Loader.php' ?>

    <?php include '../../librerias.php' ?>
    <script src="../../../../js/Hraes/Masivo/Faltas.js"></script>
    <script src="../../../../js/Hraes/Masivo/Empleados.js"></script>