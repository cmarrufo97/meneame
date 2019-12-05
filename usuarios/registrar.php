<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
    <?php
    require __DIR__ . '/../auxiliar.php';
    barra();

    $pdo = conectar();

    if (isset($_POST) && !empty($_POST)) {
        $usuario = trim($_POST['usuario']);
        $contraseña = trim($_POST['contraseña']);
        $confirmar = trim($_POST['confirmar']);
        $email = trim($_POST['email']);

        if (!empty($usuario) && !empty($contraseña) && !empty($confirmar) && !empty($email)) {
            if ($contraseña == $confirmar) {
                // Comprobar si el usuario ya existe.

                // Realizar registro
                $sent = $pdo->prepare('INSERT INTO usuarios (login,password,email)
                                       VALUES (:login,:password,:email)');
                
                $sent->execute([':login' => $usuario, ':password' => $contraseña,':email' => $email]);
                header('Location: ../index.php');
                return;
            }
        }else {
            alert('Los campos no pueden estar vacíos.','danger');
        }

    }
    dibujarFormularioRegistro();
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>