<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sexo1
 *
 * @author carlos
 */
   

session_start();

require_once 'DataObject.class.php';

class Sexo extends DataObject{
    //put your code here
    
    
      protected  $data=array(
        "ID"=>"",
        "SEXO"=>"",
        
     );
      
      public static function getListaSexo() {

        $conn=parent::connect();
        $sql=SQL_LISTASEXO;  
             
        try {
            $st=$conn->prepare($sql);
         
            $st->execute();
             $sexo=array();
               foreach ($st->fetchAll() as $row) {
                   $sexo[]=new Sexo($row);
               }
         
               parent::disconnect($conn);
               return array($sexo);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }     
     
    }   
         
      
      
      
      
      
      
}

?>
