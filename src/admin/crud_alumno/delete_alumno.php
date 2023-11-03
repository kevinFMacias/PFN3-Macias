<?php
require_once('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editId'];

    $deleteLoginUser = "DELETE FROM login_user WHERE id_users = $id";
    if ($mysqli->query($deleteLoginUser)) {
        $deleteUsuario = "DELETE FROM usuarios WHERE id_user = $id";
        if ($mysqli->query($deleteUsuario)) {
            header('location: ./admin_views_alum.php');
        } else {
            echo "Error al eliminar usuario: " . $mysqli->error;
        }
    } else {
        echo "Error al eliminar login_user: " . $mysqli->error;
    }
} else {
    echo "Fallo en el método de solicitud.";
}
?>

