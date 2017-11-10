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

class Titular extends DataObject{
    //put your code here
    
    /*
    .ID,NSS,TARSANITARIA,TITULAR.NOMBRE," .
       "convert(char,FNACIMIENTO,103) AS NACIMIENTO," .
       "CONVERT(CHAR,FALTA,103) AS FALTA,TLF,MOVIL1," .
       "DOMICILIO,LOCALIDAD,CP,TA,OBS,TITULAR.DISTRITO,ESTADO,SEXO," .
       "DNI,ZONABAS,PROVINCIA,ZONAS.NOMBRE AS NOMBREZONA,PAIS " .
       "FROM " . TBL_TITULAR . " LEFT JOIN ZONAS ON TITULAR.ZONABAS=ZONAS.ID");
   */ 
    
      protected  $data=array(
        "ID"=>"",
        "NSS"=>"",  
        "TARSANITARIA" =>"",  
        "NOMBRE"=>"",  
        "FNACIMIENTO"=>"",
        "FALTA"=>"",  
        "TLF"=>"",
        "MOVIL1"=>"",
        "MOVIL2"=>"",  
        "DOMICILIO"=>"",
        "LOCALIDAD"=>"",  
        "CP"=>"",
        "TA"=>"",     
        "DNI"=>"",
        "ZONABAS"=>"",
        "PROVINCIA"=>"",
        "NOMBREZONA"=>"", 
        "SEXO"=>"",
        "MUNICIPIO"=>"",
        "PAIS"=>"",  
      
        );
          
      
  public static function getTitularNusha($nss) {

        $conn=parent::connect();
        $sql=SQL_BUSCAPACIENTE_NUSHA;

        try {
                $st=$conn->prepare($sql);
                $st->bindValue(":nss",$nss,PDO::PARAM_STR);
                $st->execute();
                $titulares=array();
               foreach ($st->fetchAll() as $row) {
                   $titulares[]=new Titular($row);
               }
            
               parent::disconnect($conn);
               return array($titulares);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }

        }
 
    
  public static function getTitularNombre($nombre) {

        $conn=parent::connect();
        $sql=SQL_BUSCAPACIENTE_NOMBRE;
      
    /*    $sql="SELECT TITULAR.ID,NSS,TARSANITARIA,TITULAR.NOMBRE,FNACIMIENTO," .
            "FALTA,TLF,MOVIL1,MOVIL2," .
            "DOMICILIO,LOCALIDAD,CP,TA," .
            "DNI,ZONABAS,PROVINCIA,ZONAS.NOMBRE AS NOMBREZONA " .
            "FROM TITULAR LEFT JOIN ZONAS ON TITULAR.ZONABAS=ZONAS.ID " .
            "WHERE TITULAR.NOMBRE LIKE :nombre";     ;
        */
    
    
        try {
                $st=$conn->prepare($sql);
                
                $cadena='%'.trim($nombre).'%';
                //$q->execute(array($cadena));
                $st->bindValue(":nombre",$cadena, PDO::PARAM_STR);
              
                $st->execute();
                $titulares=array();
                
               foreach ($st->fetchAll() as $row) {
                   $titulares[]=new Titular($row);
               }
            
               parent::disconnect($conn);
               return array($titulares);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }

        }
    
        
 public static function getTitular($id) {

        $conn=parent::connect();
        $sql=SQL_BUSCAPACIENTE_ID;

        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":id",$id,PDO::PARAM_INT);
            $st->execute();
            $row=$st->fetch();
            parent::disconnect($conn);
            if ($row) return new Titular($row);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die("Query Failed :" . $e->getMessage());
        }

    }   
 
 public function  nuevo_Titular() {

        $conn=parent::connect();
        $sql=SQL_INSERTATITULAR;
           
        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":nss",$this->data["NSS"], PDO::PARAM_INT);
            $st->bindValue(":dni", $this->data["DNI"],PDO::PARAM_STR);
            $st->bindValue(":nombre", $this->data["NOMBRE"],PDO::PARAM_STR);
            $st->bindValue(":fnacimiento", $this->data["FNACIMIENTO"],PDO::PARAM_STR); 
            $st->bindValue(":falta", $this->data["FALTA"],PDO::PARAM_STR); 
            $st->bindValue(":domicilio", $this->data["DOMICILIO"],PDO::PARAM_STR);
            $st->bindValue(":localidad", $this->data["LOCALIDAD"],PDO::PARAM_STR);
            $st->bindValue(":provincia", $this->data["PROVINCIA"],PDO::PARAM_STR); 
            $st->bindValue(":cp", $this->data["CP"],PDO::PARAM_STR);
            $st->bindValue(":ta", $this->data["TA"],PDO::PARAM_STR); 
            $st->bindValue(":zonabas", $this->data["ZONABAS"],PDO::PARAM_STR); 
            $st->bindValue(":tarsanitaria",$this->data["TARSANITARIA"],PDO::PARAM_INT);
            $st->bindValue(":tlf", $this->data["TLF"],PDO::PARAM_STR); 
            $st->bindValue(":movil1", $this->data["MOVIL1"],PDO::PARAM_STR);
            $st->bindValue(":movil2", $this->data["MOVIL2"],PDO::PARAM_STR);
            $st->bindValue(":sexo", $this->data["SEXO"],PDO::PARAM_INT); 
            $st->bindValue(":municipio", $this->data["MUNICIPIO"],PDO::PARAM_STR);
            $st->bindValue(":pais", $this->data["PAIS"],PDO::PARAM_STR);
     

            $st->execute();
            parent::disconnect($conn);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die ("Query failed: " . $e->getMessage());

        }

    }       
 
    
  public function modifica_nusha(){
      
      $conn=parent::connect();
        $sql=SQL_MODIFICA_NUSHA;
           
        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":ID",$this->data["ID"], PDO::PARAM_INT);
            $st->bindValue(":NSS",$this->data["NSS"], PDO::PARAM_INT);
       

            $st->execute();
            parent::disconnect($conn);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die ("Query failed: " . $e->getMessage());

        }

      
      
  }  
         
}

?>
