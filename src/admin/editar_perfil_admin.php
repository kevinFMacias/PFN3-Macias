<?php
include("../accions/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    try {
        $id_user = intval($_SESSION["user"]["id_user"]);

        $update_user_stmt = $mysqli->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, dni = ?, fecha_nacimiento = ?, direccion = ? WHERE id_user = ?");
        $update_user_stmt->bind_param("ssisss", $_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["fecha_nacimiento"], $_POST["direccion"], $id_user);
        $update_user_stmt->execute();
        $update_user_stmt->close();

        if (isset($_POST["pass"]) && $_POST["pass"] !== "") {
            $pass = $_POST["pass"];
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $update_pass_stmt = $mysqli->prepare("UPDATE login_user SET pass = ? WHERE id_users = ?");
            $update_pass_stmt->bind_param("si", $passHash, $id_user);
            $update_pass_stmt->execute();
            $update_pass_stmt->close();
        }

        if (isset($_POST["email"]) && $_POST["email"] !== "") {
            $email = $_POST["email"];
            $update_email_stmt = $mysqli->prepare("UPDATE login_user SET email = ? WHERE id_users = ?");
            $update_email_stmt->bind_param("si", $email, $id_user);
            $update_email_stmt->execute();
            $update_email_stmt->close();
        }

        // Validación adicional si es necesario

        header("Location: ./perfil_admin.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        echo "ERROR AQUI : " . $e->getMessage() . " (Code: " . $e->getCode() . ")";
    }
}
?>
