<?php
session_start();
if(!$_SESSION['s_usuario']){
    header("Location:../../logout.php");
}
?>