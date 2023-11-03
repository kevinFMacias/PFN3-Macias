<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 1) {
    header('Location: login.php');
    exit();
}

include('../../accions/connection.php');

$userquery = "SELECT * FROM usuarios WHERE rol_id = 2";
$resultUser = $mysqli->query($userquery);

if ($resultUser->num_rows > 0) {
    $usuarios = array();

    while ($row = $resultUser->fetch_assoc()) {
        $usuarios[] = $row;
    }
} 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">
    <script src="../../accions/modal_clases.js" defer></script>
    <script src="../../accions/modal_salir.js" defer></script>
    <!-- Icons Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <title>Administracion</title>
</head>

<body class="font-sans">
    <!-- Contenido principal -->
    <div class="flex h-screen">
        <!-- Menú lateral -->
        <div class="w-60 bg-gray-900 text-white py-6 flex flex-col justify-between">
            <div class="px-6">
                <div class="flex flex-col items-center space-y-2">
                    <img src="../../assets/logo-university.png" alt="Logo" class="max-w-full h-16">
                </div>
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center ">Menu
                    Administracion</div>
                <div class="mt-6 space-y-2">
                    <a href="../permisos_usuarios/admin_views_permisos.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-user-gear "></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="../crud_maestro/admin_views_profe.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-chalkboard-user"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="../crud_alumno/admin_views_alum.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-graduation-cap"></i>
                        <p class="px-4"> Alumnos </p>
                    </a>
                    <a href="./admin_views_clases.php" class=" flex flex-row justify-left group">
                        <i class="mr-3 text-lg fa-solid fa-tv"></i>
                        <p class="px-4"> Clases </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="../admin_db.php" class="relative  flex flex-row items-center group">
                        <i class="fa-solid fa-bars"></i>
                        <p class="px-4 text-gray-500"> Home </p>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4 text-gray-500"> Administrador </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">

                            <ul class="text-left border none">
                                <a href="../perfil_admin.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <img
                                            src="../../assets/person.svg" alt="">
                                        Perfil
                                    </li>
                                </a>
                                <a href="../../accions/logout.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"><img
                                            src="../../assets/cerrar.svg" alt="">
                                        Salir
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <i class="fa-sharp fa-solid fa-chevron-down  text-gray-300 "></i>
                    </button>
                </div>
            </nav>
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify- items-center    ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Lista de Clases </h1>
                        <div>
                            <a href="../admin_db.php" class=" text-blue-500">Home</a>/
                            <span>Maestro</span>
                        </div>
                    </div>
                </div>
                <div class="max-w-full mx-auto p-8 bg-white rounded shadow-lg mt-8">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-2xl font-semibold">Información de Clases</h3>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer"
                            id="modalToggle">
                            Agregar Clase
                        </button>
                    </div>
                    <div id="modalAdd"
                        class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                        <div class="bg-white p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-semibold mb-4">Agregar Clase</h2>
                            <form action="./agregar_clases.php" method="POST">
                                <div class="mb-2">
                                    <label for="materia" class="block font-medium">Nombre de la Materia</label>
                                    <input type="text" id="materia" name="materia"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="profesor" class="block font-medium">Maestro Disponible para la
                                        clase</label>
                                    <select id="profesor" name="profesor"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                        <?php
                                        foreach ($usuarios as $usuario) {
                                            echo '<option value="' . $usuario['id_user'] . '">' . $usuario['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button"
                                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                                        id="closeModal">Cerrar</button>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Agregar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="w-full border-collapse border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-r">#</th>
                                <th class="py-2 px-4 border-r">Materia</th>
                                <th class="py-2 px-4 border-r">Maestro</th>
                                <th class="py-2 px-4 border-r">Alumnos inscritos</th>
                                <th class="py-2 px-4 border-r">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $query  = "SELECT m.id_materia, m.materia, u.nombre, COUNT(am.id_alumate) AS cantidad_alumnos
                            FROM materias AS m
                            INNER JOIN profesor_materias AS pm ON m.id_materia = pm.id_profemate
                            INNER JOIN usuarios AS u ON pm.id_profesor = u.id_user
                            LEFT JOIN alumnos_materias AS am ON m.id_materia = am.id_alumate
                            WHERE u.rol_id = 2
                            GROUP BY m.id_materia, m.materia, u.nombre;";
                            $result = $mysqli->query($query);

                            $style = 'bg-white';
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='$style'>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['id_materia'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['materia'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['nombre'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['cantidad_alumnos'] . "</td>"; 
                                    echo "<td class='py-2 px-4 border-r flex items-center justify-center gap-3'>";
                                    echo "<button class='text-blue-500 hover:underline flex items-center justify-center updateModal'>
                                    <img src='../../assets/edit.svg' alt='edit'>
                                    </button>";
                                    echo "<form action='./delete_clases.php' method='post' class='flex items-center justify-center'>"; 
                                    echo "<input type='hidden' name='editId' value='" . $row['id_materia'] . "'>";
                                    echo "<button class='deleteBtn text-red-500 hover:underline ml-2'>
                                    <img src='../../assets/delete.svg' alt='delete'>
                                    </button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                            
                                    $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                                }
                                $result->free();
                            } else {
                                echo '<tr class="bg-white">';
                                echo '<td class="py-2 px-4 border-r" colspan="5">No se encontraron clases</td>';
                                echo '</tr>';
                            }
                            
                            ?>
                        </tbody>
                    </table>
                    <form action=""></form>
                    <div id="updateModal"
                        class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                        <div class="bg-white p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-semibold mb-4">Actualizar Clase</h2>
                            <form action="./editar_clases.php" method="POST">
                                <input type="hidden" id="updateId" name="updateId">
                                <div class="mb-2">
                                    <label for="newMateria" class="block font-medium">Nombre de la Clase:</label>
                                    <input type="text" id="newMateria" name="newMateria"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="newProfe" class="block font-medium">Maestro
                                        Asignado:</label>
                                    <select id="newProfe" name="newProfe"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                        <?php
                                        foreach ($usuarios as $usuario) {
                                            echo '<option value="' . $usuario['id_user'] . '">' . $usuario['nombre'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button"
                                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                                        id="closeUpdateModal">Cerrar</button>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                        id="updateBtn">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>