<?php
   
/*
 * Ventana de inicio del portal
 */    
         
require_once ("plantilla.php");
require_once ("common.inc.php");


compruebaUsuario();

list($listaResidencias)=Residencias::listadoResidencias();


if (isset ($_GET['codlinea'])) {
   
    Residencia_Titulares::EliminaTitularRes($_GET['codlinea']);
    $codresidencia=$_SESSION['codresidencia'];  
    list($usuariosresidencia)=Residencia_Titulares::TitularesResidencia($codresidencia); 
   
}


if (isset ($_POST['consultar'])) {
    
   $codresidencia=$_POST['residencia'];
   list($usuariosresidencia)=Residencia_Titulares::TitularesResidencia($_POST['residencia']); 
   $_SESSION['codresidencia']=$codresidencia; 
   
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
            <h2>Listado Usuarios Residencia</h2>
              <form id="fbuscapaciente" name="fbuscapaciente" action="" method="POST">    
             
            <table id="tfiltro" width="100%">
                 <tr>
                     <td class="filaA">Residencia 
                        <select name="residencia" ID="residencia"> 
                          <?php
                              foreach ($listaResidencias as $lresidencia) {
                                  
                               if ($codresidencia==$lresidencia->getValueEncoded('COD'))  { 
                            ?>
                            <option value="<?php echo $lresidencia->getValueEncoded('COD')?>" selected="selected">
                           <?php echo ($lresidencia->getValue('NOMBRE'))?></option>
                            <?php
                               } else {
                              
                            ?>
                              <option value="<?php echo $lresidencia->getValueEncoded('COD')?>">
                           <?php echo ($lresidencia->getValue('NOMBRE'))?></option>
                          <?php }
                          } 
                          ?> 
                        </select>
             
                    <input class="btn" type="submit" id="consultar" name="consultar" value="Buscar" />  
               </td>
            </table>

            <table class="tablaregistros">
               <tr>
                   
                   <th>Nombre</th>
                   <th>Nusha</th>
                   <th>Fnacimiento</th>
                   <th>Dia</th>
                   <th>Noche Med</th>
                   <th>Noche Gra</th>
                   <th>SNoche Med</th>
                   <th>SNoche Gra</th>
                   <th>SNoche ExtG</th>
                   <th>Modificar</th>
                   <th>Borrar</th>
                   

                </tr>
            
         
         <?php
           $cuentaLinea=0;
           $totaldia=0;
           $totalnochemed=0;
           $totalnochegran=0;
           $totalsnochemed=0;
           $totalsnochegran=0;
           $totalsnocheextragran=0;
           
           
            foreach ($usuariosresidencia as $titular) {
                $cuentaLinea++;
            ?>
         
                <tr<?php if ($cuentaLinea%2==0) echo ' class="cambiocolor"' ?>>
                    <td>
                        <?php echo ($titular->getValue("NOMBRE")) ?>
                    </td>
                    <td>
                        <?php echo ($titular->getValue("NSS")) ?>
                    </td>
                     <td>
                        <?php
                        echo date('d/m/Y' , strtotime($titular->getValueEncoded("FNACIMIENTO")));
                        ?>
                    </td>
                     <td>
                        <?php 
                          $totaldia=$totaldia+$titular->getValueEncoded("DIA");
                          echo ($titular->getValue("DIA")); 
                         ?>
                    </td>
                    <td>
                       <?php
                        $totalnochemed=$totalnochemed+$titular->getValueEncoded("NOCHE_MED");
                        echo ($titular->getValue("NOCHE_MED")); 
                       ?>
                    </td>
                    <td>
                        <?php 
                          $totalnochegran= $totalnochegran+$titular->getValueEncoded("NOCHE_GRAN");
                          echo ($titular->getValue("NOCHE_GRAN")); 
                        ?>
                    </td>
                    <td>
                        <?php 
                          $totalsnochemed=$totalsnochemed+$titular->getValueEncoded("SUPERNOCHE_MED");
                          echo ($titular->getValue("SUPERNOCHE_MED")); 
                        ?>
                    </td>
                    <td>
                        <?php 
                         $totalsnochegran=$totalsnochegran+$titular->getValueEncoded("SUPERNOCHE_GRAN");
                         echo ($titular->getValue("SUPERNOCHE_GRAN")); 
                        ?>
                    </td> 
                    <td>
                        <?php 
                         $totalsnocheextragran=$totalsnocheextragran+$titular->getValueEncoded("SUPERNOCHE_EXT_GRAN");
                         echo ($titular->getValue("SUPERNOCHE_EXT_GRAN")); 
                        ?>
                    </td> 
                      <td>
                       <a href="ficha_paciente.php?idusuario=<?php echo $titular->getValueEncoded("CODTITULAR")?>">
                           <img src="imagenes/editar.png"  border="none" alt="modificar">
                       </a>
                     </td>
                    
                     <td>
                          <a href="titulares_residencia.php?codlinea=<?php echo $titular->getValueEncoded("COD") ?>">
                             <img src="imagenes/icono_eliminar.gif"  border="none" alt="borrar">
                          </a>
                     </td>
  
                </tr>

                <?php
                    }
                ?>
                 <tr<?php $cuentaLinea++; if ($cuentaLinea%2==0) echo ' class="cambiocolor"' ?>>
                    <td colspan="3">Total Dia</td>
                    <td><?php echo $totaldia; ?></td>
                    <td><?php echo $totalnochemed; ?></td>
                    <td><?php echo $totalnochegran; ?></td> 
                    <td><?php echo $totalsnochemed; ?></td> 
                    <td><?php echo $totalsnochegran; ?></td>
                    <td><?php echo $totalsnocheextragran; ?></td>
                    <td></td>
                </tr>
                
                  <tr<?php $cuentaLinea++;
                  if ($cuentaLinea%2==0) echo ' class="cambiocolor"' ?>>
                    <td colspan="3">Total Mes</td>
                    <td><?php echo $totaldia*30; ?></td>
                    <td><?php echo $totalnochemed*30; ?></td>
                    <td><?php echo $totalnochegran*30; ?></td> 
                    <td><?php echo $totalsnochemed*30; ?></td> 
                    <td><?php echo $totalsnochegran*30; ?></td>
                    <td><?php echo $totalsnocheextragran*30; ?></td>
                    <td></td>
                </tr>
                
                
            </table>


         </form>    
                        
                     
	   </div>
			
		
</div>  
  

<?php
     
      asignaPiepagina();
 
  
?>