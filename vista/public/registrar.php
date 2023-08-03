<?php
include("../../controlador/sesion.php");
include("../../modelo/BD/config.php");
include("../../modelo/BD/dataBase.php");

$rol_sesion=$_GET['rol_sesion'];
$db=new DataBase();

if(isset($_POST['submit'])){
    $nombre=mysqli_real_escape_string($db->link, $_POST['nombre']);
    $apaterno=mysqli_real_escape_string($db->link, $_POST['apaterno']);
    $amaterno=mysqli_real_escape_string($db->link, $_POST['amaterno']);
    $user=mysqli_real_escape_string($db->link, $_POST['user']);
    $pass=mysqli_real_escape_string($db->link, $_POST['pass']);
    $encriptado=password_hash($pass, PASSWORD_DEFAULT);
    $foto='';
    if($_FILES['foto']['size']!=0 && $_FILES['foto']['type']==='image/jpeg'||$_FILES['foto']['type']==='image/png'){
        $foto=addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    }
    $rol_id=mysqli_real_escape_string($db->link, $_POST['rol']);
    if($nombre==''||$apaterno==''||$amaterno==''||$user==''||$pass==''||$rol_id==''){
        header('Location:registrar.php?msg='.urlencode('Debe llenar los campos').'&rol_sesion='.$rol_sesion);
    }
    else  if($db->verificarUsuario($user)==1){
        header('Location:registrar.php?msg='.urlencode('El usuario ya existe').'&rol_sesion='.$rol_sesion);
    }else{
        if($foto==''){
            $nomArchivo=null;
        }
        else{
            $fecha=new DateTime();
            $nomArchivo=($foto!="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"";
            $tmpFoto=$_FILES["foto"]["tmp_name"];
        }
        $nombres="/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
        $correos="/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/";
        $contraseña='/^(?=.*\d)(?=.*[A-Za-z])[A-Za-z\d]{8,}$/';
        $imagenes="/\.(jpg|jpeg|png|gif)$/i";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if(preg_match($nombres, $nombre)){
                if(preg_match($nombres, $apaterno)){
                    if(preg_match($nombres, $amaterno)){
                        if(preg_match($correos, $user)){
                            if(preg_match($contraseña, $pass)){
                                $query="insert into usuario (nombres, apaterno, amaterno, usuario, password, foto, id_cargo_fk) values ('$nombre', '$apaterno', '$amaterno', '$user', '$encriptado', '$nomArchivo', '$rol_id')";

                                if($tmpFoto!=""){
                                    move_uploaded_file($tmpFoto, "../asets/img/fotos/".$nomArchivo);
                                }
                                $create=mysqli_insert_id($db->registerUser($query));
                            }
                            else{
                                header('Location:registrar.php?msg='.urlencode('La contraseña no tiene el formato correcto').'&rol_sesion='.$rol_sesion);
                            }
                        }
                        else{
                            header('Location:registrar.php?msg='.urlencode('El correo no tiene el formato correcto').'&rol_sesion='.$rol_sesion);
                        }
                    }
                    else{
                        header('Location:registrar.php?msg='.urlencode('El apellido materno no tiene el formato correcto').'&rol_sesion='.$rol_sesion);
                    }
                }
                else{
                    header('Location:registrar.php?msg='.urlencode('El apellido parterno no tiene el formato correcto').'&rol_sesion='.$rol_sesion);
                }
            }
            else{
                header('Location:registrar.php?msg='.urlencode('El nombre no tiene el formato correcto').'&rol_sesion='.$rol_sesion);
            }
        }
        
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para Registrar</title>
    <meta name="description" content="Modulo de registro de usuarios">
    <meta name="keywords" content="Registro">
    <meta name="author" content="Eve">
    <link rel="Shortcut icon" type="image/x-icon" href="../asets/img/iconos/icono.png">
    <link rel="stylesheet" type="text/css" href="../asets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../asets/css/animaciones.css">
    <link rel="stylesheet" href="../asets/css/fondo.css">
</head>
<body>
    <main class="container mt-5 fade-in">
        <div class="row bg-light rounded p-3">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a href="registrar.php" class="navbar-brand"><img src="../asets/img/iconos/icono.png" width="40" height="40"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-icon"><a href="../../logout.php" class="nav-link active" aria-current="page">SALIR</a></li>
                            <li class="nav-icon"><a href="resultado.php?rol_sesion=<?php echo $rol_sesion;?>" class="nav-link">MOSTRAR LISTA</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col-sm-12 col-md-12 col-lg-6 float-left my-5">
                <img src="../asets/img/galeria/img1.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h2 class="display-5 fw-semibold text-uppercase text-center">Formulario de registro</h2>       
                <form action="registrar.php?rol_sesion=<?php echo $rol_sesion; ?>" class="row g-3 p-3 rounded needs-validation" novalidate method="POST" enctype="multipart/form-data">
                    <?php
                        if(isset($_GET['msg'])){
                        echo "<center><div class='alert alert-danger fw-bold fst-italic'><span>".$_GET['msg']."</span></div></center>";
                    }
                    ?>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Introducir nombres">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="apaterno" name="apaterno" required placeholder="Introducir apellido paterno">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="amaterno" name="amaterno" required placeholder="Introducir apellido materno">
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="email" class="form-control" id="user" name="user" aria-describedby="inputGroupPrepend" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">&#x1F512;</span>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">&#128247;</span>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-0">
                        <label class="mb-1 lead fs-6">Seleccionar el cargo</label>
                        <select class="form-select has-validation" aria-label="Default select example" id="rol" name="rol" required>
                            <option selected></option>
                            <option value="1" class="lead">Administrador</option>
                            <option value="2" class="lead">Desarrollador</option>
                            <option value="3" class="lead">Invitado</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="submit" id="submit" class="btn btn-dark">Registrar</button>
                        <span><a href="registrar.php" class="btn btn-success">Limpiar Datos</a></span>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>