<?php
include "../../modelo/BD/config.php";
include "../../modelo/BD/dataBase.php";
include "../../controlador/sesion.php";

header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=lista-usuarios.xls");

date_default_timezone_set('America/La_Paz');
$db=new DataBase();
$rol_sesion=$_GET['rol_sesion'];
$query="select * from usuario";
$read=$db->select($query);
?>
<table>
    <caption><h1>Empresa: XYZ Srl.</h1></caption>
    <tr>
        <th></th>
        <th>Reporte de usuarios</th>
        <th></th>
        <th>Fecha: <?php echo date("d-m-Y")?></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th>Hora: <?php echo date("h:i:s")?></th>
    </tr>
</table>
<table border="1">
    <thead>
        <tr>
            <th scope="col">id_usuario</th>
            <th scope="col">Apellido paterno</th>
            <th scope="col">Apellido materno</th>
            <th scope="col">Nombres</th>
            <th scope="col">Correo</th>
            <th scope="col">Cargo</th>
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
                <?php } ?>
            </tr>
        </tbody>
</table>