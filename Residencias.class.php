<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
   
/**
 * Description of Zonas
 *
 * @author carlos
 */
include_once 'DataObject.class.php';

    
class Residencias extends DataObject{

     protected  $data=array(
        "COD"=>"",
        "NOMBRE"=>"",
        "DIRECCION"=>"",
        "CLAVE"=>"",
        "UGC"=>"",
        "LOCALIDAD"=>"", 
       
        );


  

   public static function listadoResidencias() {

      $conn=parent::connect();
      $sql=SQL_LISTARESIDENCIAS;
         try {
               $st=$conn->prepare($sql);

               $st->execute();
               $listaresidencias=array();
               foreach ($st->fetchAll() as $row) {
                   $listaresidencias[]=new Residencias($row);
               }
    
               parent::disconnect($conn);
               return array($listaresidencias);
        } catch (PDOException $e) {

            parent::disconnect($conn);
            die("Query failed: " . $e->getMessage());
        }

     }

 
}

?>
