<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sexo
 *
 * @author carlos
 */

session_start();

require_once 'DataObject.class.php';


class Provincia extends DataObject{
    //put your code here

    
      protected  $data=array(
        "ID"=>"",
        "PROVINCIA"=>"",
        
     );
    
      
     public static function getListaProvincias() {

        $conn=parent::connect();
        $sql=SQL_LISTAPROVINCIAS;
          
        try {
            $st=$conn->prepare($sql);
         
            $st->execute();
             $provincias=array();
               foreach ($st->fetchAll() as $row) {
                   $provincias[]=new Provincia($row);
               }
         
               parent::disconnect($conn);
               return array($provincias);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }     
     
    }   
      
      
    
}

?>
