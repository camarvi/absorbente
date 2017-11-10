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

    
class Residencia_Titulares extends DataObject{

     protected  $data=array(
        "COD"=>"",
        "CODRES"=>"",
        "NOMRES"=>"",
        "CODTITULAR"=>"",
        "NSS"=>"", 
        "DNI"=>"",
        "NOMBRE"=>"",
        "FNACIMIENTO"=>"",
        "FECHA"=>"", 
        "DIA"=>"",
        "NOCHE_MED"=>"",
        "NOCHE_GRAN"=>"",
        "SUPERNOCHE_MED"=>"",
        "SUPERNOCHE_GRAN"=>"", 
        "SUPERNOCHE_EXT_GRAN"=>"", 
         
        );
  
     
     
 public static function TitularResidencia($titular) {
     
     $conn=parent::connect();
     $sql=SQL_TITULAR_RESIDENCIA;

        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":codtitular",$titular,PDO::PARAM_INT);
            $st->execute();
            $row=$st->fetch();
            parent::disconnect($conn);
            if ($row) return new Residencia_Titulares($row);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die("Query Failed :" . $e->getMessage());
        }
    
     
 }   
     

  public static function TitularesResidencia($id) {

      $conn=parent::connect();
      $sql=SQL_TITULARES_RESIDENCIA;
         try {
               $st=$conn->prepare($sql);
               $st->bindValue(":codresidencia", $id, PDO::PARAM_INT);
               $st->execute();
               $titulares=array();
               foreach ($st->fetchAll() as $row) {
                   $titulares[]=new Residencia_Titulares($row);
               }
            
               parent::disconnect($conn);
               return array($titulares);
            } catch (PDOException $e) {
                parent::disconnect($conn);
                die("Query failed: " . $e->getMessage());
            }


     }

     
  public function Nuevo_PacienteResidencia(){
      
       $conn=parent::connect();
       $sql=SQL_NUEVO_PACIENTERESIDENCIA;
           
        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":paciente",$this->data["CODTITULAR"],PDO::PARAM_INT); 
            $st->bindValue(":residencia",$this->data["CODRES"],PDO::PARAM_INT); 
            $st->bindValue(":fecha",$this->data["FECHA"],PDO::PARAM_STR); 
            $st->bindValue(":dia",$this->data["DIA"],PDO::PARAM_INT);
            $st->bindValue(":noche_med",$this->data["NOCHE_MED"],PDO::PARAM_INT); 
            $st->bindValue(":noche_gran",$this->data["NOCHE_GRAN"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_med",$this->data["SUPERNOCHE_MED"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_gran",$this->data["SUPERNOCHE_GRAN"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_ext_gran",$this->data["SUPERNOCHE_EXT_GRAN"],PDO::PARAM_INT); 
       
            $st->execute();
            parent::disconnect($conn);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die ("Query failed: " . $e->getMessage());

        } 
      
      
  }   
     
     
  public function Modifica_AbsPaciente() {

        $conn=parent::connect();
        $sql=SQL_MODIFICA_ABS_PACIENTE;
              
        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":cod",$this->data["COD"],PDO::PARAM_INT);
            $st->bindValue(":dia", $this->data["DIA"],PDO::PARAM_INT);
            $st->bindValue(":noche_med", $this->data["NOCHE_MED"],PDO::PARAM_INT); 
            $st->bindValue(":noche_gran", $this->data["NOCHE_GRAN"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_med", $this->data["SUPERNOCHE_MED"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_gran", $this->data["SUPERNOCHE_GRAN"],PDO::PARAM_INT); 
            $st->bindValue(":supernoche_ext_gran", $this->data["SUPERNOCHE_EXT_GRAN"],PDO::PARAM_INT); 
 
            
            $st->execute();
            parent::disconnect($conn);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die ("Query failed: " . $e->getMessage());

        }

    }                    
        
  public static function EliminaTitularRes($cod) {
       
       $conn=parent::connect();
       $sql=SQL_ELIMINA_PACIENTE_RESIDENCIA;
           
        try {
            $st=$conn->prepare($sql);
            $st->bindValue(":cod",$cod, PDO::PARAM_INT);
      
            $st->execute();
            parent::disconnect($conn);

        } catch (PDOException $e) {
            parent::disconnect($conn);
            die ("Query failed: " . $e->getMessage());

        }
   } 
    
    
     
}

?>
