<?php

include('../../accions/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $materia =  $_POST['materia'];
        $profesor =  $_POST['profesor'];
        var_dump($_POST);

        $querycontra = "INSERT INTO `materias`(`materia`) VALUES ('$materia')";
        $mysqli->query($querycontra);
        $id_generado = $mysqli->insert_id;

        $insertar = "INSERT INTO `profesor_materias`(`id_profesor`, `id_profemate`) 
        VALUES ('$profesor', '$id_generado')";
        $mysqli->query($insertar);

        var_dump($id_generado);

        header('location: ./admin_views_clases.php');

        exit();
    } catch (mysqli_sql_exception $e) {
        echo "Error" . $e->getMessage();
    }
}
