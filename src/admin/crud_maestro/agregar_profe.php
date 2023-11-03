<?php
include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $materia = $_POST['clase_asignada'];

        $query = "INSERT INTO usuarios (`nombre`, `apellido`, `direccion`, `fecha_nacimiento`, `rol_id`) VALUES ('$nombre', '$apellidos', '$direccion', '$fecha_nacimiento', 2)";
        $resultado = $mysqli->query($query);

        $id_generado = $mysqli->insert_id;

        session_start();
        $user = $_SESSION["user"];
        $rol_id = $user["rol_id"];
        if ($rol_id == 1) {
            $rol = "admins";
        }

        if ($rol_id == 2) {
            $rol = "maestro";
        }

        if ($rol_id == 3) {
            $rol = "alumno";
        }

        $passHashRol = password_hash($rol, PASSWORD_DEFAULT);

        if ($id_generado) {
            $queryLog = "INSERT INTO login_user (`email`,pass, id_users) VALUES ('$email','$passHashRol', $id_generado)";
            $result = $mysqli->query($queryLog);
        }

        $query_id = 'Select max(id_user) as id_users from `usuarios`';

        $result = $mysqli->query($query_id);

        $dato = $result->fetch_assoc();
        $dato_id = $dato['id_users'];

        if ($materia) {
            $queryMateria = "INSERT INTO `profesor_materias`(`id_profesor`, `id_profemate`) VALUES ($dato_id,  $materia)";
            $mysqli->query($queryMateria);
        }

        header('location: ./admin_views_profe.php');
        exit();
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}

