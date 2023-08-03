<?php
include("../../controlador/sesion.php");
include("../../modelo/BD/config.php");
include("../../modelo/BD/dataBase.php");
$rol_sesion=$_GET['rol_sesion'];
// $rol_sesion2=$_GET['rol_sesion2'];
$db=new DataBase();
$query="select * from usuario";
$read=$db->select($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
    <meta name="description" content="Usuarios">
    <link rel="Shortcut icon" type="image/x-icon" href="../asets/img/iconos/icono.png">
    <link rel="stylesheet" type="text/css" href="../asets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../asets/css/fondo.css">
    <link rel="stylesheet" href="../asets/css/animaciones.css">
    <!-- Librería Js Vanilla -->
    <link rel="stylesheet" href="../asets/dataTableV/jsTables/vanilla-dataTables.min.css">
    <script src="../asets/dataTableV/jsTables/vanilla-dataTables.min.js"></script>
</head>
<body>
    <section class="container bg-light mt-5 p-4 rounded fade-in">
        <main class="row my-4">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a href="resultado.php?rol_sesion=<?php echo $rol_sesion;?>" class="navbar-brand text-danger fw-semibold fs-4">Lista de usuarios</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <a href="registrar.php?rol_sesion=<?php echo $rol_sesion;?>" class="nav-link active" aria-current="page">Registrar Usuarios</a>
                                <a href="../../logout.php" class="nav-link">Cerrar Cuenta</a>
                            </div>
                        </div>
                    </div>
                </nav>
                <a href="../reportes/reporteExcel.php?rol_sesion=<?php echo $rol_sesion; ?>" class="btn btn-success mb-3">Reporte Excel</a>
                <?php
                    if(isset($_GET['msg'])){
                        date_default_timezone_set('America/La_Paz');
                        echo"<div class='alert alert-primary fw-bold fst-italic text-end'><span>".$_GET['msg']." <br>Fecha: ".date("d-m-Y")." Hora: ".date("h:i:s")."</span></div>";
                    }
                ?>
                <table class="table table.hover" id="tabla">
                    <thead>
                        <tr class="text-light bg-dark text-center">
                            <th scope="col">id_usuario</th>
                            <th scope="col">Apellido paterno</th>
                            <th scope="col">Apellido materno</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php foreach ($read as $row){?>
                        <tr>
                            <td class="bg-light text-uppercase"><?php echo $row['id_usuario'];?></td>
                            <td class="bg-light text-uppercase"><?php echo $row['apaterno'];?></td>
                            <td class="bg-light text-uppercase"><?php echo $row['amaterno'];?></td>
                            <td class="bg-light text-uppercase"><?php echo $row['nombres'];?></td>
                            <td class="bg-light"><?php echo $row['usuario'];?></td>
                            <!-- <td class="bg-light"><?php echo $row['password'];?></td> -->
                            <td class="bg-light text-success fw-semibold fst-italic"><?php
                            switch($row['id_cargo_fk']){
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
                            ?></td>
                            <td class="bg-light"><?php if($row['foto'] !=null){ ?>
                                                        <img class="img-thumbnail" width="100px" src="../asets/img/fotos/<?php echo $row['foto']; ?>"> <?php
                                                        }else{
                                                            echo "<img src='../asets/img/fotos/usuario.png' class='img-fluid img-thumbnail' width=100>";
                                                        } ?></td>
                            <td class="bg-light text-uppercase"><a href="actualizarPersonal.php?id_usuario=<?php echo urlencode($row['id_usuario']); ?>" class="btn btn-primary btn-sm">Editar</a></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </section>
    <script>
        var tabla = document.querySelector("#tabla");
        var dataTable = new DataTable(tabla);
    </script>
</body>
</html>