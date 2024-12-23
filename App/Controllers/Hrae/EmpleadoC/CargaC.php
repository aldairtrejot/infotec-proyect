<?php
include '../librerias.php';
require_once '../../../../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$bool = false;
$message = 'ok';
$fileExel = 'file';

$schema = 'public';
$tableName = $schema . '.masivo_tbl_empleados';
$tableNameEmplo = $schema . '.tbl_empleados_hraes';
$tablePlaza = $schema . '.tbl_control_plazas_hraes';



$masivoEmpleadosM = new MasivoEmpleadosM();

$bool = $masivoEmpleadosM->truncateTable($tableName);

if (isset($_FILES[$fileExel]) && $_FILES[$fileExel]['error'] === UPLOAD_ERR_OK) { ///VALIDACION DE ARCHIVO
    $archivo = $_FILES[$fileExel]['tmp_name']; ///ARCHIVO TEMPORAL

    $spreadsheet = IOFactory::load($archivo); ///MANIPULACION DE ARCHIVO
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $bool = insertTemporaryTable($sheetData, $tableName, $connectionDBsPro) ? true : false; //INSERT IN TEMPORARY TABLE
    if (!$bool)
        exit($bool);

    $bool = processOfCurp($tableName, $masivoEmpleadosM, $tableNameEmplo) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = processValidateIsUnique($masivoEmpleadosM, $tableName, $tableNameEmplo) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validateDataNull($tableName, $masivoEmpleadosM) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validateCharMax($masivoEmpleadosM, $tableName) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validateNumberIsEquals($masivoEmpleadosM, $tableName) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validdateDate($masivoEmpleadosM, $tableName) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validateIsCatalogue($masivoEmpleadosM, $tableName) ? true : false;
    if (!$bool)
        exit($bool);

    $bool = validateNumPlaza($masivoEmpleadosM, $tableName, $tablePlaza) ? true : false;
    if(!$bool)
        exit($bool);

    $bool = validateData($masivoEmpleadosM, $tableName,$tableNameEmplo,$schema) ? true : false;
    if(!$bool)
        exit($bool);
    
}

$var = [
    'bool' => $bool,
    'message' => $message,
];
echo json_encode($var);




//-------------
///ON FUNCTION 

function validateData($masivoEmpleadosM, $tableName,$tableNameEmplo,$schema){
    $isflag_ = false;
    try {
        $isflag_ = $masivoEmpleadosM->validateStatusFinalPlaza($tableName,$tableNameEmplo) ? true : false;
        $isflag_ = $masivoEmpleadosM->validateEstatusDomicilio($schema) ? true : false;
    } catch (\Throwable $th) {
        exit ($isflag_);
    }
    return $isflag_;
}


