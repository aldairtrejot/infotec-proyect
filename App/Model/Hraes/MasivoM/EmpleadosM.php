<?php

class MasivoEmpleadosM
{

    public function addTemporaryTable($conection, $tableName, $data)
    {
        $pg_add = pg_insert($conection, $tableName, $data);
        return $pg_add;
    }

    public function truncateTable($tableName)
    {
        $query = pg_query("TRUNCATE TABLE $tableName RESTART IDENTITY;");
        return $query;
    }

    public function addStatusGeneral($tableName, $tableNameEmployee)
    {
        $query = pg_query("UPDATE $tableName
                            SET estatus  = CASE
                                WHEN EXISTS (
                                    SELECT 1
                                    FROM $tableNameEmployee
                                    WHERE $tableName.curp = 
                                        $tableNameEmployee.curp
                                )
                                THEN 'MODIFICAR'
                                ELSE 'AGREGAR'
                            END;");
        return $query;
    }

    public function validateDataIsRequired($tableName, $tableAuxName, $valueTable, $valueTableAux, $IsText)
    {
        $query_ = pg_query("UPDATE $tableName
                            SET observaciones = observaciones ||
                                CASE 
                                    WHEN EXISTS (
                                        SELECT 1
                                        FROM $tableAuxName 
                                        WHERE $valueTableAux = $valueTable
                                    )
                                    THEN ' { $IsText :YA EXISTE }, '
                                    ELSE ''
                                END;");
        return $query_;
    }
    public function validateCurp($tableName)
    {
        $query = pg_query("UPDATE $tableName
                           SET  observaciones = 
                                    CASE
                                        WHEN curp ~ '^[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[A-Z0-9][0-9]$' THEN ''
                                        ELSE ' {CURP:NO VALIDO}, '
                                    END;");
        return $query;
    }

    public function validateRFC($tableName)
    {
        $query = pg_query("UPDATE $tableName
                            SET  observaciones = observaciones || 
                                    CASE
                                        WHEN rfc ~ '^([A-ZÑ&]{4}[A-Z0-9]{6}[A-Z0-9]{3}|[A-ZÑ&]{3}[0-9]{6}[A-Z0-9]{3})$' THEN ''
                                        WHEN rfc = 'X' THEN ''
                                        ELSE ' {RFC:NO VALIDO}, '
                                    END;");
        return $query;
    }

    public function validateChar($tableName, $columnName, $maxValue, $text)
    {
        $query = pg_query("UPDATE $tableName
                            SET observaciones = observaciones || 
                                    CASE
                                        WHEN LENGTH($columnName) <= $maxValue THEN ''
                                        WHEN $columnName = 'X' THEN ''
                                        ELSE ' { $text :MAX $maxValue CHAR}, '
                                    END;");
        return $query;
    }

    public function validateIsNumber($tableName, $columnName, $text, $isEquals)
    {
        $query = pg_query("UPDATE $tableName
                            SET observaciones = observaciones ||  CASE 
                                WHEN length($columnName) = $isEquals AND $columnName ~ '^[0-9]+$' THEN ''
                                WHEN $columnName = 'X' THEN ''
                                ELSE ' { $text :NO VALIDO},'
                            END;");
        return $query;
    }

    public function validateDate($tableName, $columnName, $text)
    {
        $query = pg_query("UPDATE $tableName
                            SET observaciones = observaciones ||  CASE 
                                WHEN $columnName ~ '^\d{4}-\d{2}-\d{2}$' THEN ''
                                WHEN $columnName ~ '^\d{4}/\d{2}/\d{2}$' THEN ''
                                WHEN $columnName = 'X' THEN ''
                                ELSE ' { $text :FORMATO REQUERIDO(AAAA-MM-DD)},'
                            END;");
        return $query;
    }
    public function validateIsNull($tableName, $columnName, $text) ///IS REQUIRED
    {
        $query = pg_query("UPDATE $tableName    
                           SET observaciones = observaciones ||
                                CASE 
                                    WHEN TRIM($columnName) IS NOT NULL THEN ''
                                    ELSE ' { $text :CAMPO REQUERIDO},'
                                END;");
        return $query;
    }

    public function validateIsCatalogue($tableName, $columnName, $tableCat, $isValue, $isText)
    {
        $isValueComparate = $tableName . '.' . $columnName;

        $query = pg_query("UPDATE $tableName 
                            SET observaciones = observaciones ||
                                CASE 
                                    WHEN EXISTS (
                                        SELECT DISTINCT(1)
                                        FROM $tableCat
                                        WHERE UPPER(TRIM(UNACCENT($isValueComparate))) = UPPER(TRIM(UNACCENT($isValue))) 
                                    ) OR $isValueComparate = 'X' THEN ''
                                    ELSE ' { $isText : NO ENCONTRADO EN CATALOGO }, '
                                END;");
        return $query;
    }

    public function validateIsCatalogueInteger($tableName, $columnName, $tableCat, $isValue, $isText)
    {
        $isValueComparate = $tableName . '.' . $columnName;

        $query = pg_query("UPDATE $tableName 
                            SET observaciones = observaciones ||
                            CASE
                                WHEN length($isValueComparate) > 0 AND $isValueComparate != translate($isValueComparate, '0123456789', '') THEN (
                                    CASE 
                                    WHEN EXISTS (
                                        SELECT DISTINCT(1)
                                        FROM $tableCat
                                        WHERE $isValueComparate::INTEGER = $isValue::INTEGER
                                    ) OR $isValueComparate = 'X' THEN ''
                                    ELSE ' { $isText : NO ENCONTRADO EN CATALOGO }, '
                                END
                                )  
                                WHEN $isValueComparate = 'X' THEN '' 
                                ELSE ' { $isText : NO ENCONTRADO EN CATALOGO }, '
                            END;");
        return $query;
    }

    public function validateIsPlazaNumber($tableName, $columnName, $tableCat)
    {
        $isValueComparate = $tableName . '.' . $columnName;
        $isValue = $tableCat . '.num_plaza';

        $query = pg_query("UPDATE $tableName 
                            SET observaciones = observaciones ||
                                CASE 
                                    WHEN EXISTS (
                                        SELECT 1
                                        FROM $tableCat
                                        WHERE $isValueComparate = $isValue 
                                        AND id_cat_tipo_plazas = 5
                                    ) OR $isValueComparate = 'X' THEN ''
                                    ELSE ' { NUM PLAZA: NO ESTA VACANTE O NO EXISTE}, '
                                END;");
        return $query;
    }

    public function validateStatusFinalPlaza($tableName, $tableEmployee){
        $query = pg_query("UPDATE $tableName 
                            SET estatus = -- ADD STATUS FINALLY
                            CASE 
                                WHEN (
                                        $tableName.observaciones LIKE '%RFC%' OR 
                                        $tableName.observaciones LIKE '%CURP%' OR 
                                        $tableName.observaciones LIKE '%NOMBRE%' OR 
                                        $tableName.observaciones LIKE '%AP PATERNO%' OR 
                                        $tableName.observaciones LIKE '%AP MATERNO%' OR 
                                        $tableName.observaciones LIKE '%NUM S SOCIAL%' OR 
                                        $tableName.observaciones LIKE '%NUM EMPLEADO%' OR 
                                        $tableName.observaciones LIKE '%E CIVIL%' OR 
                                        $tableName.observaciones LIKE '%PAIS NACIMIENTO%' OR 
                                        $tableName.observaciones LIKE '%ESTADO NACIMIENTO%'
                                    ) THEN '{EMPLEADO:OMITIDO}'
                                ELSE (
                                --	--	--	IN SECON CONDITIO
                                    CASE
                                                            WHEN EXISTS (
                                                                SELECT 1
                                                                FROM $tableEmployee
                                                                WHERE $tableName.curp = 
                                                                    $tableEmployee.curp
                                                            )
                                                            THEN '{EMPLEADO:MODIFICADO}'
                                                            ELSE (
                                                            ---	---	--	INIT CONDITION
                                                                CASE 
                                                                    WHEN (
                                                                        $tableName.curp = 'X' OR 
                                                                        $tableName.rfc = 'X' OR 
                                                                        $tableName.apellido_paterno = 'X' OR 
                                                                        $tableName.apellido_materno = 'X' OR 
                                                                        $tableName.nombre = 'X' OR
                                                                        $tableName.num_empleado = 'X' OR
                                                                        $tableName.estado_civil = 'X' OR 
                                                                        $tableName.pais_nacimiento = 'X' OR 
                                                                        $tableName.estado_nacimiento = 'X' 
                                                                    ) THEN '{EMPLEADO:OMITIDO-X}'
                                                                    ELSE '{EMPLEADO:AGREGADO}'
                                                                END
                                                            --- --- --  FINALLY CONDITION
                                                            )
                                                        END
                                --	--	-- FINALLY 
                                )
                            END;");
        return $query;
    }

    public function validateEstatusDomicilio($isSchema){
        $query = pg_query("UPDATE $isSchema.masivo_tbl_empleados 
                            SET estatus = estatus ||
                                CASE 
                                    WHEN (
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%C POSTAL%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%CP FISCAL%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%MUNICIPIO%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%COLONIA%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%CALLE%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%NUM EXTERIOR%' OR 
                                        $isSchema.masivo_tbl_empleados.observaciones LIKE '%NUM INTERIOR%' 
                                    ) THEN ', {DOMICILIO:OMITIDO}'
                                    ELSE (
                                        CASE 
                                            WHEN EXISTS (
                                                SELECT 1
                                                FROM $isSchema.tbl_domicilios_hraes
                                                INNER JOIN $isSchema.tbl_empleados_hraes ON 
                                                    $isSchema.tbl_domicilios_hraes.id_tbl_empleados_hraes = $isSchema.tbl_empleados_hraes.id_tbl_empleados_hraes
                                                WHERE $isSchema.tbl_empleados_hraes.curp = $isSchema.masivo_tbl_empleados.curp
                                            ) THEN ', {DOMICILIIO:MODIFICADO}'
                                            ELSE (
                                                CASE 
                                                    WHEN (
                                                        $isSchema.masivo_tbl_empleados.codigo_postal = 'X' OR 
                                                        $isSchema.masivo_tbl_empleados.codigo_postal_fiscal = 'X' OR 
                                                        $isSchema.masivo_tbl_empleados.municipio = 'X' OR 
                                                        $isSchema.masivo_tbl_empleados.colonia = 'X' OR 
                                                        $isSchema.masivo_tbl_empleados.calle = 'X' OR
                                                        $isSchema.masivo_tbl_empleados.num_exterior = 'X' 
                                                    ) THEN ', {DOMICILIO:OMITIDO-X}'
                                                    ELSE (
                                                        CASE 
                                                            WHEN substring(estatus FROM 'EMPLEADO ([^\s]+)') = 'OMITIDO' THEN ', {DOMICILIO:OMITIDO-E}'
                                                            ELSE ', {DOMICILIO:AGREGADO}'
                                                        END
                                                        )
                                                    END
                                                )
                                            END
                                        )
                                    END;");
        return $query;
    }
}