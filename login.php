<?php
   
/*
 * Ventana de inicio del portal
 */           
            
require_once ("plantilla.php");
require_once ("common.inc.php");
require_once ('Usuario.class.php');


if (isset ($_POST["enviapass"])) {

    

      $username= preg_replace("/[^ \-\_a-zA-Z0-9]/","", $_POST["usuario"]);
      $passusaurio= preg_replace("/[^ \-\_a-zA-Z0-9]/","", $_POST["pass"]);

         
      $loginusuario=Usuario::autentificar($username,$passusaurio);
      
   try {
     if (isset($loginusuario))    {
       
          $_SESSION["usuario"]=$loginusuario;
           echo '<script>document.location = "index.php"</script>';

     }   else {
         $_SESSION["usuario"]="";
        echo '<script>document.location = "login.php"</script>';

     }
   } catch (Exception $e) {
        $_SESSION["usuario"]="";
         echo '<script>document.location = "login.php"</script>';

   }

}

  asignaEncabezado();

    ?>

</head>
    
    
  
<?php
     
      asignaLogoMenu3();
 
  
?>

    
		<div id="contenido">
				
		  <div id="principal_login">
			
               
                        <form id="login" name="login" action="login.php" method="POST">
                            <fieldset>   
                                <legend>Formulario Acceso </legend>
					     <div>					
						<label for="anio">Usuario:</label>
						<input type="text" id="usuario" name="usuario" size="15" />
					     </div>
						
                                             <div>
                                          	<label for="anio">Password:</label>
						<input type="password" id="pass" name="pass" size="15" />
					     </div>
                                               
                                            <div>
                                                <input class="btn" type="submit" name="enviapass" value="Enviar" />
                                            </div>
						
                            </fieldset>                       
                        </form>
                     
	         </div>
		  	        
		
			
		     
		</div>  
  
		<?php

                asignaPiepagina();
               ?>