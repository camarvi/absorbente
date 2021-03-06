<?php
/* 
 * DEFINO LAS CONSTANTES QUE UTILIZO EN EL PROGRAMA
 */

//Define datos conexion BD DISTRITO Entorno Linux
define("DB_DSN","dblib:host=.......;dbname=xxxxxx");



define("DB_USERNAME", "xxx");
define("DB_PASSWORD", "xxxxxx");
define("PAGE_SIZE", 5);



//Definicion Tablas BD

define("TBL_USUARIOS","USUARIOS");
define("TBL_TITULAR","TITULAR");
define("TBL_SEXO","SEXO");
define("TBL_ZONAS","ZONAS");
define("TBL_ABSORBENTES","TIPO_ABSORBENTES");
define("TBL_RESIDENCIAS","RESIDENCIAS");
define("TBL_RESIDENCIA_TITULARES","RESIDENCIA_TITULARES");


define( "ROOT", $_SERVER['HTTP_HOST']);
define("RAIZ", "http://" . $_SERVER['HTTP_HOST'] );

//consultas sql

//CONSULTA RESIDENCIAS

define("SQL_LISTARESIDENCIAS","SELECT COD,NOMBRE,DIRECCION,CLAVE,UGC,LOCALIDAD FROM ". TBL_RESIDENCIAS . " 
    ORDER BY NOMBRE");


define("SQL_TITULAR_RESIDENCIA","SELECT RESIDENCIA_TITULARES.COD,RESIDENCIAS.COD as CODRES,RESIDENCIAS.NOMBRE AS NOMRES,
    TITULAR.ID AS CODTITULAR,TITULAR.NSS,TITULAR.DNI,TITULAR.NOMBRE,TITULAR.FNACIMIENTO,
    RESIDENCIA_TITULARES.FECHA,DIA,NOCHE_MED,NOCHE_GRAN,SUPERNOCHE_MED,SUPERNOCHE_GRAN,SUPERNOCHE_EXT_GRAN  
    FROM " . TBL_TITULAR . "," . TBL_RESIDENCIAS . "," 
        . TBL_RESIDENCIA_TITULARES . " WHERE RESIDENCIAS.COD=RESIDENCIA_TITULARES.RESIDENCIA 
            AND RESIDENCIA_TITULARES.TITULAR=TITULAR.ID AND TITULAR.ID=:codtitular" );

define("SQL_TITULARES_RESIDENCIA","SELECT RESIDENCIA_TITULARES.COD,RESIDENCIAS.COD as CODRES,RESIDENCIAS.NOMBRE AS NOMRES,
    TITULAR.ID AS CODTITULAR,TITULAR.NSS,TITULAR.DNI,TITULAR.NOMBRE,TITULAR.FNACIMIENTO,
    RESIDENCIA_TITULARES.FECHA,DIA,NOCHE_MED,NOCHE_GRAN,SUPERNOCHE_MED,SUPERNOCHE_GRAN,SUPERNOCHE_EXT_GRAN  
    FROM " . TBL_TITULAR . "," . TBL_RESIDENCIAS . "," 
        . TBL_RESIDENCIA_TITULARES . " WHERE RESIDENCIAS.COD=RESIDENCIA_TITULARES.RESIDENCIA 
            AND RESIDENCIA_TITULARES.TITULAR=TITULAR.ID AND RESIDENCIAS.COD=:codresidencia 
            ORDER BY TITULAR.NOMBRE" );

define("SQL_MODIFICA_ABS_PACIENTE","UPDATE " . TBL_RESIDENCIA_TITULARES . " SET DIA=:dia,NOCHE_MED=:noche_med,
    NOCHE_GRAN=:noche_gran,SUPERNOCHE_MED=:supernoche_med,SUPERNOCHE_GRAN=:supernoche_gran,
    SUPERNOCHE_EXT_GRAN=:supernoche_ext_gran WHERE COD=:cod");


define("SQL_ELIMINA_PACIENTE_RESIDENCIA","DELETE FROM " . TBL_RESIDENCIA_TITULARES . " WHERE COD=:cod");


define("SQL_NUEVO_PACIENTERESIDENCIA","INSERT INTO " . TBL_RESIDENCIA_TITULARES . " (RESIDENCIA,TITULAR,FECHA,
    DIA,NOCHE_MED,NOCHE_GRAN,SUPERNOCHE_MED,SUPERNOCHE_GRAN,SUPERNOCHE_EXT_GRAN) 
    VALUES (:residencia,:paciente,:fecha,:dia,:noche_med,:noche_gran,:supernoche_med,:supernoche_gran,:supernoche_ext_gran)");
//CONSULTAS ABSORBENTES

define("SQL_LISTA_ABSORBENTES","SELECT COD,ABSORBENTE FROM ". TBL_ABSORBENTES . " ORDER BY ABSORBENTE");


//
  
      
    


define("SQL_BUSCAPACIENTE","SELECT TITULAR.ID,NSS,TARSANITARIA,TITULAR.NOMBRE," .
        "convert(char,FNACIMIENTO,103) as FNACIMIENTO," .
            "convert(char,FALTA,103) as FALTA,TLF,MOVIL1,MOVIL2," .
            "DOMICILIO,LOCALIDAD,CP,TA," .
            "DNI,ZONABAS,PROVINCIA,ZONAS.NOMBRE AS NOMBREZONA,SEXO,MUNICIPIO,PAIS " .
            "FROM " . TBL_TITULAR . " LEFT JOIN ZONAS ON TITULAR.ZONABAS=ZONAS.ID ");


define("SQL_BUSCAPACIENTE_NUSHA", SQL_BUSCAPACIENTE . " WHERE NSS=UPPER(:nss)");


define("SQL_BUSCAPACIENTE_NOMBRE",SQL_BUSCAPACIENTE . " WHERE TITULAR.NOMBRE LIKE :nombre " .
                "ORDER BY TITULAR.NOMBRE");


define("SQL_BUSCAPACIENTE_ID", SQL_BUSCAPACIENTE . " WHERE TITULAR.ID=:id");


define("SQL_INSERTATITULAR", "INSERT INTO TITULAR (NSS,DNI,NOMBRE,FNACIMIENTO,FALTA,DOMICILIO," .
              "LOCALIDAD,PROVINCIA,CP,TA,OBS,ZONABAS,TARSANITARIA,TLF,MOVIL1,MOVIL2,
               SEXO,MUNICIPIO,PAIS,DISTRITO,ESTADO) " .
              "VALUES (:nss,:dni,:nombre,:fnacimiento,:falta,:domicilio,:localidad," .
              ":provincia,:cp,:ta,'',:zonabas,:tarsanitaria,:tlf,:movil1,:movil2,
                :sexo,:municipio,:pais,1,1)");


define("SQL_MODIFICATITULAR","UPDATE TITULAR SET NSS=:nss,DNI=:dni,FNACIMIENTO=:fnacimiento," .
            "DOMICILIO=:domicilio,LOCALIDAD=:localidad,PROVINCIA=:provincia," 
             . "CP=:cp,OBS=:obs,ZONABAS=:zonabas,TARSANITARIA=:tarsanitaria," .
               "TLF=:tlf,MOVIL1=:movil1,MOVIL2=:movil2,DISTRITO=1,SEXO=:sexo,PAIS=:pais WHERE ID=:id");


define("SQL_MODIFICA_NUSHA","UPDATE TITULAR SET NSS=:NSS,TARSANITARIA=:NSS " .
               "WHERE ID=:ID");

        

define("SQL_LISTACENTROS", "SELECT ID,NOMBRE FROM ZONAS WHERE DISTRITO=1");

define("SQL_LISTASEXO","SELECT ID,SEXO FROM SEXO");

define("SQL_LISTAPROVINCIAS", "SELECT ID,PROVINCIA FROM PROVINCIA ORDER BY PROVINCIA");

define("SQL_LISTAPAIS","SELECT ID,PAIS FROM PAIS ORDER BY PAIS");





?>
