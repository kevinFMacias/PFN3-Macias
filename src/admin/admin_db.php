<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 1) {
    header('Location: ../../perfil_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <!-- Modal -->
    <script src="../../src/accions/modal_salir.js" defer></script>

    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <title>Administracion</title>
</head>


<body class="font-sans">
    <div class="flex h-screen">
        <!-- Menú lateral -->
        <div class="flex h-full bg-gray-900 text-white w-60 py-6 flex-col justify-between">
            <div class="px-6">         
                <div class="flex flex-col items-center space-y-2">
                    <img src="../assets/logo-university.png" alt="Logo" class="max-w-full h-16">
                </div>
                <div class="border-t border-gray-700 mb-2 pt-4 text-sm">Administrador</div>
                <div class="border-t border-gray-700 pt-4 text-sm uppercase flex items-center justify-center">Menu
                    Administracion</div>
                    
                <div class="mt-6 space-y-2">
                    <a href="./permisos_usuarios/admin_views_permisos.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-user-gear mr-3 text-lg"></i>
                        <p class="px-4"> Permisos </p>
                    </a>
                    <a href="./crud_maestro/admin_views_profe.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-chalkboard-user mr-3 text-lg"></i>
                        <p class=" px-4"> Maestros </p>
                    </a>
                    <a href="./crud_alumno/admin_views_alum.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-graduation-cap mr-3 text-lg"></i>
                        <p class="px-4"> Alumnos </p>
                    </a>
                    <a href="./crud_clases/admin_views_clases.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-tv  mr-3 text-lg"></i>
                        <p class="px-4"> Clases </p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">
            
            <!-- Barra de navegación -->
            <nav class="flex h-10 w-full flex-row justify-between items-center">
                <div class="flex flex-row justify-items-stretch">
                    <a href="./admin_db.php" class="relative flex flex-row items-center group">
                        <i class="fa-solid fa-bars"></i>
                        <p class="px-4 text-gray-400 hover:text-gray-600 "> Home </p>
                        <div class="absolute hidden group-focus:block top-full min-w-full w-max bg-white  mt-1 rounded">
                            <ul class="text-left border none">
                                <li class="px-4 py-1 border-b"><a href="Adm_Das_Per.php">Permisos</a></li>
                                <li class="px-4 py-1"><a href="Adm_Das_Maes.php">Maestro</a></li>
                                <li class="px-4 py-1"><a href="Adm_Das_Alum.php">Alumnos</a></li>
                                <li class="px-4 py-1"><a href="Adm_Das_Class.php">Clases</a></li>
                            </ul>
                        </div>
                    </a>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4 text-gray-500"> Administrador </p>
                        <div id="toggleMenu" class=" absolute top-full min-w-full w-max bg-white mt-1 rounded hidden">
                            <ul class="text-left border none">
                                <a href="../perfil_admin.php">
                                    <li class="px-4 py-1 border-b flex flex-row gap-3"> <img src="../assets/person.svg"
                                            alt="">
                                        Perfil
                                    </li>
                                </a>
                                <a href="../../accions/logout.php">
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
            <section class="h-screen bg-blue-50">
                <div class="flex w-full flex-row justify-items-center">
                    <div class="flex h-10 w-full flex-row justify-between items-center">
                        <h1 class="text-2xl font-semibold">Dashboard</h1>
                        <div>
                            <a href="#" class="text-blue-600">Home</a>/
                            <span>Dashboard</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 items-start">
                    <div
                        class="w-120 h-20 bg-white border border-gray-300 shadow-md flex flex-col justify-center items-start text-sm p-4">
                        <p>Bienvenido<br> Selecciona la acción que quieras realizar en las pestañas del menú de la
                            izquierda</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>