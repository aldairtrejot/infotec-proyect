<?php
include '../../../../conexion.php';
include '../../../Model/Hraes/CentroTrabajoM/CentroTrabajoM.php';

$listado = new modelCentroTrabajoHraes();
$paginador = $_POST['paginador'];

$query = $listado->listarByAll($paginador);

if (isset($_POST['busqueda'])) {
    $busqueda = $_POST['busqueda'];
    $query = $listado->listarByLike($busqueda,$paginador);
}

$data =
    '<table class="table table-striped table-small-rows" id="t-table" style="width:100%">
    <thead>
        <tr class="table-tittle-color">
            <th class="custom-text-table-tittle col-md-1">Acciones</th>
            <th class="custom-text-table-tittle">Centro de trabajo</th>
            <th class="custom-text-table-tittle">Nombre</th>
            <th class="custom-text-table-tittle">Entidad</th>
            <th class="custom-text-table-tittle">C&oacutedigo postal</th>
        </tr>
    </thead>';

if (!$result = pg_query($connectionDBsPro, $query)) {
    exit(pg_result_error($connectionDBsPro));
}
if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_row($result)) {
        $id_tbl_centro_trabajo_hraes = base64_encode($row[0]);
        $data .=
            '<tbody style="background-color: white;">
                        <tr>
                            <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sucess dropdown-toggle table-button-style" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-edit"></i></button>
                            <div class="dropdown-menu">
                                <button onclick="agregarEditarDetalles(' . $row[0] . ')" class="dropdown-item btn btn-light"><i class="fas fa-edit"></i> Modificar centro de trabajo</button>
                                    <form action="../Plazas/index.php" method="POST">
                                        <input type="hidden" id="postId" name="id_tbl_centro_trabajo_hraes" value="' . $row[0] . '" />
                                        <button id="centro_trabajo_plazas" class="dropdown-item btn btn-light"><i class="fas fa-bookmark"></i> Plazas asignadas al centro de trabajo</button>
                                    </form>
                                
                                <button onclick="eliminarEntity(' . $row[0] . ')" class="dropdown-item btn btn-light"><i class="far fa-trash-alt button-table-on-delete"></i> Eliminar centro de trabajo</button>  
                            </div>
                          </div>
                                </td>
                            <td>
                                ' . $row[1] . '
                            </td>
                            <td>
                                ' . $row[2] . '
                            </td>
                            <td>
                                ' . $row[3] . '
                            </td>
                            <td>
                                ' . $row[4] . '
                            </td>
                        </tr>
                    </tbody>
                </table>';
    }
}else {
    $data .= '<h6>Sin resultados</h6>';
}

echo $data;

