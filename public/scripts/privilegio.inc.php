<?php

include("acceso.inc.php");

if (!userIsLoggedIn())
{
include '../login.php';
exit();
}
if (!userHasRole('2'))
{
$error = 'Solo administradores pueden acceder a esta pagina';
include '../accesoDenegado.php';
exit();
}