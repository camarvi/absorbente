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

    
class TipoAbsorbente extends DataObject{

     protected  $data=array(
        "COD"=>"",
        "ABSORBENTE"=>"",
       
        );


  

   public static function listadoAbsorbentes() {

      $conn=parent::connect();
      $sql=SQL_LISTA_ABSORBENTES;
         try {
               $st=$conn->prepare($sql);

               $st->execute();
               $listaabs=array();
               foreach ($st->fetchAll() as $row) {
                   $listaabs[]=new TipoAbsorbente($row);
               }
    
               parent::disconnect($conn);
               return array($listaabs);
        } catch (PDOException $e) {

            parent::disconnect($conn);
            die("Query failed: " . $e->getMessage());
        }

     }


 
        
     
     
     
}

?>
