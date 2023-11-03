<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["editId"];

    // Delete from profesor_materias and alumnos_materias tables
    $deleteProfMate = "DELETE FROM profesor_materias WHERE id_profesor = $id";
    $deleteAlumMate = "DELETE FROM alumnos_materias WHERE id_alumate = $id";

    if ($mysqli->query($deleteProfMate) && $mysqli->query($deleteAlumMate)) {


        $deleteLoginUser = "DELETE FROM login_user WHERE id_users = $id";

        if ($mysqli->query($deleteLoginUser)) {
            $deleteUsuario = "DELETE FROM usuarios WHERE id_user = $id";

            if ($mysqli->query($deleteUsuario)) {
                header('location: ./admin_views_profe.php');
                exit(); 
            } else {
                echo "Error al eliminar usuario: " . $mysqli->error;
            }
        } else {
            echo "Error al eliminar login_user: " . $mysqli->error;
        }
    } else {
        echo "Error al eliminar profesores o alumnos relacionados: " . $mysqli->error;
    }
} else {
    echo "Error en la solicitud de eliminación.";
}

$mysqli->close();
?>
