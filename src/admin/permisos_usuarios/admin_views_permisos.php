<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 1) {
    header('Location: login.php');
    exit();
}

include('../../accions/connection.php');

$sql = "SELECT login_user.*, usuarios.*
        FROM login_user
        INNER JOIN usuarios ON login_user.id_users = usuarios.id_user";

$resulta = $mysqli->query($sql);

$rolquery = "SELECT * FROM roles";
$resulrol = $mysqli->query($rolquery);

function mostrarPermisos($resulta, $resulrol) {
    $style = 'bg-white';

    if ($resulta->num_rows > 0) {
        while ($row = $resulta->fetch_assoc()) {
            ?>
<tr class='<?php echo $style; ?>'>
    <td class='py-2 px-4 border-r'><?php echo htmlspecialchars($row['email']); ?></td>
    <td class='py-2 px-4 border-r'>
        <?php
                    // Colores condicionales según el tipo de usuario
                    $rolColor = '';
                    switch ($row['rol_id']) {
                        case 1:
                            $rolColor = 'background-color: #f7c123; padding: 4px; border-radius: 4px;';
                            echo '<span style="' . $rolColor . '">Administrador</span>';
                            break;
                        case 2:
                            $rolColor = 'background-color: #1bd0ff; padding: 4px; border-radius: 4px;';
                            echo '<span style="' . $rolColor . '">Maestro</span>';
                            break;
                        case 3:
                            $rolColor = 'background-color: #686f77; padding: 4px; border-radius: 4px;';
                            echo '<span style="' . $rolColor . '">Alumno</span>';
                            break;
                        default:
                            echo 'Rol Desconocido';
                    }
                    ?>
    </td>
    <td class='py-2 px-4 border-r flex flex-row'>
        <button class='flex items-center justify-center w-full px-2 py-1 rounded editar' onclick='editar(this)'><img
                src='../../assets/edit.svg' alt=''></button>
    </td>
</tr>
<?php
            $style = ($style == 'bg-white') ? 'bg-gray-200' : 'bg-white';
        }
    } else {
        ?>
<tr class='<?php echo $style; ?>'>
    <td class='py-2 px-4 border-r' colspan='3'>No se encontraron usuarios</td>
</tr>
<?php
    }
}

$isEditView = isset($_GET['action']) && $_GET['action'] === 'edit';
?>

<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='/dist//output.css'>
    <!-- Modal -->
    <script src='../../accions/modalPermisos.js' defer></script>
    <script src='../../accions/modal_salir.js' defer></script>

    <!-- Script Kit Fontawesome -->
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0' />
    <script src='https://kit.fontawesome.com/c852b10d16.js' crossorigin='anonymous'></script>

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
                <div class="border-t border-gray-600 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-600  pt-4 text-sm uppercase flex items-center justify-center">Menu
                    Administracion</div>
                <div class="mt-6 space-y-2">
                    <a href="./admin_views_permisos.php" class="flex flex-row justify-left  group">
                        <i class="fa-solid fa-user-gear mr-3 text-lg "></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="../crud_maestro/admin_views_profe.php" class="flex flex-row justify-left  group">
                        <i class="fa-solid fa-chalkboard-user mr-3 text-lg"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="../crud_alumno/admin_views_alum.php" class="flex flex-row justify-left  group">
                        <i class="fa-solid fa-graduation-cap mr-3 text-lg"></i>
                        <p class="px-4"> Alumnos </p>
                    </a>
                    <a href="../crud_clases/admin_views_clases.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-tv  mr-3 text-lg"></i>
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
            <section class="h-screen bg-blue-50">
                <div class="flex w-full flex-row justify-items-center">
                    <div class="flex h-10 w-full flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Lista de Permisos</h1>
                        <div>
                            <a href="../admin_db.php" class="text-blue-500">Home</a>/
                            <span>Permisos</span>
                        </div>
                    </div>
                </div>

                <div id="modal"
                    class="hidden fixed top-0 left-0 w-full h-full flex justify-center items-center bg-opacity-50 bg-black">
                    <div class="bg-white p-8 rounded-lg shadow-md w-96">
                        <h2 class="text-2xl font-semibold mb-4">Editar Permisos</h2>
                        <form action="./editar_permisos.php" method="post" class="text" id="permisosForm">
                            <input type="hidden" id="usuario_id" name="usuario_id" value="">
                            <label for="email" class="block mb-2">Email del Usuario:</label>
                            <input type="email" id="email" name="email" class="w-full p-2 border rounded mb-4" value="">

                            <label for="permiso" class="block mb-2">Rol del usuario:</label>
                            <select id="permiso" name="permiso" class="w-full p-2 border rounded mb-4">
                                <?php
                                if ($resulrol->num_rows > 0) {
                                    while ($row = $resulrol->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['id_rol'] ?>"><?= $row['rol'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>

                            <div class="flex justify-end">
                                <button type="button" id="cerrar"
                                    class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Close</button>
                                <button type="submit" id="guardarCambios"
                                    class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mx-auto p-8 bg-white">
                    <h2 class="text-2xl font-semibold mb-4">Informacion de Permisos</h2>
                    <table class="w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="py-2 px-4">Email/Usuario</th>
                                <th class="py-2 px-4">Permiso</th>
                                <th class="py-2 px-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="infoUser">
                            <?php mostrarPermisos($resulta, $resulrol); ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

</body>

</html>