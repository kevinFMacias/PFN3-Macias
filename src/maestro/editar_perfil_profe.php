<?php
include("../accions/connection.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start(); 
    try {
        $id_user = intval($_SESSION["user"]["id_user"]);

        if (isset($_POST["nombre"]) && $_POST["nombre"] !== "") {
            $nombre = $_POST["nombre"];
            $mysqli->query("UPDATE usuarios SET nombre = '$nombre' WHERE id_user=$id_user");
        }
        if (isset($_POST["apellido"]) && $_POST["apellido"] !== "") {
            $apellido = $_POST["apellido"];
            $mysqli->query("UPDATE usuarios SET apellido = '$apellido' WHERE id_user=$id_user");
        }
        if (isset($_POST["dni"]) && $_POST["dni"] !== "") {
            $dni = $_POST["dni"];
            $mysqli->query("UPDATE usuarios SET dni = '$dni' WHERE id_user=$id_user");
        }
        if (isset($_POST["fecha_nacimiento"]) && $_POST["fecha_nacimiento"] !== "") {
            $fecha_nacimiento = $_POST["fecha_nacimiento"];
            $mysqli->query("UPDATE usuarios SET fecha_nacimiento = '$fecha_nacimiento' WHERE id_user=$id_user");
        }
        if (isset($_POST["direccion"]) && $_POST["direccion"] !== "") {
            $direccion = $_POST["direccion"];
            $mysqli->query("UPDATE usuarios SET direccion = '$direccion' WHERE id_user=$id_user");
        }

        if (isset($_POST["pass"]) && $_POST["pass"] !== "") {
            $pass = $_POST["pass"];
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $mysqli->query("UPDATE login_user SET pass = '$passHash' WHERE id_users=$id_user");
        }
        if (isset($_POST["email"]) && $_POST["email"] !== "") {
            $email = $_POST["email"];
            $mysqli->query("UPDATE login_user SET email = '$email' WHERE id_users =$id_user");
        }

        $loginquery = "SELECT email, pass, dni, nombre, apellido, fecha_nacimiento, direccion, rol_id, id_user FROM 
        login_user 
        LEFT JOIN usuarios ON id_user = id_users WHERE `email` = '$email'";
        $result = $mysqli->query($loginquery);
    
        if ($result) {
            $row = $result->fetch_assoc();
                session_start();
                $_SESSION['new_data'] = $row;
        }

        header("Location: ./perfil_profesor.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "ERROR AQUI : " . $e->getMessage();
    }
}
