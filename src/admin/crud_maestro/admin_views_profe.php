<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 1) {
    header('Location: login.php');
    exit();
}

include('../../accions/connection.php');

$sql = "SELECT `id_user`,`nombre`,`apellido`,`email`,`direccion`,`fecha_nacimiento`,`materia`,`id_materia` FROM materias LEFT JOIN `profesor_materias` on materias.id_materia = profesor_materias.id_profemate RIGHT JOIN `usuarios` on profesor_materias.id_profesor = usuarios.id_user LEFT JOIN `login_user` on id_user = login_user.id_users WHERE rol_id=2";
$result = $mysqli->query($sql);

$querymateria = "SELECT id_materia, materia FROM materias";
$resultmateria = $mysqli->query($querymateria);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist//output.css">
    <!-- Modal -->
    <script src="../../accions/modal_profesor.js" defer></script>
    <script src="../../accions/modal_salir.js" defer></script>

    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <title>Administrar Maestros</title>
</head>

<body class="font-sans">
    <!-- Contenido principal -->
    <div class="flex h-screen">
        <!-- Menú lateral -->
        <div class="w-60 bg-gray-900 text-white py-6 flex flex-col justify-between">
            <!-- Menú lateral -->
            <div class="px-6">
                <div class="flex flex-col items-center space-y-2">
                    <img src="../../assets/logo-university.png" alt="Logo" class="max-w-full h-16">
                </div>
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center">Menu
                    Administracion</div>
                <div class="mt-6 space-y-2">
                    <a href="../permisos_usuarios/admin_views_permisos.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-user-gear "></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="./admin_views_profe.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-chalkboard-user"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="../crud_alumno/admin_views_alum.php" class=" flex flex-row justify-left  group">
                        <i class="mr-3 text-lg fa-solid fa-graduation-cap"></i>
                        <p class="px-4"> Alumnos </p>
                    </a>
                    <a href="../crud_clases/admin_views_clases.php" class=" flex flex-row justify-left group">
                        <i class="mr-3 text-lg fa-solid fa-tv"></i>
                        <p class="px-4"> Clases </p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            <!-- Barra de navegación -->
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <a href="../admin_db.php" class="relative  flex flex-row items-center group">
                        <i class="fa-solid fa-bars"></i>
                        <p class="px-4 text-gray-400"> Home </p>
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
                        <i class="text-gray-300 fa-sharp fa-solid fa-chevron-down"></i>
                    </button>
                </div>
            </nav>

            <!-- Contenido del dashboard -->
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify-items-center">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Lista de Maestro </h1>
                        <div>
                            <a href="../admin_db.php" class=" text-blue-500">Home</a>/
                            <span>Maestros</span>
                        </div>
                    </div>
                </div>
                <div class="max-w-full mx-auto p-8 bg-white rounded shadow-lg mt-8">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-2xl font-semibold">Informacion de Maestros</h3>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer"
                            id="modalToggle">
                            Agregar Maestro
                        </button>
                    </div>

                    <div id="modal"
                        class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                        <div class="bg-white p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-semibold mb-4">Agregar Maestro</h2>
                            <form action="./agregar_profe.php" method="POST">
                                <div class="mb-2">
                                    <label for="email" class="block font-medium">Correo Electrónico:</label>
                                    <input type="email" id="email" name="email"
                                        placeholder="Ingresa el correo electrónico"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="nombre" class="block font-medium">Nombre(s):</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="apellido" class="block font-medium">Apellido(s):</label>
                                    <input type="text" id="apellido" name="apellido" placeholder="Ingresa los apellidos"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="direccion" class="block font-medium">Dirección:</label>
                                    <input type="text" id="direccion" name="direccion"
                                        placeholder="Ingresa la dirección"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="fecha_nacimiento" class="block font-medium">Fecha de Nacimiento:</label>
                                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>

                                <!-- Agregar Maestro -->
                                <div class="mb-2">
                                    <label for="clase_asignada" class="block font-medium">Clase Asignada:</label>
                                    <select id="clase_asignada_add" name="clase_asignada"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                        <option selected value="">Selecciona materia</option>
                                        <?php
                                            if ($resultmateria->num_rows > 0) {
                                                while ($row = $resultmateria->fetch_assoc()) {
                                            ?>
                                        <option value="<?= $row['id_materia'] ?>"><?= $row['materia'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button"
                                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500"
                                        id="closeModal">Cerrar</button>
                                    <button type="submit"
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                        id="createBtn">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="updateModal"
                        class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                        <div class="bg-white p-8 rounded shadow-lg w-1/2">
                            <h2 class="text-2xl font-semibold mb-4">Actualizar Maestro</h2>
                            <form action="./editar_profe.php" method="POST">
                                <input type="hidden" id="editId" name="editId">
                                <div class="mb-2">
                                    <label for="editCorreo" class="block font-medium">Correo Electrónico:</label>
                                    <input type="email" id="editCorreo" name="editCorreo"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editNombre" class="block font-medium">Nombre(s):</label>
                                    <input type="text" id="editNombre" name="editNombre"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editApellidos" class="block font-medium">Apellidos:</label>
                                    <input type="text" id="editApellidos" name="editApellidos"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editDireccion" class="block font-medium">Direccion:</label>
                                    <input type="text" id="editDireccion" name="editDireccion"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>
                                <div class="mb-2">
                                    <label for="editfecha_nacimiento" class="block font-medium">Fecha de
                                        Nacimiento:</label>
                                    <input type="date" id="editfecha_nacimiento" name="editfecha_nacimiento"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                </div>

                                <!-- Editar Maestro -->
                                <div class="mb-2">
                                    <label for="clase_asignada" class="block font-medium">Clase Asignada:</label>
                                    <select id="clase_asignada_edit" name="clase_asignada"
                                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">
                                        <option value="">Selecciona materia</option>
                                        <?php
                                            if ($resultmateria->num_rows > 0) {
                                                while ($row = $resultmateria->fetch_assoc()) {
                                            ?>
                                        <option value="<?= $row['id_materia'] ?>"><?= $row['materia'] ?></option>
                                        <?php
                                            }
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
                                        id="updateBtn">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <table class=" w-full border-collapse border" id="tablaMaestros">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4 border-r">id</th>
                                <th class="py-2 px-4 border-r">Nombre</th>
                                <th class="py-2 px-4 border-r">Apellido</th>
                                <th class="py-2 px-4 border-r">Email</th>
                                <th class="py-2 px-4 border-r">Dirección</th>
                                <th class="py-2 px-4 border-r">Fec. Nacimiento</th>
                                <th class="py-2 px-4 border-r">Clase Asignada</th>
                                <th class="py-2 px-4 border-r">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $style = 'bg-white';
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr class='$style '>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['id_user'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['nombre'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['apellido'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['email'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['direccion'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['fecha_nacimiento'] . "</td>";
                                    echo "<td class='py-2 px-4 border-r'>" . $row['materia'] . "</td>";
                                    echo '<td class="py-2 px-4 border-r flex items-center justify-center">';
                                    echo '<button class="text-blue-500 hover:underline" onclick="openUpdateModal(this)"><img src="../../assets/edit.svg" alt=""></button>';
                                    echo " <form action='./delete_profe.php' method='post' class='flex items-center justify-center'>  
                                <input type='hidden' class='editId'' name='editId'> 
                                <button class='deleteBtn text-red-500 hover:underline ml-2' >
                                <img src='../../assets/delete.svg' alt='delete'>
                                </button> 
                                </form> ";
                                    echo '</td>';
                                    echo '</tr>';
                                    $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
                                }
                            } else {
                                echo '<tr class="bg-white">';
                                echo '<td class="py-2 px-4 border-r" colspan="7">No se encontraron maestros</td>';
                                echo '</tr>';
                            }
                            $mysqli->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </div>
</body>

</html>