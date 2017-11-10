<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author carlos
 */

include_once 'DataObject.class.php';

class Usuario extends DataObject{
    //put your code here
    
      protected  $data=array(
        "ID"=>"",
        "NOMBRE"=>"",
        "CODZBS"=>"",
        "ABSORVENTES"=>"",
        );
      
      
    public static function autentificar ($username,$password) {

         
        $conn=  parent::connect();
        $sql="SELECT ID,NOMBRE,CODZONA,ABSORVENTES FROM " . TBL_USUARIOS . " WHERE USUARIO=:username
            AND CLAVE=:password AND ACTIVO=1 AND ABSORVENTES>0";

        try{
            $st=$conn->prepare($sql);
            $st->bindValue(":username", $username, PDO::PARAM_STR);
            $st->bindValue(":password", $password, PDO::PARAM_STR);
            $st->execute();
            $row=$st->fetch();
            parent::disconnect($conn);
            if ($row) return new Usuario($row);
        } catch (PDOException $e) {
               parent::disconnect($conn);
               die("Fallo Consulta SQL: " . $e->getMessage());
        }

    }

      
      
      
      
}

?>
