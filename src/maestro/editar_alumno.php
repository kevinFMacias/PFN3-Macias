<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $calificacion = $_POST["calificacion"];
    $mensaje = $_POST["mensaje"];
    $id = $_POST["id_user"];

    try{
        include("../accions/connection.php");
        
        $mysqli->query("UPDATE alumnos_materias SET `calificacion`='$calificacion', `mensajes`='$mensaje' WHERE `id_am` = $id");

        header("Location: ./profe_views_alum.php");

    }catch(mysqli_sql_exception $e){
        echo "ERROR" . $e->getMessage();
    }

}
