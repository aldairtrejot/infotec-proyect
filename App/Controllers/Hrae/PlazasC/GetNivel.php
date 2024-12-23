<?php
include '../librerias.php';
include '../../../Model/Hraes/Catalogos/CatPuestoM/CatPuestoM.php';

$row = new Row();
$catalogoPuestoM = new catalogoPuestoM();
$message = 'Nivel';

$id_cat_puesto_hraes = $_POST['id_cat_puesto_hraes'];

if ($id_cat_puesto_hraes != null){
    $result = $row ->returnArrayById($catalogoPuestoM->nameOfPuesto($id_cat_puesto_hraes));
    $message = $result[0];
} 

$var = [
    'message' => $message,
];
echo json_encode($var);
