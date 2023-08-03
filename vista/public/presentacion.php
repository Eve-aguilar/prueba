<?php
include "../../controlador/sesion.php";
include "../../modelo/BD/config.php";
include "../../modelo/BD/dataBase.php";

$rol_sesion=$_GET['rol_sesion'];
$db=new DataBase();

$rol_query="select apaterno from usuario where id_usuario='$rol_sesion'";
$read=$db->select($rol_query);
foreach($read as $row){
    $apaterno=($row['apaterno']);
}
$rol_sesion2=$_GET['rol_sesion2'];
// Obtener el rol del usuario
$rol_grado="select nombre_cargo from cargo where id_cargo='$rol_sesion2'";
$read2=$db->select($rol_grado);
foreach($read2 as $rows){
    $roles=($rows['nombre_cargo']);
}
$titulo="Curso DPW-II, proyecto SEGUNDA ETAPA";
$subtitulo1="Nombre del proyecto: ";
$parrafo="Debes de colocar el titulo que llevará tu proyecto final";
$subtitulo2="Objetivo General del proyecto:";
$parrafo2="Debe de colocar el objetivo general de tu propuesta que estás enmarcando en taller de grado";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <meta name="descripcion" content="Curso de php desde cero Segundo Año">
    <link rel="shotcut icon" type="image/x-icon" href="">
    <link rel="stylesheet" type="text/css" href="../asets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../asets/css/fondo.css">
    <link rel="stylesheet" href="../asets/css/animaciones.css">
    <!-- Librería Js Vanilla -->
    <link rel="stylesheet" href="../asets/dataTableV/jsTables/vanilla-dataTables.min.css">
    <script src="../asets/dataTableV/jsTables/vanilla-dataTables.min.js"></script>
</head>
<body>
    <section class="container-fluid bg-light mt-5 p-4 rounded fade-in">
        <nav class="navbar navbar-expand-lg bg-light border border-info border rounded mb-3">
            <div class="container-fluid">
                <a href="presentacion.php?rol_sesion=<?php echo $rol_sesion;?>" class="navbar-brand fs-3 text-dark fw-semibold">Nombre Sistema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item boton"><a href="presentacion.php?rol_sesion=<?php echo $rol_sesion;?>" class="nav-link text-dark lead active" aria-current="page">Inicio</a></li>
                        <li class="nav-item boton"><a href="registrar.php?rol_sesion=<?php echo $rol_sesion;?>" class="nav-link text-dark lead">Registrar</a></li>
                        <li class="nav-item boton"><a href="resultado.php?rol_sesion=<?php echo $rol_sesion;?>" class="nav-link text-dark lead">Mostrar Lista</a></li>
                        <li class="nav-item boton"><a href="../../logout.php?=<?php echo $rol_sesion;?>" class="nav-link text-dark lead">Salir del Sistema</a></li>
                    </ul>
                    <span class="navbar-text">
                        <a href="presentacion.php?rol_sesion=<?php echo $rol_sesion;?>" class="navbar-brand">
                            <img src="../asets/img/galeria/foto1.jpeg" alt="" width="40" height="40" class="img-fluid align-content-md-around">
                            <span class="px-2 text-light text-dark fst-italic">Bienvenido: <?php echo $apaterno." - ".$roles;?></span>
                        </a>
                    </span>
                </div>
            </div>
        </nav>
        <main class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <article class="mt-5" style="text-align: justify;">
                    <h3 class="display-4 text-uppercase text-center font-weight-bold"><?php echo $titulo;?></h3>
                    <hr class="mb-5">
                    <h4 class="text-uppercase text-danger font-italic"><?php echo $subtitulo1;?></h4>
                    <p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo;?></p>
                    <h4 class="text-uppercase text-danger font-italic"><?php echo $subtitulo2;?></h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent"><p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo2;?></p></li>
                        <li class="list-group-item bg-transparent"><p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo2;?></p></li>
                        <li class="list-group-item bg-transparent"><p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo2;?></p></li>
                        <li class="list-group-item bg-transparent"><p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo2;?></p></li>
                        <li class="list-group-item bg-transparent"><p class="lead text-justify font-weight-bold font-italic"><?php echo $parrafo2;?></p></li>
                    </ul>
                </article>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <center>
                    <figure class="figure">
                        <img src="../asets/img/galeria/foto1.jpeg" alt="..." class="figure-img img-fluid rounded img-thumbnail">
                        <figcaption class="figure-caption text-end">Evelyn Aguilar Vargas</figcaption>
                    </figure>
                </center>
            </div>
        </main>
    </section>
    <div class="large"></div>
</body>
</html>