<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editId'];

    $deleteAlumnosMaterias = "DELETE FROM alumnos_materias WHERE id_alumno = $id";
    if ($mysqli->query($deleteAlumnosMaterias)) {
        $deleteUsuario = "DELETE FROM usuarios WHERE id_user = $id";
        if ($mysqli->query($deleteUsuario)) {
            $deleteLoginUser = "DELETE FROM login_user WHERE id_users = $id";
            $mysqli->query($deleteLoginUser);

            header('location: ./admin_views_alum.php');
        } else {
            echo "Error al eliminar usuario: " . $mysqli->error;
        }
    } else {
        echo "Error al eliminar alumnos_materias: " . $mysqli->error;
    }
} else {
    echo "Fallo en el método de solicitud.";
}
?>
