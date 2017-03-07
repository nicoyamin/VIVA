<?php

require_once '../vendor/autoload.php';

include 'scripts/db.inc.php';

$usuario = new Viva\Usuario($viva);
$db = new Viva\BaseDatos($viva);

require_once  'acceso.inc.php';

if (!userIsLoggedIn())
{
    include 'login.php';
    exit();
}
if (!userHasRole('2'))
{
    $error = 'Solo administradores pueden acceder a esta pagina';
    include 'accesoDenegado.php';
    exit();
}

$arrayUsuarios=$usuario->selectUsuarios($viva);

$titulo="Nuevo Usuario";

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
    $viva->delete("Persona",["idPersona"=>$_POST["id"]]);
    exit();
    //echo "hola";
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit')
{
    $id=$_POST["id"];
    header("Location: nuevoUsuario.php?titulo=Editar Usuario&id=$id");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'scripts/logout.inc.php'; ?>

<div class="container">
    <h2>Usuarios</h2>
    <button><a href="nuevoUsuario.php?titulo=Nuevo Usuario">Nuevo Usuario</a></button>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Documento</th>
            <th>Fecha Nacimiento</th>
            <th>Direccion</th>
            <th>Ciudad</th>
            <th>Provincia</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Celular</th>
            <th>Usuario</th>
            <th>Priviegio</th>
            <th>Fecha de Creacion</th>
            <th>Editar</th>
            <th>Eliminar</th>


        </tr>
        </thead>

        <tbody>
        <?php foreach($arrayUsuarios as $arrayUsuario):?>
        <tr>
            <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $arrayUsuario["idPersona"]; ?>">
            <td><?php echo $arrayUsuario["Nombre"];?></td>
            <td><?php echo $arrayUsuario["Apellido"];?></td>
            <td><?php echo $arrayUsuario["Documento"];?></td>
            <td><?php echo $arrayUsuario["Fecha_nacimiento"];?></td>
            <td><?php echo $arrayUsuario["Direccion"];?></td>
            <td><?php echo $arrayUsuario["Ciudad"];?></td>
            <td><?php echo $arrayUsuario["Provincia"];?></td>
            <td><?php echo $arrayUsuario["Email"];?></td>
            <td><?php echo $arrayUsuario["Telefono"];?></td>
            <td><?php echo $arrayUsuario["Celular"];?></td>
            <td><?php echo $arrayUsuario["Nombre_usuario"];?></td>
            <td><?php echo $arrayUsuario["Privilegio"];?></td>
            <td><?php echo $arrayUsuario["Fecha_creacion"];?></td>
            <td><input type="submit" name="action" value="Edit"></td>
            <td><input type="submit" name="action" value="Delete"></td>
            </form>
        </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>



<script src="js/vendor/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>


