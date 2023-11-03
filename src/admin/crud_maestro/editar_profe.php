<?php
include("../../accions/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editId'] ?? null;
    $permiso = $_POST['clase_asignada_edit'] ?? null;
    $email = $_POST['editCorreo'] ?? null;

    try {
        if ($id === null || $permiso === null || $email === null) {
            throw new Exception("Faltan datos necesarios para la actualización.");
        }

        $queryFetchClass = "SELECT id_profemate FROM profesor_materias WHERE id_profesor = ?";
        if ($stmtFetchClass = $mysqli->prepare($queryFetchClass)) {
            $stmtFetchClass->bind_param("s", $id);
            $stmtFetchClass->execute();
            $stmtFetchClass->bind_result($teacher_assigned_class);
            $stmtFetchClass->fetch();
            $stmtFetchClass->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $query = "UPDATE usuarios SET rol_id = ? WHERE id_user = ?";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("ss", $permiso, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
   
                if (isset($_POST['clase_asignada_edit'])) {
                    $materia = $_POST['clase_asignada_edit'];

                    $updateProfMate = "REPLACE INTO profesor_materias (id_profesor, id_profemate) VALUES (?, ?)";
                    if ($stmtUpdate = $mysqli->prepare($updateProfMate)) {
                        $stmtUpdate->bind_param("ss", $id, $materia);
                        $stmtUpdate->execute();
                        $stmtUpdate->close();
                    } else {
                        throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
                    }
                }

                echo "El perfil se actualizó con éxito.";
            } else {
                echo "No se encontró ningún registro que coincida con el ID del maestro.";
            }

            $stmt->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
        }

        header("Location: ./admin_views_profe.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $mysqli->close();
    }
}
?>