function validateNumPlaza($masivoEmpleadosM, $tableName, $tablePlaza)
{
    $isFlag_ = false;
    try {
        $isFlag_ = $masivoEmpleadosM->validateIsPlazaNumber($tableName, 'num_plaza', $tablePlaza) ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}

function validateIsCatalogue($masivoEmpleadosM, $tableName)
{
    $isFlag_ = false;
    try {
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'pais_nacimiento', 'cat_pais_nacimiento', 'nombre', 'PAIS NACIMIENTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'estado_nacimiento', 'cat_estado_nacimiento', 'nombre', 'ESTADO NACIMIENTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'estado_civil', 'cat_estado_civil', 'estado_civil', 'E CIVIL') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'contratacion', 'cat_tipo_contratacion_hraes', 'tipo_contratacion', 'TIPO CONTRATACION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'sub_contratacion', 'cat_subtipo_contratacion_hraes', 'subtipo', 'SUP CONTRATACION') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'unidad', 'cat_unidad', 'nombre', 'UNIDAD') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'coordinacion', 'cat_coordinacion', 'nombre', 'COORDINACION') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'codigo_puesto', 'cat_puesto_hraes', 'codigo_puesto', 'COD PUESTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'nivel', 'cat_puesto_hraes', 'nivel', 'NIVEL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'puesto', 'cat_puesto_hraes', 'nombre_posicion', 'NOM PUESTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogueInteger($tableName, 'tabular', 'cat_zona_tabuladores_hraes', 'zona_tabuladores', 'TABULAR') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'nivel_estudio', 'cat_nivel_estudios', 'nivel_estudios', 'NIVEL ESTUDIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'carrera', 'cat_carrera_hraes', 'carrera', 'CARRERA') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'especialidad', 'cat_especialidad_hraes', 'especialidad', 'ESPECIALIDAD') ? true : false;


        $isFlag_ = $masivoEmpleadosM->validateIsCatalogueInteger($tableName, 'quinquenio', 'cat_quinquenio', 'importe', 'QUINQUENIO') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogueInteger($tableName, 'regimen_pensionario', 'cat_valores', 'valor', 'REG PENSIONARIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogueInteger($tableName, 'ahorro_solidario', 'cat_valores', 'valor', 'AHORRO SOL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogueInteger($tableName, 'svi', 'cat_valores', 'valor', 'SVI') ? true : false;

        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'codigo_postal', 'cat_aux_sepomex', 'codigo_postal', 'C POSTAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'codigo_postal_fiscal', 'cat_aux_sepomex', 'codigo_postal', 'CP FISCAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'municipio', 'cat_aux_sepomex', 'municipio', 'MUNICIPIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsCatalogue($tableName, 'colonia', 'cat_aux_sepomex', 'colonia', 'COLONIA') ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}




function validdateDate($masivoEmpleadosM, $tableName)
{
    $isFlag_ = false;
    try {
        $isFlag_ = $masivoEmpleadosM->validateDate($tableName, 'fecha_expedicion', 'FECHA EXPEDICION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateDate($tableName, 'fecha_ingreso_gob_federal', 'FECHA FEDERAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateDate($tableName, 'fecha_ingreso_imss', 'FECHA IMSS') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateDate($tableName, 'vigencia_del', 'VIGENCIA DEL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateDate($tableName, 'vigencia_al', 'VIGENCIA AL') ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}

function validateNumberIsEquals($masivoEmpleadosM, $tableName)
{
    $isFlag_ = false;
    try {
        $isFlag_ = $masivoEmpleadosM->validateIsNumber($tableName, 'num_seguro_social', 'NUM S SOCIAL', 11) ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNumber($tableName, 'num_telefono', 'NUM TELEFONO', 10) ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNumber($tableName, 'num_movil', 'NUM MOVIL', 10) ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}

function processOfCurp($tableName, $masivoEmpleadosM, $tableNameEmplo)
{
    $isFlag_ = false;

    try {
        $isFlag_ = $masivoEmpleadosM->addStatusGeneral($tableName, $tableNameEmplo) ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateCurp($tableName) ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }

    return $isFlag_;
}

function processValidateIsUnique($masivoEmpleadosM, $tableName, $tableNameEmplo)
{
    $isFlag_ = false;

    try {
        $isFlag_ = $masivoEmpleadosM->validateDataIsRequired($tableName, $tableNameEmplo, ($tableName . '.rfc'), ($tableNameEmplo . '.rfc'), 'RFC') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateDataIsRequired($tableName, $tableNameEmplo, ($tableName . '.num_empleado'), ($tableNameEmplo . '.num_empleado'), 'NUM EMPLEADO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateRFC($tableName) ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}



function validateDataNull($tableName, $masivoEmpleadosM)
{ /// _IS_REQUIRED
    $isFlag_ = false;
    try {
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'curp', 'CURP') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'rfc', 'RFC') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'apellido_paterno', 'AP PATERNO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'apellido_materno', 'AP MATERNO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'nombre', 'NOMBRE') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_empleado', 'NUM EMPLEADO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_seguro_social', 'NUM S SOCIAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'estado_civil', 'E CIVIL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'pais_nacimiento', 'PAIS NACIMIENTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'estado_nacimiento', 'ESTADO NACIMIENTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'codigo_postal', 'C POSTAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'codigo_postal_fiscal', 'CP FISCAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'municipio', 'MUNICIPIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'colonia', 'COLONIA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'calle', 'CALLE') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_exterior', 'NUM EXTERIOR') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_interior', 'NUM INTERIOR') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_telefono', 'NUM TELEFONO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_movil', 'NUM MOVIL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'correo_electronico', 'CORREO ELECTRONICO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'cuenta_clabe', 'CUENTA CLABE') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'num_plaza', 'NUM PLAZA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'contratacion', 'TIPO CONTRATACION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'sub_contratacion', 'SUP CONTRATACION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'unidad', 'UNIDAD') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'coordinacion', 'COORDINACION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'codigo_puesto', 'COD PUESTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'puesto', 'NOM PUESTO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'tabular', 'TABULAR') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'nivel', 'NIVEL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'rama', 'RAMA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'nivel_estudio', 'NIVEL ESTUDIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'carrera', 'CARRERA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'cedula_carrera', 'CED CARRERA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'especialidad', 'ESPECIALIDAD') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'cedula_especialidad', 'CED ESPECIALIDAD') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'fecha_expedicion', 'FECHA EXPEDICION') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'fecha_ingreso_gob_federal', 'FECHA FEDERAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'fecha_ingreso_imss', 'FECHA IMSS') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'vigencia_del', 'VIGENCIA DEL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'vigencia_al', 'VIGENCIA AL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'regimen_pensionario', 'REG PENSIONARIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'ahorro_solidario', 'AHORRO SOL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'quinquenio', 'QUINQUENIO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateIsNull($tableName, 'svi', 'SVI') ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}

function validateCharMax($masivoEmpleadosM, $tableName)
{
    $isFlag_ = false;

    try {
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'apellido_paterno', 40, 'AP PATERNO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'apellido_materno', 40, 'AP MATERNO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'nombre', 40, 'NOMBRE') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'num_empleado', 30, 'NUM EMPLEADO') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'num_seguro_social', 11, 'NUM S SOCIAL') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'calle', 100, 'CALLE') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'num_exterior', 20, 'NUM EXTERIOR') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'num_interior', 20, 'NUM INTERIOR') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'cedula_carrera', 40, 'CED CARRERA') ? true : false;
        $isFlag_ = $masivoEmpleadosM->validateChar($tableName, 'cedula_especialidad', 40, 'CED ESPECIALIDAD') ? true : false;
    } catch (\Throwable $th) {
        exit($isFlag_);
    }
    return $isFlag_;
}



