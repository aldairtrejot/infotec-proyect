<?php
include '../librerias.php';

$id_objectDependiente = $_POST['id_object'];
$faltaModelM = new FaltaModelM();
$row = new row();

if ($id_objectDependiente != null) {
    $response = $row->returnArray($faltaModelM->listarEditById($id_objectDependiente));
    $var = [
        'response' => $response,
    ];
    echo json_encode($var);

} else {
    $response = $faltaModelM->listarByNull();
    $var = [
        'response' => $response,
    ];
    echo json_encode($var);
}
