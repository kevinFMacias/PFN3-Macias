
<?php
include("../accions/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        $id_user = $user["id_user"];

        // Validar y obtener el valor de materia
        $materia = isset($_POST["materia"]) ? $_POST["materia"] : null;
          $mate = intval($materia);
          $id = intval($id_user);
        var_dump($id);
        var_dump($mate);

        if ($materia !== null) {
            try {
                $queryElegir = "UPDATE alumnos_materias SET id_alumate = ? WHERE id_alumno = ?";
                $stmt = $mysqli->prepare($queryElegir);
                $stmt->bind_param("ii", $mate, $id);

                if ($stmt->execute()) {
                    echo "funciono";
                    header("Location: ./alumno_materias.php");
                    die(); 
                } else {
                    echo "Error al ejecutar la consulta." . $stmt->error;
                }
            } catch (mysqli_sql_exception $e) {
                echo "ERROR " . $e->getMessage();
            }
        } else {
            echo "Materia no seleccionada.";
        }
    } else {
        echo "Sesión no iniciada o usuario no encontrado.";
    }
}
?>
