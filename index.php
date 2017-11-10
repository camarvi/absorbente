<?php
   
/*
 * Ventana de inicio del portal
 */    
         
require_once ("plantilla.php");
require_once ("common.inc.php");


compruebaUsuario();



if (isset($_POST["nusha"])) {
        $cadena=trim($_POST["nusha"]);
        if (strlen($cadena)>5) {
            list($titulares)=Titular::getTitularNusha($cadena);    
        }
       
 } 
  
if (isset($_POST["nombre"])) {
        $cadena=trim($_POST["nombre"]);
        if (strlen($cadena)>5) {
            list($titulares)=Titular::getTitularNombre($cadena);    
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
            <h2>Absorbentes : Buscar Usuarios</h2>
              <form id="fbuscapaciente" name="fbuscapaciente" action="" method="POST">    
             
            <table id="tfiltro" width="100%">
                <tr>
                    <td class="filaA">NUSHA</td>
                    <td  class="filaA">
                        <input type="text" name="nusha" id="nusha" value="" size="15"/>
                    </td>   
                    <td  class="filaA">NOMBRE:</td>
                    <td  class="filaA">
                       <input type="text" name="nombre" id="nombre" value="" size="35"/>
                    </td>
             
               
                    <td>
                         <input class="btn" type="submit" id="consultar" name="consultar" value="Buscar" />                                  
                    </td>   
               
                </tr>
                        
                  
            </table>

            <table class="tablaregistros">
               <tr>
                   
                   <th>Nombre</th>
                   <th>Fnacimiento</th>
                   <th>Domicilio</th>
                   <th>Nusha</th>
                
                   <th></th>

                </tr>
            
         
         <?php
           $cuentaLinea=0;

            foreach ($titulares as $titular) {
                $cuentaLinea++;
            ?>
         
                <tr<?php if ($cuentaLinea%2==0) echo ' class="cambiocolor"' ?>>
                    <td>
                        <?php echo ($titular->getValue("NOMBRE")) ?>
                    </td>
                     <td>
                        <?php echo ($titular->getValue("FNACIMIENTO")) ?>
                    </td>
                     <td>
                        <?php echo ($titular->getValue("DOMICILIO")) ?>
                    </td>
                     <td>
                        <?php echo ($titular->getValue("NSS")) ?>
                    </td>
                    
                    <td>
                       <a href="ficha_paciente.php?idusuario=<?php echo $titular->getValueEncoded("ID")?>"><img src="imagenes/siguiente.png" border="none" alt="Vacunar"/></a>
                    </td>
                  
                </tr>

                <?php
                    }
                ?>
            </table>


         </form>    
                        
                     
	   </div>
			
		
</div>  
  

<?php
     
      asignaPiepagina();
 
  
?>