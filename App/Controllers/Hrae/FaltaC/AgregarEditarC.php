<?php
include '../librerias.php';

$faltaModelM = new FaltaModelM();
$bitacoraM = new BitacoraM();

$condicion = [
    'id_ctrl_faltas_hraes' => $_POST['id_object']
];

$datos = [
    'id_tbl_empleados_hraes' => $_POST['id_tbl_empleados_hraes'],
    'fecha_desde' => $_POST['fecha_desde'],
    'fecha_hasta' => $_POST['fecha_hasta'],
    'fecha_registro' => $_POST['fecha_registro'],
    'codigo_certificacion' => $_POST['codigo_certificacion'],
    'observaciones' => $_POST['observaciones']
];

$var = [
    'datos' => $datos,
    'condicion' => $condicion
];

if ($_POST['id_object'] != null) { //Modificar
    if ($faltaModelM ->editarByArray($connectionDBsPro, $datos, $condicion)) {
        $dataBitacora = [
            'nombre_tabla' => 'public.ctrl_retardo_hraes',
            'accion' => 'MODIFICAR',
            'valores' => json_encode($var),
            'fecha' => $timestamp,
            'id_users' => $_SESSION['id_user']
        ];
        $bitacoraM->agregarByArray($connectionDBsPro,$dataBitacora,'public.bitacora_hraes');
        echo 'edit';
    }

} else { //Agregar
    if ($faltaModelM ->agregarByArray($connectionDBsPro, $datos)) {
        $dataBitacora = [
            'nombre_tabla' => 'public.ctrl_retardo_hraes',
            'accion' => 'AGREGAR',
            'valores' => json_encode($var),
            'fecha' => $timestamp,
            'id_users' => $_SESSION['id_user']
        ];
        $bitacoraM->agregarByArray($connectionDBsPro,$dataBitacora,'public.bitacora_hraes');
        echo 'add';
    }
}

