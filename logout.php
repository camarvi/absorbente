<?php

    require_once ("common.inc.php");

    session_start();
    $_SESSION["usuario"]="";
    $_SESSION=array();
    session_destroy();

   echo '<script>document.location = "login.php"</script>';
       
?>
