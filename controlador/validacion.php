<?php
include("../modelo/BD/config.php");
include("../modelo/BD/dataBase.php");

$db=new DataBase();

if(isset($_POST['enviar']) && $_SERVER['REQUEST_METHOD']=='POST'){
    $user=mysqli_real_escape_string($db->link, $_POST['user']);
    $pass=mysqli_real_escape_string($db->link, $_POST['pass']);

    if(empty($user)|| empty($pass)){
        header("Location:../index.php?msg=".urlencode('Debe llenar los campos'));
    }
    else{
        $query="select * from usuario where usuario='$user'";
        $result=$db->select($query);
        if(mysqli_num_rows($result)){
            while($row=mysqli_fetch_array($result)){
                if(password_verify($pass,$row["password"])){
                    // Para crear sesiones
                    session_start();
                    $_SESSION['s_usuario']=$row["usuario"];
                    $_SESSION['s_id_usuario']=$row["id_usuario"];
                    $_SESSION['s_id_cargo']=$row["id_cargo_fk"];
                    $login=$db->signIn($query, $_SESSION['s_id_usuario'], $_SESSION['s_id_cargo']);
                }
                else{
                    header("Location:../index.php?msg2=".urlencode("¡Opps los datos son erroneos"));
                }
            }
        }
    }
}
?>