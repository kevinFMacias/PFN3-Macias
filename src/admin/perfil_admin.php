<?php
session_start();
$user = $_SESSION["user"];

$email = $user["email"];
$dni = $user["dni"];
$nombre = $user["nombre"];
$apellido = $user["apellido"]; 
$fechaNacimiento = $user["fecha_nacimiento"];
$direccion = $user["direccion"];
$rol_id = $user["rol_id"];

if($rol_id ==  1){
   $rol = "Administrados";
}

if($rol_id ==  2){
   $rol = "Maestro";
}

if($rol_id ==  3){
   $rol = "Alumno";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="/dist/output.css">
</head>

<body>
    <div class=" flex justify-center items-center w-screen">
        <div class="bg-white p-8 rounded shadow-lg w-11/12 ">
            <div class="flex justify-between">
                <a href="./admin_db.php" class="mb-5 flex items-center justify-center bg-gray-900 text-white px-4 w-20 py-2 rounded hover:bg-blue-600">Back</a>
                <a href="./views_perfil_editar.php" class="mb-5 flex items-center justify-center bg-blue-500 text-white px-4 w-20 py-2 rounded hover:bg-blue-600">editar</a>
            </div>
                <h2 class="text-2xl font-semibold mb-4">Perfil</h2>
            <div class="mb-4">
                <label for="pass" class="block font-medium">Ocupacion:</label>
                <p type="text" id="pass" name="pass" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $rol ?></p>
            </div>
            <div class="mb-4">
                <label for="dni" class="block font-medium">DNI:</label>
                <p type="number" id="dni" name="dni" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-b-blue-300"><?= $dni ?></p>
            </div>
            <div class="mb-4">
                <label for="nombre" class="block font-medium">Nombre(s):</label>
                <p type="text" id="nombre" name="nombre" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $nombre ?></p>
            </div>
            <div class="mb-4">
                <label for="apellidos" class="block font-medium">Apellido(s):</label>
                <p type="text" id="apellidos" name="apellidos" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $apellido ?></p>
            </div>
            <div class="mb-4">
                <label for="direccion" class="block font-medium">Dirección:</label>
                <p type="text" id="direccion" name="direccion" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $direccion ?></p>
            </div>
            <div class="mb-4">
                <label for="fecha_nacimiento" class="block font-medium">Fecha de Nacimiento:</label>
                <p type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $fechaNacimiento ?></p>
            </div>
            <div class="mb-4">
                <label for="correo" class="block font-medium">Correo Electrónico:</label>
                <p type="email" id="correo" name="correo" class=" w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $email ?></p>
            </div>
            <div class="mb-4">
                <label for="correo" class="block font-medium">Contraseña:</label>
                <p type="email" id="correo" name="correo" class=" w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">**********</p>
            </div>
        </div>
    </div>
</body>

</html>