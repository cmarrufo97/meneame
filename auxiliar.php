<?php

function param($par)
{
    if (isset($_POST)) {
        if (isset($_POST[$par])) {
            return trim($_POST[$par]);
        }
    }
    return '';
}

function barra()
{
    ?>
    <nav id="barra" class="navbar navbar-expand-lg navbar-light">
        <a id="titulo" class="navbar-brand" href="/index.php"><img src="../iconos/logo2.png" alt="Logo"> menéame</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-link">
                    <form class="form-inline my-2 my-lg-0" method="get">
                        <input type="search" name="buscar" id="buscar">
                        <button id="boton-buscar" type="submit"><img src="../iconos/buscar.png" alt="buscar"></button>
                    </form>
                </li>
                <span class="vl"></span>
                <?php if (logueado()) : ?>
                    <span id="usuario" class="navbar-text text-white mr-2">
                        <?= logueado() ?>
                    </span>
                    <form class="form-inline my-2 my-lg-0" action="/usuarios/logout.php" method="post">
                        <button class="btn btn-link text-white my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                <?php else : ?>
                    <!-- <a class="nav-link" href="/usuarios/login.php">Login</a> -->
                    <li class="nav-link">
                        <a id="login" class="nav-link" href="/usuarios/login.php">Login</a>
                    </li>
                    <li class="nav-link">
                        <a id="register" class="nav-link" href="/usuarios/registrar.php">Registrarse</a>
                    </li>
                <?php endif ?>
                <!-- <button type="button" class="btn btn-primary mr-1">Login</button>
                <button type="button" class="btn btn-success">Registrarse</button> -->
            </ul>
        </div>
    </nav>
    <nav id="sub" class="navbar navbar-expand-lg navbar-light">
        <a id="publicar" href="/insertar.php"><img src="../iconos/publicar.png" alt="Añadir noticia">Publicar</a>
    </nav>

<?php

}

function dibujarFormularioLogin()
{
    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-6">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="login" placeholder="Introduce nombre de usuario" value="<?= param('login') ?>">
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="password" placeholder="Introduce tu contraseña">
                    </div>
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-success">Entrar</button>
                    <a href="../index.php" class="btn btn-info" role="button">Volver</a>

                </form>
            </div>
        </div>
    </div>
<?php
}

function dibujarFormularioRegistro()
{
    ?>
    <div id="form-login" class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-4">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="usuario">Nombre de usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Introduce nombre de usuario" value="<?= param('usuario') ?>">
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Introduce tu contraseña">
                    </div>
                    <div class="form-group">
                        <label for="confirmar">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Introduce de nuevo la contraseña">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Introduce tu email" value="<?= param('email') ?>">
                    </div>
                    <!-- <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <a href="../index.php" class="btn btn-info" role="button">Volver</a>

                </form>
            </div>
        </div>
    </div>
<?php
}

function conectar()
{
    return new PDO('pgsql:host=localhost;dbname=meneame', 'usuario', 'usuario');
}

function proyectarNoticias($sent, $pdo)
{
?>
    <?php foreach ($sent as $fila) : ?>
        <div class="row mt-5">
            <div class="col mt-5">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h4 class="card-title"><?= $fila['titulo'] ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">por<a id="autor" href="#"><?= getAutorNoticia($pdo, $fila['usuario_id'], $fila['id']) ?></a></h6>
                        <p class="card-text"><?= $fila['cuerpo'] ?></p>
                        <p class="categoria"><?= getCategoria($pdo, $fila['titulo']) ?></p>
                        <!-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> -->
                        <?php
                                if (logueado()) {
                                    if (trim($_SESSION['login'] == getAutorNoticia($pdo, $fila['usuario_id'], $fila['id']))) {
                                        // el usuario puede borrar sus noticias.
                                        ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <a href="modificar.php?id=<?=$fila['id']?>" class="btn btn-sm btn-info float-right" role="button">
                                            Modificar
                                    </a>
                                    <button id="boton-borrar" type="submit" class="btn btn-sm btn-danger float-right">Borrar</button>
                                </form>
                        <?php
                                    }
                                }
                                ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    <?php
}

