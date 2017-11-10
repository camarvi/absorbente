<?PHP
include_once ("config.php");

session_start();
?>  
 
<?php

    function asignaEncabezado() {
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    
<head>      

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <meta http-equiv="Content-Type" content="Mime-Type; charset=UTF-8"/>


  
<link href="css/layout1.css" rel="stylesheet" type="text/css"/>

<title>Control Absorbentes</title>



  <?php
    }     
?>  
   
<?php
    
    function asignaEncabezado2() {
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

<head>    

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <meta http-equiv="Content-Type" content="Mime-Type; charset=UTF-8"/>

<link href="../css/layout1.css" rel="stylesheet" type="text/css"/>

<title>Control Absorbentes</title>



  <?php
    }
?>

  
      

   <?php
       

           function asignaPiepagina() {
    ?>

	<div id="pie">
                <span>Distrito Sanitario Almer&iacute;a</span>
		


		</div>


	</div>

</body>
</html>
<?php
   }
   ?>


  <?php  function asignaLogoMenu2() {

     ?>

        <body>

	<div id="contenedor">

		<div id="cabecera">
			<span id="textocabecera">Control Absorbentes</span>
        
		</div>   
   
	       	<div id="menucabecera">

                    <ul id="nav">
                         
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="nuevo_titular.php">Nuevo Titular</a></li>
                      
                        
                         <li><a href="#">Residencias</a>
                           <ul class="submenu">
                             <li><a href="titulares_residencia.php">Buscar</a></li>
                             <li><a href="buscar_paciente.php">Asigna Paciente</a></li>
                             
                           </ul>    
                                
                        </li>   
                         
                        <li>
                            <a href="logout.php">Salir</a>
                        </li>
                    
                    </ul>

		
		</div>	
              

 <?php
    } ?>

            
            
<?php  function asignaLogoMenu3() {

     ?>

        <body>

	<div id="contenedor">

		<div id="cabecera">
			<span id="textocabecera">Control Absorbentes</span>


		</div>



 <?php
    } ?>           
 
            
 <?php function cargalibreriasjsp() {
   ?>  
    
        <script type="text/javascript" src="jsp/jquery.backgroundpos.js"></script>
        <script type="text/javascript" src="jsp/jquery-1.7.1.min.js"></script>
            
            
<?php     
 }   ?>  
        
        
<?php function activascriptmenu() {
    ?>

 <script type="text/javascript">
$(function(){
	$('#nav>li').hover(
		function(){
		$('.submenu',this).stop(true,true).slideDown('fast');
		},
		function(){
		$('.submenu',this).slideUp('fast');
		}
	);

	$('.submenu li a').css( {backgroundPosition: "0px 0px"} ).hover(
		function(){
		$(this).stop().animate({backgroundPosition: "(0px -99px)"}, 250);
		},
		function(){
		$(this).stop().animate({backgroundPosition: "(0px 0px)"}, 250);
		}
	);
});
</script>
    
    
    <?php        
}    
?>


 