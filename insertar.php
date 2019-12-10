<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir una Noticia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php
    require __DIR__ . '/auxiliar.php';
    $pdo = conectar();

    if (!isset($_COOKIE['aceptar'])) {
        alert('Este sitio web usa cookies. <a href="/cookies.php">Estoy de acuerdo</a>','info');
    }


    if (!logueado()) {
        aviso('Tiene que estar logueado para publicar una noticia.', 'danger');
        header('Location: /usuarios/login.php');
        return;
    }

    if (hayAvisos()) {
        alert();
    }


    if (es_POST()) {
        $sent = $pdo->prepare('INSERT
                                 INTO noticias (titulo,cuerpo,usuario_id,categoria_id)
                               VALUES (:titulo,:cuerpo,:usuario_id,:categoria_id)');
        // Esto de abajo está fatal.
        $titulo = $_POST['noticia'];
        $cuerpo = $_POST['cuerpo'];
        $autor = obtener_id_usuario($pdo, trim($_SESSION['login']));
        $categoria = $_POST['categoria'];
        if (!empty($titulo) && !empty($cuerpo) && !empty($categoria)) {
            $sent->execute([':titulo' => $titulo, ':cuerpo' => $cuerpo, ':usuario_id' => $autor, ':categoria_id' => $categoria]);
            alert('Noticia insertada correctamente.', 'succes');
            header('Location: index.php');
            return;
        } else {
            alert('Los campos no pueden estar vacíos.', 'danger');
        }
    }
    dibujarFormularioNoticia($pdo);
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>