function filtrarNoticias($pdo, $valor)
{
    // if (trim($valor) == existeUsuario($valor,$pdo)) {
    //     $res = obtener_id_usuario($pdo,$valor);
    //     $sent = $pdo->prepare("SELECT * FROM noticias WHERE usuario_id = '$res'");
    //     $sent->execute();
    // }else {
    //     $sent = $pdo->prepare("SELECT * FROM noticias WHERE titulo ILIKE '%$valor%'");
    //     $sent->execute();
    // }
    $valor = trim($valor);

    switch($valor) {
        case $valor == existeUsuario($valor,$pdo):
            $res = obtener_id_usuario($pdo,$valor);
            $sent = $pdo->prepare("SELECT * FROM noticias WHERE usuario_id = '$res'");
            $sent->execute();
        break;
        
        case $valor == existe_categoria($pdo,$valor):
            $res = obtenerID($pdo,$valor);
            $sent = $pdo->prepare("SELECT * FROM noticias WHERE categoria_id = '$res'");
            $sent->execute();
        break;

        default :
            $sent = $pdo->prepare("SELECT * FROM noticias WHERE titulo ILIKE '%$valor%'");
            $sent->execute();

    }


    foreach ($sent as $fila) {
        ?>
    <div class="row mt-5">
        <div class="col mt-5">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h4 class="card-title"><?= $fila['titulo'] ?></h4>
                    <h6 class="card-subtitle mb-2 text-muted">por<a id="autor" href="#"><?= getAutorNoticia($pdo, $fila['usuario_id'], $fila['id']) ?></a></h6>
                    <p class="card-text"><?= $fila['cuerpo'] ?></p>
                    <p class="categoria"><?= getCategoria($pdo, $fila['titulo']) ?></p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                    <?php
                            if (logueado()) {
                                if (trim($_SESSION['login'] == getAutorNoticia($pdo, $fila['usuario_id'], $fila['id']))) {
                                    // el usuario puede borrar sus noticias.
                                    ?>
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger float-right">Borrar</button>
                            </form>
                    <?php
                                }
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
<?php
    }
}

function borrarNoticia($pdo, $id)
{
    $sent = $pdo->prepare("DELETE FROM noticias WHERE id = :id");
    $sent->execute([':id' => $id]);

    if ($sent->rowCount() === 1) {
        aviso('Fila borrada correctamente');
        header('Location: index.php');
    } else {
        alert('Ha ocurrido un error inesperado.', 'danger');
    }
}

function getAutorNoticia($pdo, $usuario_id, $noticia_id)
{
    // $sent = $pdo->query("SELECT login FROM usuarios WHERE id IN (SELECT $usuario_id FROM noticias WHERE id = $noticia_id)");
    $sent = $pdo->prepare("SELECT login FROM usuarios WHERE id IN (SELECT $usuario_id FROM noticias WHERE id = '$noticia_id')");
    $sent->execute();
    $autor = $sent->fetchColumn();
    return $autor;
}

function getCategoria($pdo, $titulo)
{
    // consulta : SELECT denominacion FROM categorias WHERE id in (SELECT categoria_id FROM noticias);

    $sent = $pdo->prepare("SELECT denominacion FROM categorias NATURAL JOIN noticias WHERE id IN  
                            (SELECT categoria_id FROM noticias WHERE titulo = '$titulo')");

    $sent->execute();

    $categoria = $sent->fetchColumn();
    return $categoria;
}

function dibujarFormularioNoticia($pdo,$accion = 'Publicar')
{
    ?>
        <div id="form-login" class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="noticia">Titulo de la noticia</label>
                        <input type="text" class="form-control" id="noticia" name="noticia" placeholder="Introduce el titulo de la noticia" value="<?=param('noticia')?>">
                    </div>
                    <div class="form-group">
                        <label for="cuerpo">Cuerpo de la noticia</label>
                        <textarea name="cuerpo" id="cuerpo" cols="70" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Introduzca la categoria de la noticia</label>
                        <!-- <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Introduce de nuevo la contraseña"> -->
                        <!-- aqui es mejor hacer un select... -->
                        <select name="categoria" id="categoria" class="form-control">
                            <?php
                                $sent = $pdo->prepare('SELECT denominacion FROM categorias');
                                $sent->execute();
                                ?>
                            <?php foreach ($sent as $fila) : ?>
                                <option value="<?= obtenerID($pdo, $fila['denominacion']) ?>"><?= $fila['denominacion'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <?php 
                    if (trim($accion) == 'Modificar') {
                    ?>
                    <button type="submit" class="btn btn-success">Modificar</button>
                    <a href="index.php" class="btn btn-info" role="button">Volver</a>
                    <?php    
                    }else {
                        ?>
                        <button type="submit" class="btn btn-success">Publicar</button>
                        <a href="index.php" class="btn btn-info" role="button">Volver</a>
                        <?php
                    }
                ?>
                </form>
            </div>
        </div>
        </div>
    <?php
}

function obtenerID($pdo, $denominacion)
{
    $sent = $pdo->prepare("SELECT id FROM categorias WHERE denominacion = :denominacion");
    $sent->execute([':denominacion' => $denominacion]);
    $id = $sent->fetchColumn();
    return $id;
}

function obtener_id_usuario($pdo, $usuario)
{
    $sent = $pdo->prepare("SELECT id FROM usuarios WHERE login = :usuario");
    $sent->execute([':usuario' => $usuario]);

    $id = $sent->fetchColumn();

    return $id;
}

function existe_categoria($pdo,$categoria) {
    $sent = $pdo->prepare("SELECT denominacion FROM categorias WHERE denominacion = :categoria");
    $sent->execute([':categoria' => $categoria]);

    $res = $sent->fetchColumn();
    return $res;
}

function es_Autor($pdo, $autor, $titulo)
{
    $sent = $pdo->prepare("SELECT :login FROM usuarios WHERE id IN (SELECT usuario_id FROM noticias WHERE titulo = '$titulo');");
    $sent->execute([':login' => $autor]);

    $autor = $sent->fetchColumn();

    return $autor;
}

function es_GET($req = null)
{
    return ($req === null) ? metodo() === 'GET' : $req === REQ_GET;
}
function es_POST($req = null)
{
    return ($req === null) ? metodo() === 'POST' : $req === REQ_POST;
}
function metodo()
{
    return $_SERVER['REQUEST_METHOD'];
}
function peticion($req = null)
{
    return es_GET($req) ? $_GET : $_POST;
}

function logueado()
{
    return isset($_SESSION['login']) ? $_SESSION['login'] : false;
}

function aviso($mensaje, $severidad = 'success')
{
    $_SESSION['aviso'] = [
        'mensaje' => $mensaje,
        'severidad' => $severidad,
    ];
}

function hayAvisos()
{
    return isset($_SESSION['aviso']);
}

function getAviso()
{
    return hayAvisos() ? $_SESSION['aviso'] : [];
}

function alert($mensaje = null, $severidad = null)
{
    if ($mensaje === null) {
        if (hayAvisos()) {
            $aviso = getAviso();
            $mensaje = $aviso['mensaje'];
            $severidad = $aviso['severidad'];
            quitarAvisos();
        } else {
            return;
        }
    }

?>
    <div class="row mt-3">
        <div class="col-8 offset-2">
            <div class="alert alert-<?= $severidad ?> alert-dismissible fade show" role="alert">
                <?= $mensaje ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
        </div>
    </div>
<?php
}

function quitarAvisos()
{
    unset($_SESSION['aviso']);
}

function existeUsuario($usuario, $pdo)
{
    // Comprobar si un usuario existe en la base de datos.
    $sent = $pdo->prepare("SELECT login FROM usuarios WHERE login = :usuario");
    $sent->execute([':usuario' => $usuario]);

    $existe = $sent->fetchColumn();

    return $existe;
}
