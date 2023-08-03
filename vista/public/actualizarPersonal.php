<?php
include("../../controlador/sesion.php");
include("../../modelo/BD/config.php");
include("../../modelo/BD/dataBase.php");

$rol_sesion=$_GET['rol_sesion'];
// $rol_sesion2=$_GET['rol_sesion2'];
$id=$_GET['id_usuario'];
$db=new DataBase();
$query="select * from usuario where id_usuario=$id";
$getData=$db->select($query)->fetch_assoc();
if(isset($_POST['submit'])){
    $nombre=mysqli_real_escape_string($db->link, $_POST['nombre']);
    $apaterno=mysqli_real_escape_string($db->link, $_POST['apaterno']);
    $amaterno=mysqli_real_escape_string($db->link, $_POST['amaterno']);
    $user=mysqli_real_escape_string($db->link, $_POST['user']);
    $pass=mysqli_real_escape_string($db->link, $_POST['pass']);
    $encriptado=password_hash($pass, PASSWORD_DEFAULT);
    if($_FILES['foto']['size']!=0 && $_FILES['foto']['type']==='image/jpeg'||$_FILES['foto']['type']==='image/png'){
        $foto=addslashes(file_get_contents($_FILES['foto']['tmp_name']));
    }
    $rol_id=mysqli_real_escape_string($db->link, $_POST['rol']);
    if($nombre==''||$apaterno==''||$amaterno==''||$user==''||$pass==''||$rol_id==''){
        header('Location:actualizarPersonal.php?msg='.urlencode('Existen datos vacíos').'&id_usuario='.$id);

    }else{  
        if($foto==''){
            $nomArchivo=$getData['foto'];
        }
        else{
            unlink("../asets/img/fotos/".$getData['foto']);
            $fecha=new DateTime();
            $nomArchivo=($foto!="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"";
            $tmpFoto=$_FILES["foto"]["tmp_name"];
        }
        $query="update usuario set apaterno='$apaterno', amaterno='$amaterno', nombres='$nombre', usuario='$user', password='$encriptado', foto='$nomArchivo', id_cargo_fk='$rol_id' where id_usuario='$id'";
        if($tmpFoto!=""){
            unlink("../asets/img/fotos/".$getData['foto']);
            move_uploaded_file($tmpFoto, "../asets/img/fotos/".$nomArchivo);
        }
        $update=$db->updateUsuario($query);
    }
}
if(isset($_POST['delete'])){
    $query="delete from usuario where id_usuario=$id";
    if($getData['foto']!=null){
        unlink("../asets/img/fotos/".$getData['foto']);
    }
    $deleteData=$db->deleteUsuario($query);
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
<body oncopy="return false" onpaste="return false">
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
                            <li class="nav-icon"><a href="../../index.php" class="nav-link active" aria-current="page">SALIR</a></li>
                            <li class="nav-icon"><a href="resultado.php" class="nav-link">MOSTRAR LISTA</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col-sm-12 col-md-12 col-lg-6 float-left my-5">
                <img src="../asets/img/galeria/img1.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h2 class="display-5 fw-semibold text-uppercase text-center">Formulario de actualización de datos</h2>            
                <form action="actualizarPersonal.php?id_usuario=<?php echo $id; ?>" class="row g-3 p-3 rounded needs-validation" novalidate method="POST" enctype="multipart/form-data">
                    <?php
                        if(isset($_GET['msg'])){
                        echo "<center class='alert alert-danger fw-bold fst-italic'>".$_GET['msg']."</center>";
                    }
                    ?>
                    <div class="mb-3">
                        <input type="text" class="form-control text-primary text-opacity-75 fw-semibold" id="nombre" name="nombre" required value="<?php echo $getData['nombres'];?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control text-primary text-opacity-75 fw-semibold" id="apaterno" name="apaterno" required value="<?php echo $getData['apaterno'];?>">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control text-primary text-opacity-75 fw-semibold" id="amaterno" name="amaterno" required value="<?php echo $getData['amaterno'];?>">
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="email" class="form-control text-primary text-opacity-75 fw-semibold" id="user" name="user" aria-describedby="inputGroupPrepend" required value="<?php echo $getData['usuario'];?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">&#x1F512;</span>
                            <input type="password" class="form-control text-primary text-opacity-75 fw-semibold" id="pass" name="pass" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número y una letra mayúscula y minúscula, y al menos 8 o más carácteres">
                        </div>
                    </div>
                    <div class="mb-3">
                    <center>
                   <?php if($getData['foto'] !=null){ ?>
                        <img class="img-thumbnail" width="200px" src="../asets/img/fotos/<?php echo $getData['foto']; ?>"><?php
                        }else{
                            echo "<img src='../asets/img/fotos/usuario.png' class='img-fluid img-thumbnail' width=200>";
                        } ?>
                    </center>
                    </div>
                    <div class="mb-3">
                        <div class="input-group has-validation">
                            <span class="input-group-text">&#128247;</span>
                            <input type="file" class="form-control" id="foto" name="foto" required>
                        </div>
                    </div>
                    <div class="mb-3 mt-0">
                        <label class="mb-1 lead fs-6">Seleccionar el cargo</label>
                        <select class="form-select has-validation text-primary text-opacity-75 fw-semibold" aria-label="Default select example" id="rol" name="rol" required>
                            <option selected value="<?php echo $getData['id_cargo_fk'];?>"><?php switch($getData['id_cargo_fk']){
                                case 1:
                                    echo "Administrador";
                                    break;
                                case 2:
                                    echo "Desarrollador";
                                    break;
                                case 3:
                                    echo "Invitado";
                                    break;
                                default:
                                    echo "No existe dato";
                                    break;
                            }
                            ?></option>
                            <option value="1" class="lead">Administrador</option>
                            <option value="2" class="lead">Desarrollador</option>
                            <option value="3" class="lead">Invitado</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <button type="submit" name="submit" id="submit" class="btn btn-dark">Guardar Cambios</button>
                        <button type="submit" name="delete" id="delete" class="btn btn-danger">Eliminar Datos</button>
                        <span><a href="resultado.php" class="btn btn-success">Cancelar Cambio</a></span>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>