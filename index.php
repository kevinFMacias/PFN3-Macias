<?php
include("./src/accions/connection.php");

$mensaje = null;

if (isset($_POST["email"]) && isset($_POST["pass"])) {
    $pass = $_POST["pass"];
    $email = $_POST["email"];

    $loginquery = "SELECT email, pass, dni, nombre, apellido, fecha_nacimiento, direccion, rol_id, id_user 
                    FROM login_user 
                    LEFT JOIN usuarios ON id_user = id_users 
                    WHERE `email` = ?";

    $stmt = $mysqli->prepare($loginquery);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();

        if ($row !== null) {
            session_start();
            $_SESSION['user'] = $row;

            $hash = $row["pass"];

            if (password_verify($pass, $hash)) {
                header("Location: ../../src/accions/roles.php");
                exit();
            } else {
                $mensaje = showError("Credenciales invalidas. <br>Intentelo nuevamente.");
            }
        } else {
            $mensaje = showError("Credenciales invalidas. <br>Intentelo nuevamente.");
        }
    } else {
        die('Error en la consulta: ' . $mysqli->error);
    }
}

function showError($message) {
    return '<div class="bg-red-500 text-white border border-red-600 rounded px-4 py-2 mb-4">' . $message . '</div>';
}

$mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/302e5dde8e.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body class="flex items-center justify-center h-screen bg-[#fff5d2]">
    <div class="container flex items-center justify-center">
        <div class="flex-shrink-0 mr-4">
            <img class="w-96" src="./src/assets/logo-university.png" alt="logo">
        </div>
        <div class="p-8 rounded-lg shadow-md bg-white flex flex-col items-center">
            <?= $mensaje ?>

            <h2 class="text-gray-500 font-bold mb-4 text-center">Bienvenido, Ingresa con tu cuenta</h2>

            <form method="post" action="/index.php" class="w-full max-w-[360px] flex flex-col gap-6">

                <label class="flex items-center gap-4 px-2 h-10 border rounded-md border-gray-400">
                    <input type="text" name="email" id="email" placeholder="Email" class="h-full w-full outline-none">
                    <i class="fa-solid fa-envelope text-gray-400"></i>
                </label>

                <label class="flex items-center gap-4 px-2 h-10 border rounded-md border-gray-400">
                    <input type="password" name="pass" id="pass" placeholder="Password" class="h-full w-full outline-none">
                    <i class="fa-solid fa-lock text-gray-400"></i>
                </label>

                <div class="flex justify-end">
                    <button type="submit" class="w-1/2 bg-blue-500 text-white rounded-md py-2 px-4 focus:outline-none hover:bg-indigo-700">
                        Ingresar
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>






</html>
