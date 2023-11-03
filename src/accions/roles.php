<?php
session_start();

if (isset($_SESSION['user'])) {
    echo "funciono roles";

    switch ($_SESSION['user']['rol_id']) {
        case 1:
            header('location: ../admin/admin_db.php');
            break;
        case 2:
            header('location: ../maestro/maestro_views.php');
            break;
        case 3:
            header('location: ../alumno/alumno_views.php');
            break;
        default:
            print_r('default');
            break;
    }
} else {
    header('location: ../index.php');
}
