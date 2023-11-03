<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 3) {
    header('Location: ../../index.php');
    exit();
}

include('../accions/connection.php');

$query  = "SELECT m.id_materia, m.materia
FROM materias AS m
JOIN alumnos_materias AS am ON m.id_materia = am.id_alumate
JOIN usuarios AS u ON am.id_alumno = u.id_user
WHERE u.rol_id = 3";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">
    <script src="../accions/modal_salir.js" defer></script>
    <!-- Icons Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <title>Alumno</title>
</head>

<body class="font-sans">
    <div class="flex h-screen">
        <div class="flex h-full bg-gray-900 text-white w-60  py-6 flex-col justify-between">
            <div class="px-6">
                <div class="flex flex-col items-center space-y-2">
                    <img src="../assets/logo-university.png" alt="Logo" class="max-w-full h-16">
                </div>
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Alumno <br> <span> Nombre</span></div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center">Menu
                    Alumno</div>

                <div class="mt-6 space-y-2">
                    <div class="  ">
                        <ul class="">
                            <li class="flex flex-row justify-left group"><a href="./Views_calificacion.php"> Ver
                                    Calificaciones</a> </li>
                            <li class="flex flex-row justify-left group"> Administra tus Clases </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="./Alumno_views.php" class="relative  flex flex-row items-center group">
                        <i class="fa-solid fa-bars"></i>
                        <p class="px-4"> Home </p>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4"> Alumno </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">

                            <ul class="text-left border none">
                                <a href="./perfil_alumno.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <img src="../assets/person.svg"
                                            alt="">
                                        Perfil </li>
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
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify-center items-center    ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Esquema de Clases </h1>
                        <div>
                            <a href="./Alumno_views.php" class=" text-blue-500">Home</a>/
                            <span>Alumnos</span>
                        </div>
                    </div>
                </div>
                <div class="flex p-4 gap-2 flex-row justify-between">
                    <div class="w-1/2 ">
                        <h2 class="text-lg font-bold mb-2">Tus Materias Inscritas</h2>
                        <div class="shadow-md rounded-lg overflow-hidden">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="py-2 px-3 text-center">#</th>
                                        <th class="py-2 px-3 text-center">Materia</th>
                                        <th class="py-2 px-3 text-center">Darse de Baja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $style = 'bg-white';

                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr class='$style '>";
                                        echo "<td class='py-2 px-4 border-r'>" . $row['id_materia'] . "</td>";
                                        echo "<td class='py-2 px-4 border-r'>" . $row['materia'] . "</td>";
                                        echo "<td class='py-2 px-4 border-r'>";
                                        echo "<button class='text-blue-500 hover:underline' onclick='openUpdateModal(this)'>Retirar</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                                    }
                                    $result->free();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form action="./alegir_materia.php" method="post" class="w-1/4 pl-4">
                        <h2 class="text-lg font-bold mb-2">Materias para inscribir</h2>
                        <div class="shadow-md rounded-lg p-4 ">
                            <label for="materia" class="block font-semibold mb-2">Selecciona las materias
                                disponibles:</label>
                            <select id="materia" name="materia[]" multiple class="w-full border rounded-lg p-2 mb-4">
                                <?php
                                include("../accions/connection.php");

                                $materiaquery = "SELECT * FROM materias";

                                $resultmateria = $mysqli->query($materiaquery);
                                if ($resultmateria->num_rows > 0) {
                                    while ($row = $resultmateria->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['id_materia'] ?>"><?= $row['materia'] ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                            <button class="bg-blue-500 text-white px-3 py-1 rounded-lg ">Inscribirse</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>