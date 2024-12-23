<?php

class MasivoFaltasM
{

    public function truncateTable($tableName)
    {
        $query = pg_query("TRUNCATE TABLE $tableName RESTART IDENTITY;");
        return $query;
    }

    public function insertFaltas($tableName, $fecha_desde, $fecha_hasta, $fecha_registro, $codigo_certificacion, $curp, $observaciones)
    {
        $query = pg_query("INSERT INTO $tableName (fecha_desde, fecha_hasta,fecha_registro,codigo_certificacion,curp,observaciones) 
                           VALUES (UPPER('$fecha_desde'),UPPER('$fecha_hasta'),UPPER('$fecha_registro'),'$codigo_certificacion','$curp','$observaciones')");
        return $query;
    }

    public function updateEstatus($tableName)
    {
        $query = pg_query("UPDATE $tableName
                            SET estatus = 
                                CASE
                                    WHEN observaciones_estatus IS NULL THEN 'AGREGADO'
                                    ELSE 'OMITIDO'
                                END;");
        return $query;
    }

    public function validateDateFaltas($tableName, $columnName, $valueTittle)
    {
        $query = pg_query("UPDATE $tableName
                           SET observaciones_estatus = CASE
                            WHEN TRIM($columnName) IS NULL THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) = '' THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) !~ '^\d{4}-\d{2}-\d{2}$' THEN 'CAMPO $valueTittle NO TIENE EL FORMATO CORRECTO (AAAA-MM-DD)'
                            ELSE observaciones_estatus
                            END;");
        return $query;
    }

    public function validateMaxFaltas($tableName, $columnName, $valueTittle, $maxChar)
    {
        $query = pg_query("UPDATE $tableName
                           SET observaciones_estatus = CASE
                            WHEN TRIM($columnName) IS NULL THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) = '' THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN LENGTH($columnName) > $maxChar THEN 'CAMPO $valueTittle DEBE DE TENER UN MAXIMO DE $maxChar CARACTERES'
                            ELSE observaciones_estatus
                            END");
        return $query;
    }

    public function validateEmployeCurp($tableName)
    {
        $query = pg_query("UPDATE $tableName
                            SET observaciones_estatus = 
                                CASE
                                    WHEN NOT EXISTS (
                                        SELECT 1
                                        FROM tbl_empleados_hraes
                                        WHERE tbl_empleados_hraes.curp = masivo_ctrl_faltas_hraes.curp
                                    ) THEN 'CAMPO CURP NO CORRESPONDE A NINGUN EMPLEADO REGISTRADO'
                                ELSE observaciones_estatus
                            END;");
        return $query;
    }

    public function insertFaltasInCtrl($tableName, $tableTempFalta, $tableEmploye)
    {
        $query = pg_query("INSERT INTO $tableName (
                                    fecha_desde, 
                                    fecha_hasta, 
                                    fecha_registro, 
                                    codigo_certificacion, 
                                    observaciones, 
                                    id_tbl_empleados_hraes)
                            SELECT TO_DATE(table_.fecha_desde, 'YYYY-MM-DD'), 
                                TO_DATE(table_.fecha_hasta, 'YYYY-MM-DD'), 
                                TO_DATE(table_.fecha_registro, 'YYYY-MM-DD'), 
                                table_.codigo_certificacion, 
                                table_.observaciones,
                                (
                                    SELECT table_employe_.id_tbl_empleados_hraes
                                    FROM $tableEmploye AS table_employe_
                                    WHERE table_employe_.curp = table_.curp
                                )
                            FROM $tableTempFalta AS table_
                            WHERE table_.estatus = 'AGREGADO';");
        return $query;
    }

    public function getTempFalta(){
        $query =            ("SELECT 
                                curp, fecha_desde, fecha_hasta, fecha_registro, codigo_certificacion,
                                observaciones, estatus, observaciones_estatus
                            FROM masivo_ctrl_faltas_hraes
                            ORDER BY id_masivo_ctrl_faltas_hraes ASC");
        return $query;
    }
}


