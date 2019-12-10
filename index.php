<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menéame</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo.css">
</head>

<body>
    <?php
    require __DIR__ . '/auxiliar.php';
    barra();

    if (!isset($_COOKIE['aceptar'])) {
        alert('Este sitio web usa cookies. <a href="/cookies.php">Estoy de acuerdo</a>','info');
    }

    $pdo = conectar();
    $sent = $pdo->prepare('SELECT * FROM noticias');
    $sent->execute();

    if (es_POST() && isset($_POST['id'])) {
        // comprobar que se esta logueado y que la noticia es del usuario para poder borrarla.
        if (logueado()) {
            $id = h(trim($_POST['id']));
            borrarNoticia($pdo, $id);
        } else {
            alert('Tiene que estar logueado para borrar noticias.', 'danger');
        }
    }
    ?>


    <div class="container">
        <?php

        if (hayAvisos()) {
            alert();
        }


        if (isset($_GET) && !empty($_GET)) {
            if (isset($_GET['buscar'])) {
                $buscar = h(trim($_GET['buscar']));
                filtrarNoticias($pdo, $buscar);
            }
        } else {
            proyectarNoticias($sent, $pdo);
        }
        ?>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>