<?php
   
/*
 * Ventana de inicio del portal
 */    
         
require_once ("plantilla.php");
require_once ("common.inc.php");

compruebaUsuario();

list($listaResidencias)=Residencias::listadoResidencias();



  
// modificar los absorventes de un paciente

if (isset ($_POST['modificaficha'])) {
    
   
    $fecha=date("Y-m-d");
                            
    $modificaficapac=new Residencia_Titulares(array(
                    "CODRES"=> (($_POST["residencia"])),
                    "CODTITULAR"=>(($_POST["idusuario"])),
                    "FECHA"=> (($fecha)),
                    "DIA"=>(($_POST["dia"])),
                    "NOCHE_MED"=>(($_POST["noche_mediano"])),
                    "NOCHE_GRAN"=>(($_POST["noche_grande"])),
                    "SUPERNOCHE_MED"=>(($_POST["supernochemediana"])),
                    "SUPERNOCHE_GRAN"=>(($_POST["supernochegrande"])),
                    "SUPERNOCHE_EXT_GRAN"=>(($_POST["supernoche_ext_grande"])),  
                    "COD"=>(($_POST["codlinea"])), 
                    ));                        
                            
     $modificaficapac->Modifica_AbsPaciente();
     
     $modificatitular=new Titular(array(
                    "ID"=>(($_POST["idusuario"])),
                    "NSS"=> ($_POST["nusha"]),
                    ));    
     $modificatitular->modifica_nusha();
    
    
}   

// añadir paciente a una residencia

if (isset ($_POST['incluir'])) {
    
   
    $fecha=date("Y-m-d");
                            
    $modificaficapac=new Residencia_Titulares(array(
                    "CODRES"=> (($_POST["residencia"])),
                    "CODTITULAR"=>(($_POST["idusuario"])),
                    "FECHA"=> (($fecha)),
                    "DIA"=>(($_POST["dia"])),
                    "NOCHE_MED"=>(($_POST["noche_mediano"])),
                    "NOCHE_GRAN"=>(($_POST["noche_grande"])),
                    "SUPERNOCHE_MED"=>(($_POST["supernochemediana"])),
                    "SUPERNOCHE_GRAN"=>(($_POST["supernochegrande"])),
                    "SUPERNOCHE_EXT_GRAN"=>(($_POST["supernoche_ext_grande"])),  
                    ));                        
                            
     $modificaficapac->Nuevo_PacienteResidencia();
     
    
}   


 
  if (isset ($_GET["idusuario"])) {

       $titular=new Titular();
       $titular= Titular::getTitular($_GET["idusuario"]);
      
       $fichatitular=new Residencia_Titulares();
       $fichatitular=Residencia_Titulares::TitularResidencia($_GET["idusuario"]);
       if (isset($fichatitular)){
          $codresidencia=$fichatitular->getValueEncoded('CODRES'); 
           
       } else {
           $codresidencia=0;
           
       }
           
  }
    

 
  asignaEncabezado();

  cargalibreriasjsp();
    ?>


</head>
    
    
  
<?php
     
      activascriptmenu();
      asignaLogoMenu2();
  
  
?>


<div id="contenido">
				
        <div id="principal">
            <h2>Absorbentes Paciente</h2>
              <form id="fbuscapaciente" name="fbuscapaciente" action="" method="POST">    
             
              <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $titular->getValueEncoded("ID")?>" />
               
              <?php if ($codresidencia>0) { ?>
                <input type="hidden" name="codlinea" id="codlinea" value="<?php echo $fichatitular->getValueEncoded("COD")?>" />
              <?php } ?>
              <table id="tfiltro" width="100%">
                <tr>
                    <td class="filaA">NUSHA</td>
                    <td  class="filaA">
                        <input type="text" name="nusha" id="nusha" value="<?php echo ($titular->getValue("NSS"))?>" size="15"/>
                    </td>   
                    <td  class="filaA">NOMBRE</td>
                    <td  class="filaA">
                       <input type="text" name="nombre" id="nombre" value="<?php echo ($titular->getValue("NOMBRE"))?>" size="50"/>
                    </td>
                    <td  class="filaA">F Nac:</td>
                    <td  class="filaA">
                       <input type="text" name="fnacimiento" id="fnacimiento" value="<?php echo ($titular->getValue("FNACIMIENTO"))?>" size="10"/>
                    </td>
               
                </tr>
                   
                <tr>
                    <td class="filaA">Residencia</td>
                     <td  class="filaA">
                        <select name="residencia" ID="residencia"> 
                            <option value="0">Seleccionar..</option>
                          <?php
                              foreach ($listaResidencias as $lresidencia) {
                                  
                               if ($codresidencia==$lresidencia->getValue('COD'))  { 
                            ?>
                            <option value="<?php echo $lresidencia->getValue('COD')?>" selected="selected">
                           <?php echo ($lresidencia->getValue('NOMBRE'))?></option>
                            <?php
                               } else {
                             
                            ?>
                              <option value="<?php echo $lresidencia->getValue('COD')?>">
                           <?php echo ($lresidencia->getValue('NOMBRE'))?></option>
                          <?php } 
                              }
                          ?> 
                        </select>
                    </td>
                </tr>    

                <tr>
                  <td class="filaA">Anatomico Dia </td>  
                  <td  class="filaA">
                        <input type="text" name="dia" id="dia" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('DIA');  
                        }
                        ?>" size="5"/>
                        
                  </td>   
                  <td class="filaA">Noche Mediano </td>  
                  <td  class="filaA">
                        <input type="text" name="noche_mediano" id="noche_mediano" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('NOCHE_MED');  
                        }
                        ?>" size="5"/>
                 </td>    
                 <td class="filaA">Noche Grande </td>  
                  <td  class="filaA">
                        <input type="text" name="noche_grande" id="noche_grande" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('NOCHE_GRAN');  
                        }
                        ?>" size="5"/>
                 </td>    
              </tr>        
              <tr>
                 <td class="filaA">Supernoche Mediana </td>  
                  <td  class="filaA">
                        <input type="text" name="supernochemediana" id="supernochemediana" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('SUPERNOCHE_MED');  
                        }
                        ?>" size="5"/>
                  </td>   
                  <td class="filaA">Supernoche Grande </td>  
                  <td  class="filaA">
                        <input type="text" name="supernochegrande" id="supernochegrande" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('SUPERNOCHE_GRAN');  
                        }
                        ?>" size="5"/>
                 </td>      
                  
                <td class="filaA">Supernoche Ext Grande </td>  
                 <td  class="filaA">
                        <input type="text" name="supernoche_ext_grande" id="supernoche_ext_grande" value="<?php if  ($codresidencia>0) {
                         echo $fichatitular->getValue('SUPERNOCHE_EXT_GRAN');  
                        }
                        ?>" size="5"/>
                 </td>      
                 
              </tr>     
                
              <tr>
                 <td>
                   <?php if ($codresidencia==0) { ?>  
                       <input class="btn" type="submit" name="incluir" value="Incluir" />
                   <?php } ?>
                    <?php if ($codresidencia>0) { ?>  
                       <input class="btn" type="submit" name="modificaficha" value="Modificar" />
                   <?php } ?>
                 </td>
              </tr>    
                  
            </table>
          
        
         </form>    
                        
                     
	   </div>
			
		
</div>  
  

<?php
     
      asignaPiepagina();
 
  
?>