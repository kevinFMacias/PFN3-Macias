<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['rol_id'] != 2) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/output.css">
    <script src="../accions/modal_salir.js" defer></script>
    <!-- Icons Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Script Kit Fontawesome -->
    <script src="https://kit.fontawesome.com/c852b10d16.js" crossorigin="anonymous"></script>
    <title>Maestro</title>

</head>

<body class="font-sans">
    <div class="flex h-screen">
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
                    <a href="./profe_views_alum.php" class="flex flex-row justify-left group">
                        <i class="fa-solid fa-graduation-cap mr-3 text-lg"></i>
                        <p class="px-4">Alumnos</p>
                        <div class="hidden group-focus:block top-full min-w-full w-max mt-1 rounded">
                            <ul class="text-left none align-bottom">
                                <li class="px-4 py-1"><a href="maest_Dash_list.php"></a>Lista de Alumnos</li>
                            </ul>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex flex-col w-[calc(100%-15rem)] px-2">

            <!-- Barra de navegación -->
            <nav class="flex h-10 w-full  flex-row justify-between items-center">
                <div class=" flex flex-row justify-items-stretch">
                    <button class="relative  flex flex-row items-center group">
                        <a href="./maestro_views.php" class="flex flex-row items-center">
                            <i class="fa-solid fa-bars"></i>
                            <p class="px-4 text-gray-500"> Home </p>
                        </a>
                        <div class="absolute hidden group-focus:block top-full min-w-full w-max bg-white  mt-1 rounded">
                            <ul class="text-left border none">
                                <li class=" px-4 py-1"> Alumnos</li>
                            </ul>
                        </div>
                    </button>
                </div>
                <div class=" flex flex-row justify-between items-center">
                    <button id="buttonToggle" class="relative flex justify-center items-center group">
                        <p class="px-4 text-gray-500"> Maestro </p>
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
                        <i class="fa-sharp fa-solid fa-chevron-down  text-gray-300"></i>
                    </button>
                </div>
            </nav>

            <!-- Contenido del dashboard -->
            <section class=" h-screen bg-blue-50">
                <div class="flex  w-full flex-row justify- items-center    ">
                    <div class="flex h-10 w-full  flex-row justify-between items-center">
                        <h1 class="text-2xl font-medium"> Dashboard</h1>
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