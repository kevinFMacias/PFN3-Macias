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

if ($rol_id ==  1) {
    $rol = "Administrados";
}

if ($rol_id ==  2) {
    $rol = "Maestro";
}

if ($rol_id ==  3) {
    $rol = "Alumno";
}

?>
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <link rel="stylesheet" href="/dist/output.css">
</head>

<body>
    <div class=" flex justify-center items-center w-screen">
        <div class="bg-white p-8 rounded shadow-lg w-9/12">
            <div class="flex justify-between">
                <a href="./perfil_alumno.php" class="mb-5 flex items-center justify-center bg-blue-500 text-white px-4 w-20 py-2 rounded hover:bg-blue-600">Back</a>
            </div>
            <h2 class="text-2xl font-semibold mb-4">Editar perfil</h2>
            <form action="./editar_perfil.php" method="POST" class="w-full">
                <div class="mb-4">
                    <label for="pass" class="block font-medium">Ocupacion:</label>
                    <p type="text" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300"><?= $rol ?></p>
                </div>
                <div class="mb-4">
                    <label for="dni" class="block font-medium">DNI:</label>
                    <input type="number" id="dni" name="dni" value="<?= $dni ?>" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="nombre" class="block font-medium">Nombre(s):</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="apellido" class="block font-medium">Apellido(s):</label>
                    <input type="text" id="apellido" name="apellido" value="<?= $apellido ?>" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="direccion" class="block font-medium">Dirección:</label>
                    <input type="text" id="direccion" name="direccion" value="<?= $direccion ?>" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="fecha_nacimiento" class="block font-medium">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $fechaNacimiento ?>" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="email" class="block font-medium">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="<?= $email ?>" class=" w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-4">
                    <label for="pass" class="block font-medium">Contraseña:</label>
                    <input type="password" id="pass" name="pass" placeholder="*******" class=" w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                </div>
                <div class="mb-8">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>