<?php
include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $correo = $_POST['editEmail']; // Cambié 'correo' a 'editEmail'
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];

        $query = "INSERT INTO usuarios (`dni`, `nombre`, `apellido`, `direccion`, `fecha_nacimiento`, `rol_id`) VALUES (?, ?, ?, ?, ?, 3)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssss", $dni, $nombre, $apellidos, $direccion, $fecha_nacimiento);
        $stmt->execute();

        $dato_id = $mysqli->insert_id;

        if ($stmt->affected_rows > 0) {
            session_start();
            $user = $_SESSION["user"];
            $rol_id = $user["rol_id"];

            if ($rol_id == 1) {
                $rol = "admins";
            } elseif ($rol_id == 2) {
                $rol = "maestro";
            } elseif ($rol_id == 3) {
                $rol = "alumno";
            }

            $passHashRol = password_hash($rol, PASSWORD_DEFAULT);

            $querycontra = "INSERT INTO login_user (`id_users`, `email`, `pass`) VALUES (?, ?, ?)";
            $stmtContra = $mysqli->prepare($querycontra);
            $stmtContra->bind_param("sss", $dato_id, $correo, $passHashRol);
            $stmtContra->execute();

            if ($stmtContra->affected_rows > 0) {
                header('location: ./admin_views_alum.php?success=true');
                exit();
            } else {
                header('location: ./admin_views_alum.php?success=false&reason=login_user_insert_error');
                exit();
            }
        } else {
            header('location: ./admin_views_alum.php?success=false&reason=usuarios_insert_error');
            exit();
        }
    } catch (Exception $e) {
        error_log("Error al agregar alumno: " . $e->getMessage());
        header('location: ./admin_views_alum.php?success=false&reason=unexpected_error');
        exit();
    }
}
?>
