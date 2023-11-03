<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST["editId"];

    $deleteAlum = "DELETE FROM alumnos_materias WHERE id_alumate = $id";
    if ($mysqli->query($deleteAlum)) {
    } else {
        echo "Error al eliminar alumnos relacionados: " . $mysqli->error;
    }
    $deleteProfe = "DELETE FROM profesor_materias WHERE id_profemate = $id";
    if ($mysqli->query($deleteProfe)) {
        $deleteMate = "DELETE FROM materias WHERE id_materia = $id";
        if ($mysqli->query($deleteMate)) {
            header('location: ./admin_views_clases.php');
        } else {
            echo "Error al eliminar materias relacionadas: " . $mysqli->error;
        }
    } else {
        echo "Error al eliminar profesores relacionados: " . $mysqli->error;
    }
} else {
    echo "Error en la solicitud de eliminación.";
}

$mysqli->close();
