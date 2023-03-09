<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    http_response_code(404);
    header('Location: ../../index.php');
}

require_once('../../main.php');
require_once(BaseDir . '/models/database/database.php');
require_once(BaseDir . '/models/user.php');
$user = getUser($_SESSION['user_id']);
$resultsUser = getUser($_SESSION['user_id']);
if ($resultsUser['rol'] === '2') {
    $planes = getTipoSuscripcion();
} else {
    http_response_code(404);
    header('Location: ../../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="../../views/assets/img/logo.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="../../views/assets/css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="../../views/assets/bootstrap/css/bootstrap.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="../../views/assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="../../views/assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="../../views/assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="../../views/assets/css/responsive.css">
    <link rel="stylesheet" href="../css/es.css">
    <title>planes</title>
</head>

<body>
    <?php include('../../views/templates/navBar.php') ?>
    <main class="container">
        <div class="container">
            <div class="row">
                <div class="col-12" style="margin-top: 6rem;">
                    <h1>Planes</h1>

                    <?php foreach ($planes as $key) { ?>
                        <form action="" method="post" class="form" style="display:inline-block;">
                            <table border="2px">
                                <?php foreach ($key as $valkey => $value) { ?>

                                    <tr>
                                        <td>
                                            <label for="<?= $valkey ?>"><?= $valkey ?></label>
                                        </td>
                                        <td>
                                            <input class="form-control" type="" name="<?= $valkey ?>" id="<?= $valkey ?>" value="<?= $value ?>">
                                        </td>
                                    </tr>

                                <?php } ?>
                            </table>
                            <input type="submit" name="submit" value="Actualizar" class="button">
                        </form>
                        <br>
                        <br>
                        <br>
                        <br>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <!-- jquery -->
    <script src="../../views/assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="../../views/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- isotope -->
    <script src="../../views/assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- magnific popup -->
    <script src="../../views/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="../../views/assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="../../views/assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="../../views/assets/js/main.js"></script>
    <style>
        body {
            background-color: #6D5A73;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='615' height='615' viewBox='0 0 200 200'%3E%3Cg %3E%3Cpolygon fill='%23a00a30' points='100 57.1 64 93.1 71.5 100.6 100 72.1'/%3E%3Cpolygon fill='%23b62940' points='100 57.1 100 72.1 128.6 100.6 136.1 93.1'/%3E%3Cpolygon fill='%23a00a30' points='100 163.2 100 178.2 170.7 107.5 170.8 92.4'/%3E%3Cpolygon fill='%23b62940' points='100 163.2 29.2 92.5 29.2 107.5 100 178.2'/%3E%3Cpath fill='%23CC3F51' d='M100 21.8L29.2 92.5l70.7 70.7l70.7-70.7L100 21.8z M100 127.9L64.6 92.5L100 57.1l35.4 35.4L100 127.9z'/%3E%3Cpolygon fill='%232a8e51' points='0 157.1 0 172.1 28.6 200.6 36.1 193.1'/%3E%3Cpolygon fill='%234cad6d' points='70.7 200 70.8 192.4 63.2 200'/%3E%3Cpolygon fill='%236CCC8A' points='27.8 200 63.2 200 70.7 192.5 0 121.8 0 157.2 35.3 192.5'/%3E%3Cpolygon fill='%234cad6d' points='200 157.1 164 193.1 171.5 200.6 200 172.1'/%3E%3Cpolygon fill='%232a8e51' points='136.7 200 129.2 192.5 129.2 200'/%3E%3Cpolygon fill='%236CCC8A' points='172.1 200 164.6 192.5 200 157.1 200 157.2 200 121.8 200 121.8 129.2 192.5 136.7 200'/%3E%3Cpolygon fill='%232a8e51' points='129.2 0 129.2 7.5 200 78.2 200 63.2 136.7 0'/%3E%3Cpolygon fill='%236CCC8A' points='200 27.8 200 27.9 172.1 0 136.7 0 200 63.2 200 63.2'/%3E%3Cpolygon fill='%234cad6d' points='63.2 0 0 63.2 0 78.2 70.7 7.5 70.7 0'/%3E%3Cpolygon fill='%236CCC8A' points='0 63.2 63.2 0 27.8 0 0 27.8'/%3E%3C/g%3E%3C/svg%3E");
        }

        label {
            font-weight: bolder;
            font-size: larger;
        }
    </style>
</body>

</html>