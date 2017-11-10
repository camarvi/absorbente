<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
   
require_once ("plantilla.php");
require_once ("common.inc.php");
require_once('Sexo.class.php');
   

compruebaUsuario();


$muestradatos=0;

// CARGO INFORMACION COMBOX




list($listapais)=Pais::getListaPaises();
list($listaprovincias)=Provincia::getListaProvincias();
list($listazonas)=Zona::listadoZonas();
list($listasexos)=Sexo::getListaSexo();
   
         
    if (isset ($_POST['guardar'])){
       //SE HA PULSADO EL BOTON CONSULTAR
       //REALIZO LA BUSQUEDA DE LOS DATOS
       //creo un array para guardar los datos de la frecuentacion
    /*

:nss,:dni,:nombre,:fnacimiento,:falta,:domicilio,:localidad," .
              ":provincia,:cp,:ta,:obs,:zonabas,:tarsanitaria,:tlf,:movil1,:movil2,
                :sexo,:municipio,:pais,1,1

    */
     
           $falta=date("Y-m-d");
        
             $separar =explode('/',$_POST["fnacimiento"]);
                            $dia=trim($separar[0]);
                            $mes=trim($separar[1]);
                            $anio=trim($separar[2]);
            $fechagrabarok=$anio . "-" . $mes . "-" . $dia;
               
              
            $titular=new Titular(array("NSS"=>($_POST["nusha"]) ,
                    "DNI"=> ($_POST["dni"]),
                    "NOMBRE"=> (html_entity_decode($_POST["nombre"])),
                    "FNACIMIENTO"=>($fechagrabarok),
                    "FALTA"=>($falta),
                    "DOMICILIO"=>(html_entity_decode($_POST["domicilio"])),
                    "LOCALIDAD"=>(html_entity_decode($_POST["localidad"])),
                    "PROVINCIA"=>(html_entity_decode($_POST["provincia"])),
                    "CP"=>($_POST["codpostal"]),
                    "TA"=>('A'),
                    "ZONABAS"=>($_POST["zona"]),
                    "TARSANITARIA"=>($_POST["nusha"]),
                    "TLF"=>($_POST["tlf"]),
                    "MOVIL1"=>($_POST["movil1"]),
                    "MOVIL2"=>($_POST["movil2"]),
                    "SEXO"=>($_POST["sexo"]),
                    "MUNICIPIO"=>($_POST["municipio"]),
                    "PAIS"=>($_POST["pais"])
                    ));
               
            $titular->nuevo_Titular();
            
             echo '<script>alert("Usuario Grabado")</script>';
       
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
           <div id="bloquea" class="cargando" style="display:none;">
                      <img style="margin-left: 5%;margin-top: 15%" alt="Espere..." src="imagenes/processing.gif" />
                     
            </div>  
       
        <div id="principal">
           <h2>Alta Profesional</h2>
            <form id="fnuevaentrada" name="fnuevotitular" action="" method="POST">
               
              
            <table id="tfiltro" width="100%">
                <tr>
                    <td class="filaA">Dni:</td>
                    <td class="filaA">
                        <input type="text" name="dni" value="" size="10"/>
                     </td>
                    
                     <td class="filaA">Nombre:</td>
                     <td class="filaA">
                         <input type="text" name="nombre" value="" size="50"/>
                     </td>
                     
                     <td class="filaA">F Nacimiento:</td>
                     <td class="filaA">
                         <input type="text" name="fnacimiento" value="" size="10"/>
                     </td>
                     
                </tr>   
                <tr>
                    
                     <td class="filaA">Nusha:</td>
                    <td class="filaA">
                        <input type="text" name="nusha" value="" size="10"/>
                     </td>
                    
                     <td class="filaA">Seg social:</td>
                     <td class="filaA">
                         <input type="text" name="segsocial" value="" size="10"/>
                     </td>
                     
                    <td class="filaA">Sexo</td>
                    <td  class="filaA">
                        <select name="sexo"> 
                          <?php
                              foreach ($listasexos as $listasexo) {
                            ?>
                            <option value="<?php echo $listasexo->getValueEncoded('ID')?>">
                           <?php echo ($listasexo->getValue('SEXO'))?></option>
                            <?php
                              }
                            ?>
                           
                        </select>
                    </td>
                     
                </tr>    
                    
                <tr>    
                          
                     <td class="filaA">Domicilio:</td>
                     <td class="filaA">
                         <input type="text" name="domicilio" value="" size="40"/>
                     </td>
                     
                     <td class="filaA">C.P:</td>
                     <td class="filaA">
                         <input type="text" name="codpostal" value="" size="6"/>
                     </td>
                    
                    <td class="filaA">Zona</td>
                    <td  class="filaA">
                        <select name="zona"> 
                          <?php
                              foreach ($listazonas as $listazona) {
                            ?>
                           
                            <option value="<?php echo $listazona->getValueEncoded('ID')?>">
                           <?php echo ($listazona->getValue('NOMBRE'))?></option>
                            <?php
                              }
                            ?>
                           
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="filaA">Localidad:</td>
                    <td class="filaA">
                        <input type="text" name="localidad" value="" size="20"/>
                    </td>
                    
                    <td class="filaA">Provincia:</td>
                    <td  class="filaA">
                        <select name="provincia"> 
                          <?php
                              foreach ($listaprovincias as $listaprovincia) {
                            ?>
                            <option value="<?php echo $listaprovincia->getValueEncoded('ID')?>">
                           <?php echo  ($listaprovincia->getValue('PROVINCIA'))?></option>
                            <?php
                              }
                            ?>
                           
                        </select>
                    </td>
                
                    <td class="filaA">Pais:</td>
                    <td  class="filaA">
                        <select name="pais"> 
                          <?php
                              foreach ($listapais as $lpais) {
                            ?>
                            <option value="<?php echo $lpais->getValueEncoded('ID')?>">
                           <?php echo $lpais->getValue('PAIS')?></option>
                            <?php
                              }
                            ?>
                           
                        </select>
                    </td>
             
                </tr>
             
                <tr>
                    <td class="filaA">Tlf:</td>
                    <td class="filaA">
                        <input type="text" name="tlf" value="" size="12"/>
                    </td>
                    
                    <td class="filaA">Movil1:</td>
                    <td class="filaA">
                        <input type="text" name="movil1" value="" size="12"/>
                    </td>
                  
                    <td class="filaA">Movil2:</td>
                    <td class="filaA">
                        <input type="text" name="movil2" value="" size="12"/>
                    </td>
                </tr>    
            
                <tr>    
                    
                    <td>
                         <input class="btn" type="submit" id="consultar" name="guardar" value="Guardar" 
                                onclick="document.getElementById('bloquea').style.display='block';"/>
                    </td>
                    <td>
                        <a href="index.php">
                             <img src="imagenes/btn_atras.gif" border="none" alt="Inicio"/>
                        </a>

                    </td>
                

                </tr>
                
       
            </table>
    

         </form>

     </div>
    

</div>


<?php
    
      asignaPiepagina();


?>