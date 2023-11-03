<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $permiso = $_POST['permiso'];
    $email = $_POST["email"];
    
    try {
        include("../../accions/connection.php");
        
        $query = "UPDATE usuarios
                  SET rol_id = ?
                  WHERE id_user IN (SELECT id_users FROM login_user WHERE email = ?)";
        
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("ss", $permiso, $email);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "El rol se actualizó con éxito.";
            } else {
                echo "No se encontró ningún registro que coincida con el correo electrónico.";
            }
            
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $mysqli->error;
        }
        
        header("Location: ./admin_views_permisos.php");
        $mysqli->close();
    } catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
    }
}
?>
