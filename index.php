<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form-Login</title>
    <meta name="description" content="Diseño y Programación Web II">
    <meta name="keywords" content="Formulario de logueo">
    <meta name="author" content="Eve">
    <link rel="Shortcut icon" type="image/x-icon" href="vista/asets/img/iconos/icono.png">
    <link rel="stylesheet" type="text/css" href="vista/asets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vista/asets/css/fondo.css">
    <link rel="stylesheet" href="vista/asets/css/animaciones.css">
    <link rel="stylesheet" href="vista/asets/animate/animate.min.css">
</head>
<body class="in-circle-swoop">
    <main class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card border-info border border-4 fade-in" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="vista/asets/img/galeria/img1.jpg" alt="login form" class="img-fluid" style="border-radius: 0.7rem 0 0 0.7rem;">
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body text-black">
                                    <!-- Formulario Login -->
                                    <form action="controlador/validacion.php" method="POST" class="scale-in-center">
                                        <?php
                                            if(isset($_GET['msg'])){// obtiene el mensaje que manda el checklogin a la url
                                                echo "<center class='alert alert-danger'>".$_GET['msg']."</center>";
                                            }
                                            if(isset($_GET['msg2'])){
                                                echo "<center class='alert alert-warning fw-bold'>".$_GET['msg2']."</center>";
                                            }
                                        ?>
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="h1 fw-semibold display-5">Login</span>
                                        </div>
                                        <div class="mb-1">
                                            <input type="email" class="form-control form-control-lg" id="user" name="user">
                                            <label class="form-label">Dirección de correo electrónico</label>
                                        </div>
                                        <div class="mb-1">
                                            <input type="password" class="form-control form-control-lg" id="pass" name="pass">
                                            <label class="form-label">Contraseña</label>
                                        </div>
                                        <div class="mb-1">
                                            <button type="submit" class="btn btn-dark btn-lg btn-block" id="enviar" name="enviar">Iniciar</button>
                                            <a class="btn btn-success btn-lg btn-block" href="index.php">Limpiar</a><br>
                                            <div class="mt-2"></div>
                                            <div class="form-check form-switch mt-3 mb-4">
                                                <input type="checkbox" class="form-check-input" name="recordar" id="recordarme" value="recordar">
                                                <label class="form-check-label" for="recordarme">Recordar contraseña</label>
                                            </div>
                                            <a href="#!" class="small text-muted">¿Has olvidado tu contraseña?</a>
                                            <span class="mb-3 pb-lg-2">¿No tienes una cuenta? <a href="vista/public/registrar.php">Registrar aquí</a></span>
                                        </div>
                                        <a href="#!" class="small text-muted">Condiciones de uso</a>
                                        <a href="#!" class="small text-muted">Política de privacidad</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>