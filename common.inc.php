<?php

require_once ('config.php');
require_once ('Residencias.class.php');
require_once('Residencia_Titulares.class.php');
require_once ('Usuario.class.php');
require_once ('Titular.class.php');
require_once('Zona.class.php');
require_once('TipoAbsorbente.class.php');

require_once('Provincia.class.php');
require_once('Pais.class.php');
require_once('Sexo.class.php');

 


    function displayPageHeader($pageTitle,$membersArea=false){
?>

        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
         <html xmlns="http://www.w3.org/1999/xhtml">

             <head>
                 <title><?php echo $pageTitle?></title>
                 <link rel="stylesheet" type="text/css" href="<?php if ($membersArea)
                     echo "../" ?>../common.css" />
                 <style type="text/css">
                     th {text-align: left;background-color: #bbb;}
                     th,td {padding: 0.4em;}
                     tr.alt td {background: #ddd;}
                        .error {background: #d33; color: white;padding: 0.2em;}
                 </style>

             </head>   

             <body>

                 <h1><?php echo $pageTitle?></h1>
 <?php
    }

    function displayPageFooter() {

  ?>
            <span>Asociaci&oacute;n de Comerciantes de Almer&iacute;a Tlf:950555555
			Fax:950555501 E-Mail: sugerencias@comercioalmeria.com</span>
			<p>
    		<a href="http://jigsaw.w3.org/css-validator/check/referer">
       		 <img style="border:0;width:88px;height:31px"
            	src="http://jigsaw.w3.org/css-validator/images/vcss"
            	alt="CSS VAlido!" />
    		</a>

		   <a href="http://validator.w3.org/check?uri=referer"><img border="0"
        		src="http://www.w3.org/Icons/valid-xhtml10"
        		alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>

			</p>


 <?php
  }

 ?>

 <?php
    function validateField($fieldName,$missingFields) {
        if (in_array($fieldName, $missingFields)) {
            echo ' class="error"';
        }
    }

    function setChecked(DataObject $obj,$fieldName,$fieldValue) {
        if ($obj->getValue($fieldName)==$fieldValue) {
            echo ' checked="checked"';
        }
    }

    function setSelected(DataObject $obj,$fieldName,$fieldValue) {
        if ($obj->getValue($fieldName)==$fieldValue){
            echo ' selected="selected"';
        }

    }

    function compruebaUsuario(){
        session_start();
        fixObject($_SESSION['usuario']);
         if (!$_SESSION["usuario"]){
            // $_SERVER["usuario"]="";
             echo '<script>document.location = "login.php"</script>';

         }

    }

    function compruebaAdministrador(){
       session_start();
      fixObject($_SESSION['usuario']);
       if ((!$_SESSION["usuario"]) or ($_SESSION["usuario"]->getValue("ABSORVENTES")==1)) {
               echo '<script>document.location = "login.php"</script>';

        }
    }
   

 function fixObject (&$object)
{
  if (!is_object ($object) && gettype ($object) == 'object')
    return ($object = unserialize (serialize ($object)));
  return $object;
}


 

?>