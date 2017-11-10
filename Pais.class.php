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


class Pais extends DataObject{
    //put your code here

    
      protected  $data=array(
        "ID"=>"",
        "PAIS"=>"",
        
     );
    
      
     public static function getListaPaises() {

        $conn=parent::connect();
        $sql=SQL_LISTAPAIS;
          
        try {
            $st=$conn->prepare($sql);
         
            $st->execute();
             $paises=array();
               foreach ($st->fetchAll() as $row) {
                   $paises[]=new Pais($row);
               }
         
               parent::disconnect($conn);
               return array($paises);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }     
     
    }   
      
      
    
}

?>
