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

    
class Zona extends DataObject{

     protected  $data=array(
        "ID"=>"",
        "NOMBRE"=>"",
       
        );


  

   public static function listadoZonas() {

        $conn=parent::connect();
      $sql="SELECT ID,NOMBRE FROM " . TBL_ZONAS . " WHERE DISTRITO=1 ORDER BY NOMBRE";
         try {
               $st=$conn->prepare($sql);

               $st->execute();
               $zonas=array();
               foreach ($st->fetchAll() as $row) {
                   $zonas[]=new Zona($row);
               }
    
               parent::disconnect($conn);
               return array($zonas);
        } catch (PDOException $e) {

            parent::disconnect($conn);
            die("Query failed: " . $e->getMessage());
        }

     }


}

?>
