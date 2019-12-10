<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modificar noticia</title>
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
    // comprobar que se esta logueado y que la noticia es del usuario para poder borrarla.
    if (!logueado()) {
        aviso('Tiene que estar logueado para modificar noticias.', 'danger');
        header('Location: index.php');
        return;
    }

    if (isset($_GET) && !empty($_GET)) {
        if (isset($_GET['id'])) {
            $id = trim($_GET['id']);
            unset($_GET['id']);
        }
    } else {
        // si llega aqui es que se ha accedido al modificar sin el paramtro id.
        aviso('Ha ocurrido un error inesperado.', 'danger');
        header('Location: index.php');
        return;
    }

    if (isset($_POST) && !empty($_POST)) {
        $titulo = trim($_POST['noticia']);
        $cuerpo = trim($_POST['cuerpo']);
        $autor = obtener_id_usuario($pdo, trim($_SESSION['login']));
        $categoria = trim($_POST['categoria']);
        $sent = $pdo->prepare("SELECT login from usuarios where id IN (SELECT usuario_id FROM noticias WHERE id = $id)");
        $sent->execute();

        // Comprobar que la noticia pertenece al usuario.
        $login = trim($_SESSION['login']);
        $res = "" . $sent->fetchColumn();

        $correcto = ($login === $res);

        if ($correcto === true) {
            if (!empty($titulo) && !empty($cuerpo) && !empty($categoria)) {
                // se modifica si la noticia pertenece al usuario.
                // usuario puede modificar la noticia.
                $sent = $pdo->prepare("UPDATE noticias SET titulo = :titulo, cuerpo = :cuerpo, usuario_id = :autor, categoria_id = :categoria WHERE id = :id");
                $sent->execute([':titulo' => $titulo, ':cuerpo' => $cuerpo, ':autor' => $autor, ':categoria' => $categoria, ':id' => $id]);
                aviso('Noticia modificada correctamente');
                header('Location: index.php');
                return;
            } else {
                alert('Los campos no pueden estar vacíos.', 'danger');
            }
        } else {
            aviso('Ha ocurrido un error inesperado', 'danger');
            header('Location: index.php');
            return;
        }
    }



    ?>

    <?= dibujarFormularioNoticia($pdo, 'Modificar') ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>