function insertTemporaryTable($file, $tableName, $connectionDBsPro)
{
    $bool = false;
    $masivoEmpleadosM = new MasivoEmpleadosM();
    $numero_columnas = count($file[1]);
    $totalFilas = 0;

    if ($numero_columnas == 45) {
        foreach ($file as $row) {
            if ($totalFilas >= 2) {

                $data = [
                    'curp' => trim(pg_escape_string($row['A'])) ? strtoupper(trim(pg_escape_string($row['A']))) : null,
                    'rfc' => trim(pg_escape_string($row['B'])) ? strtoupper(trim(pg_escape_string($row['B']))) : null,
                    'apellido_paterno' => trim(pg_escape_string($row['C'])) ? strtoupper(trim(pg_escape_string($row['C']))) : null,
                    'apellido_materno' => trim(pg_escape_string($row['D'])) ? strtoupper(trim(pg_escape_string($row['D']))) : null,
                    'nombre' => trim(pg_escape_string($row['E'])) ? strtoupper(trim(pg_escape_string($row['E']))) : null,
                    'num_empleado' => trim(pg_escape_string($row['F'])) ? strtoupper(trim(pg_escape_string($row['F']))) : null,
                    'num_seguro_social' => trim(pg_escape_string($row['G'])) ? strtoupper(trim(pg_escape_string($row['G']))) : null,
                    'estado_civil' => trim(pg_escape_string($row['H'])) ? strtoupper(trim(pg_escape_string($row['H']))) : null,
                    'pais_nacimiento' => trim(pg_escape_string($row['I'])) ? strtoupper(trim(pg_escape_string($row['I']))) : null,
                    'estado_nacimiento' => trim(pg_escape_string($row['J'])) ? strtoupper(trim(pg_escape_string($row['J']))) : null,
                    'codigo_postal' => trim(pg_escape_string($row['K'])) ? strtoupper(trim(pg_escape_string($row['K']))) : null,
                    'codigo_postal_fiscal' => trim(pg_escape_string($row['L'])) ? strtoupper(trim(pg_escape_string($row['L']))) : null,
                    'municipio' => trim(pg_escape_string($row['M'])) ? strtoupper(trim(pg_escape_string($row['M']))) : null,
                    'colonia' => trim(pg_escape_string($row['N'])) ? strtoupper(trim(pg_escape_string($row['N']))) : null,
                    'calle' => trim(pg_escape_string($row['O'])) ? strtoupper(trim(pg_escape_string($row['O']))) : null,
                    'num_exterior' => trim(pg_escape_string($row['P'])) ? strtoupper(trim(pg_escape_string($row['P']))) : null,
                    'num_interior' => trim(pg_escape_string($row['Q'])) ? strtoupper(trim(pg_escape_string($row['Q']))) : null,
                    'num_telefono' => trim(pg_escape_string($row['R'])) ? strtoupper(trim(pg_escape_string($row['R']))) : null,
                    'num_movil' => trim(pg_escape_string($row['S'])) ? strtoupper(trim(pg_escape_string($row['S']))) : null,
                    'correo_electronico' => trim(pg_escape_string($row['T'])) ? strtoupper(trim(pg_escape_string($row['T']))) : null,
                    'cuenta_clabe' => trim(pg_escape_string($row['U'])) ? strtoupper(trim(pg_escape_string($row['U']))) : null,
                    'num_plaza' => trim(pg_escape_string($row['V'])) ? strtoupper(trim(pg_escape_string($row['V']))) : null,
                    'contratacion' => trim(pg_escape_string($row['W'])) ? strtoupper(trim(pg_escape_string($row['W']))) : null,
                    'sub_contratacion' => trim(pg_escape_string($row['X'])) ? strtoupper(trim(pg_escape_string($row['X']))) : null,
                    'unidad' => trim(pg_escape_string($row['Y'])) ? strtoupper(trim(pg_escape_string($row['Y']))) : null,
                    'coordinacion' => trim(pg_escape_string($row['Z'])) ? strtoupper(trim(pg_escape_string($row['Z']))) : null,
                    'codigo_puesto' => trim(pg_escape_string($row['AA'])) ? strtoupper(trim(pg_escape_string($row['AA']))) : null,
                    'puesto' => trim(pg_escape_string($row['AB'])) ? strtoupper(trim(pg_escape_string($row['AB']))) : null,
                    'tabular' => trim(pg_escape_string($row['AC'])) ? strtoupper(trim(pg_escape_string($row['AC']))) : null,
                    'nivel' => trim(pg_escape_string($row['AD'])) ? strtoupper(trim(pg_escape_string($row['AD']))) : null,
                    'rama' => trim(pg_escape_string($row['AE'])) ? strtoupper(trim(pg_escape_string($row['AE']))) : null,
                    'nivel_estudio' => trim(pg_escape_string($row['AF'])) ? strtoupper(trim(pg_escape_string($row['AF']))) : null,
                    'carrera' => trim(pg_escape_string($row['AG'])) ? strtoupper(trim(pg_escape_string($row['AG']))) : null,
                    'cedula_carrera' => trim(pg_escape_string($row['AH'])) ? strtoupper(trim(pg_escape_string($row['AH']))) : null,
                    'especialidad' => trim(pg_escape_string($row['AI'])) ? strtoupper(trim(pg_escape_string($row['AI']))) : null,
                    'cedula_especialidad' => trim(pg_escape_string($row['AJ'])) ? strtoupper(trim(pg_escape_string($row['AJ']))) : null,
                    'fecha_expedicion' => trim(pg_escape_string($row['AK'])) ? strtoupper(trim(pg_escape_string($row['AK']))) : null,
                    'fecha_ingreso_gob_federal' => trim(pg_escape_string($row['AL'])) ? strtoupper(trim(pg_escape_string($row['AL']))) : null,
                    'fecha_ingreso_imss' => trim(pg_escape_string($row['AM'])) ? strtoupper(trim(pg_escape_string($row['AM']))) : null,
                    'vigencia_del' => trim(pg_escape_string($row['AN'])) ? strtoupper(trim(pg_escape_string($row['AN']))) : null,
                    'vigencia_al' => trim(pg_escape_string($row['AO'])) ? strtoupper(trim(pg_escape_string($row['AO']))) : null,
                    'regimen_pensionario' => trim(pg_escape_string($row['AP'])) ? strtoupper(trim(pg_escape_string($row['AP']))) : null,
                    'ahorro_solidario' => trim(pg_escape_string($row['AQ'])) ? strtoupper(trim(pg_escape_string($row['AQ']))) : null,
                    'quinquenio' => trim(pg_escape_string($row['AR'])) ? strtoupper(trim(pg_escape_string($row['AR']))) : null,
                    'svi' => trim(pg_escape_string($row['AS'])) ? strtoupper(trim(pg_escape_string($row['AS']))) : null,
                ];

                $bool = $masivoEmpleadosM->addTemporaryTable($connectionDBsPro, $tableName, $data) ? true : false;
                if (!$bool)
                    break;
            }
            $totalFilas++;
        }
    }
    return $bool;
}

