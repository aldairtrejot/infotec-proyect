<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="agregar_editar_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header background-modal">
                <div class="container">
                    <div class="row">
                        <div class="col-1">
                            <img src="../../../../assets/sirh/logo_plaza.png" style="max-width: 1000%;">
                        </div>
                        <div class="col-11">
                            <h1 class="text-tittle-card"><label id="titulo_plazas" claa="text-modal-tittle"></label>
                                Plaza.
                            </h1>
                            <p class="color-text-white">Este espacio está destinado a agregar o modificar información
                                relacionada con plazas. Aquí puedes ingresar nuevos datos o actualizar los
                                existentes según sea necesario.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-spacing"></div>
            <div class="card-body">
                <div class="container">
                    <div class="row mx-1">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="campo" class="form-label input-text-form">Tipo de plaza</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_plazas"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Tipo de
                                        contrataci&oacuten</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_tipo_contratacion_hraes"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Unidad responsable</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_unidad_responsable"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="div-spacing"></div>
                    <div class="row mx-1">
                        <div class="col-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Tabuladores</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_zonas_tabuladores_hraes"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Zona pagadora</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_tbl_zonas_pago"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Puesto</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_puesto_hraes"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <fieldset disabled>
                                <label for="campo" class="form-label input-text-form">Nivel</label>
                                <input type="text" placeholder="Nivel" class="form-control custom-input"
                                    id="id_cat_niveles_hraes">
                                <div class="line"></div>
                            </fieldset>
                        </div>

                    </div>

                    <div class="div-spacing"></div>
                    <div class="row mx-1">
                        <div class="col-3">
                            <label for="campo" class="form-label input-text-form">N&uacutemero de plaza</label><label
                                class="text-required">*</label>
                            <input minlength="7" type="number" class="form-control custom-input" id="num_plaza"
                                placeholder="Número de plaza" oninput="validarNumero(this)">
                            <div class="line"></div>
                        </div>
                        <div class="col-3">
                            <label for="campo" class="form-label input-text-form">Fecha de ingreso OPD</label><label
                                class="text-required">*</label>
                            <input type="date" class="form-control custom-input" id="fecha_ingreso_inst">
                            <div class="line"></div>
                        </div>
                        <div class="col-3">
                            <label for="campo" class="form-label input-text-form">Fecha de t&eacutermino</label><label
                                class="text-required">*</label>
                            <input type="date" class="form-control custom-input" id="fecha_termino_movimiento">
                            <div class="line"></div>
                        </div>
                        <div class="col-3">
                            <label for="campo" class="form-label input-text-form">Fecha de
                                modificaci&oacuten</label><label class="text-required">*</label>
                            <input type="date" class="form-control custom-input" id="fecha_modificacion">
                            <div class="line"></div>
                        </div>
                    </div>

                    <div class="div-spacing"></div>
                    <div class="row mx-1">
                        <div class="col-7">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="campo" class="form-label input-text-form">Unidad administrativa</label>
                                    <label class="text-required">*</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control custom-select selectpicker"
                                        data-style="input-select-selectpicker" aria-label="Default select example"
                                        data-live-search="true" id="id_cat_plaza_unidad_adm"
                                        data-none-results-text="Sin resultados">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="campo" class="form-label input-text-form">Fecha de movimiento</label><label
                                class="text-required">*</label>
                            <input type="date" class="form-control custom-input" id="fecha_inicio_movimiento">
                            <div class="line"></div>
                        </div>
                        <div class="col-2">
                            <fieldset disabled id="checkbox_disabled" data-toggle="tooltip" data-placement="top"
                                title="Una plaza plantilla es aquella cuyo número aún no está definido.">
                                <label for="campo" class="form-label input-text-form">¿Es plantilla?</label><label
                                    class="text-required">*</label>
                                <div class="form-check div-spacing">
                                    <input class="form-check-input" type="checkbox" value="0"
                                        id="id_cat_situacion_plaza_hraes">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Si
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-spacing"></div>
            <div class="modal-footer">
                <button onclick="ocultarModal();" type="button" class="btn btn-secondary" data-dismiss="modal"><i
                        class="fas fa-times"></i> Cancelar</button>
                <button type="button" class="btn btn-success save-botton-modal" onclick="return validar();"><i
                        class="fas fa-save"></i> Guardar</button>
                <input type="hidden" id="id_object">
                <input type="hidden" id="id_tbl_centro_trabajo_hraes_aux">
            </div>
        </div>
    </div>
</div>