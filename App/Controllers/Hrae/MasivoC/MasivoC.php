<?php

class MasivoC{

    public function truncateTable($tableName){
        $query = pg_query("TRUNCATE TABLE $tableName RESTART IDENTITY;");
        return $query;
    }

    public function insertFaltas($tableName,$fecha_desde,$fecha_hasta,$fecha_registro,$codigo_certificacion,$curp,$observaciones){
        $query = pg_query("INSERT INTO $tableName (fecha_desde, fecha_hasta,fecha_registro,codigo_certificacion,curp,observaciones) 
                           VALUES (UPPER('$fecha_desde'),UPPER('$fecha_hasta'),UPPER('$fecha_registro'),'$codigo_certificacion','$curp','$observaciones')");
        return $query;
    }

    public function updateEstatus($tableName){
        $query = pg_query ("UPDATE $tableName
                            SET estatus = 
                                CASE
                                    WHEN observaciones_estatus IS NULL THEN 'AGREGADO'
                                    ELSE 'OMITIDO'
                                END;");
        return $query;
    }

    public function validateDateFaltas($tableName,$columnName, $valueTittle){
        $query = pg_query("UPDATE $tableName
                           SET observaciones_estatus = CASE
                            WHEN TRIM($columnName) IS NULL THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) = '' THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) !~ '^\d{4}-\d{2}-\d{2}$' THEN 'CAMPO $valueTittle NO TIENE EL FORMATO CORRECTO (AAAA-MM-DD)'
                            ELSE observaciones_estatus
                            END;");
        return $query;  
    }

    public function validateMaxFaltas($tableName, $columnName, $valueTittle, $maxChar){
        $query = pg_query("UPDATE $tableName
                           SET observaciones_estatus = CASE
                            WHEN TRIM($columnName) IS NULL THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN TRIM($columnName) = '' THEN 'CAMPO $valueTittle NO PUEDE ESTAR VACIO'
                            WHEN LENGTH($columnName) > $maxChar THEN 'CAMPO $valueTittle DEBE DE TENER UN MAXIMO DE $maxChar CARACTERES'
                            ELSE observaciones_estatus
                            END");
        return $query;
    }

    public function validateEmployeCurp($tableName){
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

}


/*

TRUNCATE TABLE ctrl_faltas_hraes RESTART IDENTITY;
*/

SELECT * FROM public.ctrl_faltas_hraes
ORDER BY id_ctrl_faltas_hraes ASC 

UPDATE masivo_ctrl_faltas_hraes
SET observaciones_estatus = 
	CASE
    	WHEN NOT EXISTS (
            SELECT 1
            FROM tbl_empleados_hraes
            WHERE tbl_empleados_hraes.curp = masivo_ctrl_faltas_hraes.curp
        ) THEN 'CAMPO CURP NO CORRESPONDE A NINGUN EMPLEADO REGISTRADO'
    ELSE observaciones_estatus
END;

INSERT INTO ctrl_faltas_hraes (fecha_desde, fecha_hasta, fecha_registro, codigo_certificacion, observaciones, id_tbl_empleados_hraes)
SELECT TO_DATE(a.fecha_desde, 'YYYY-MM-DD'), TO_DATE(a.fecha_hasta, 'YYYY-MM-DD'), TO_DATE(a.fecha_registro, 'YYYY-MM-DD'), a.codigo_certificacion, a.observaciones,
	(
		SELECT id_tbl_empleados_hraes
		FROM tbl_empleados_hraes
		WHERE tbl_empleados_hraes.curp = a.curp
	)
FROM masivo_ctrl_faltas_hraes AS a
WHERE a.estatus = 'AGREGADO';

SELECT * FROM public.masivo_ctrl_faltas_hraes
ORDER BY id_masivo_ctrl_faltas_hraes ASC; 


/*
UPDATE masivo_ctrl_faltas_hraes
                           SET observaciones_estatus = CASE
                            WHEN fecha_registro IS NULL THEN 'CAMPO $fecha_registro NO PUEDE ESTAR VACIO'
							WHEN fecha_registro = '' THEN 'CAMPO $fecha_registro NO PUEDE ESTAR VACIO'
                            WHEN fecha_registro !~ '^\d{4}-\d{2}-\d{2}$' THEN 'CAMPO $fecha_registro NO TIENE EL FORMATO CORRECTO (AAAA-MM-DD)'
                            ELSE 'OK'
                            END;
							
							
							SELECT * FROM public.masivo_ctrl_faltas_hraes
ORDER BY id_masivo_ctrl_faltas_hraes ASC; 
			 
			 */