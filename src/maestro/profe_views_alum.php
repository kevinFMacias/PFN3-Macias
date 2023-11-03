<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 2) {
    header('Location: ../index.php');
    exit();
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">
    <script src="../accions/modal_calificacion.js" defer></script>
    <script src="../accions/modal_salir.js" defer></script>
    <!-- Icons Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <title>Maestro</title>
</head>

<body>
    <div class="w-screen h-screen flex">
        <!-- Menú lateral -->
        <div class="flex h-full bg-gray-900 text-white w-60  py-6 flex-col justify-between">
            <div class="px-6">
                <div class="flex flex-col items-center space-y-2">
                    <img src="../assets/logo-university.png" alt="Logo" class="max-w-full h-16">
                </div>
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Maestro <br> <span> Nombre</span></div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center">Menu
                    Maestro</div>
                <div class="mt-6 space-y-2">
                    <button class="flex flex-row justify-center group">
                        <a href="#" class="flex items-center justify-center">
                            <i class="mr-3 text-lg fa-solid fa-graduation-cap"></i>
                            <p class="px-4">Alumnos</p>
                        </a>
                        <div class="hidden group-focus:block top-full min-w-full w-max mt-1 rounded">
                            <ul class="text-left none align-bottom">
                            </ul>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <!-- Barra de navegación -->
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="./maestro_views.php" class="relative  flex flex-row items-center group">
                        <i class="fa-solid fa-bars"></i>
                        <p class="px-4 text-gray-500"> Home </p>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4"> Maestro </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">

                            <ul class="text-left border none">
                                <a href="./perfil_profesor.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <img src="../assets/person.svg"
                                            alt="">
                                        Perfil
                                    </li>
                                </a>
                                <a href="../accions/logout.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"><img src="../assets/cerrar.svg"
                                            alt="">
                                        Salir
                                    </li>
                                </a>
                            </ul>
                        </div>
                        <i class="text-gray-300 fa-sharp fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </nav>

            <!-- Contenido del dashboard -->
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify- items-center    ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium">Alumos de la clase Maestro</h1>
                        <div>
                            <a href="#" class="text-blue-700">Home</a>/
                            <span>Maestro</span>
                        </div>
                    </div>
                </div>

                <div class="max-w-full mx-auto p-8 bg-white rounded shadow-lg mt-8">
                    <div class="container mx-auto p-4">
                        <div class="flex justify-between mb-4">
                            <h2 class="text-2xl font-semibold">Alumnos de la clase</h2>
                        </div>

                        <div id="modal"
                            class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                            <div class="bg-white p-8 rounded shadow-lg w-1/2">
                                <h2 class="text-2xl font-semibold mb-4">Editar calificacion y el mensaje</h2>
                                <form action="./editar_alumno.php" method="POST">
                                    <input type="hidden" name="id_user">
                                    <div class="mb-2">
                                        <label for="calificacion" class="block font-medium">Nueva calificacion</label>
                                        <input type="number" id="calificacion" name="calificacion"
                                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="mb-2">
                                        <label for="mensaje" class="block font-medium">Editar Mensaje</label>
                                        <input type="text" id="mensaje" name="mensaje"
                                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                    </div>
                                    <div class="flex justify-end gap-2 mt-6">
                                        <button type="button"
                                            class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                                            onclick="cerrarModal()">Cerrar</button>
                                        <button type="submit"
                                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                            id="createBtn">Editar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-2 px-4">#</th>
                                    <th class="py-2 px-4">Nombre de Alumno</th>
                                    <th class="py-2 px-4">Calificación</th>
                                    <th class="py-2 px-4">Mensajes</th>
                                    <th class="py-2 px-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include('../accions/connection.php');

                                $query  = "SELECT am.id_am, am.calificacion, u.nombre, am.mensajes
                                FROM materias AS m
                                JOIN alumnos_materias AS am ON m.id_materia = am.id_alumate
                                JOIN usuarios AS u ON am.id_alumno = u.id_user
                                WHERE u.rol_id = 3";

                                $result = $mysqli->query($query);

                                $style = 'bg-white';
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='$style '>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['id_am'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['nombre'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['calificacion'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['mensajes'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>";
                                    echo '<button class="text-blue-500 hover:underline w-full flex items-center justify-center mb-4" onclick="abrirModal(this)" id_usuario="' . $row['id_am'] . '" > <img src="../assets/edit.svg" alt="edit"></button>';
                                    echo "</td>";
                                    echo "</tr>";
                                    $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                                }

                                $result->free();
                                ?>
                            </tbody>
                        </table>

                        <div class="mt-4 flex justify-center">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>