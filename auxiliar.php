<?php

function barra()
{
    ?>
    <nav id="barra" class="navbar navbar-expand-lg navbar-light">
        <a id="titulo" class="navbar-brand" href="/index.php"><img src="./iconos/logo2.png" alt="Logo"> menéame</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <?php if (logueado()): ?>
                    <span class="navbar-text mr-2">
                        <?= logueado() ?>
                    </span>
                    <form class="form-inline my-2 my-lg-0" action="/usuarios/logout.php" method="post">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                <?php else: ?>
                    <!-- <a class="nav-link" href="/usuarios/login.php">Login</a> -->
                    <li class="nav-link">
                        <a id="login" class="nav-link" href="/usuarios/login.php">Login</a>
                    </li>
                <?php endif ?>
                <li class="nav-link">
                    <a id="register" class="nav-link" href="/usuarios/registrar.php">Registrarse</a>
                </li>
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
                <form action="">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" placeholder="Introduce nombre de usuario">
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" placeholder="Introduce tu contraseña">
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
                <form action="">
                    <div class="form-group">
                        <label for="nombreUsuario">Nombre de usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" placeholder="Introduce nombre de usuario">
                    </div>
                    <div class="form-group">
                        <label for="contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" placeholder="Introduce tu contraseña">
                    </div>
                    <div class="form-group">
                        <label for="confirmar">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="confirmar" placeholder="Introduce de nuevo la contraseña">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Introduce tu email">
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
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text"><?= $fila['cuerpo'] ?></p>
                        <p class="categoria"><?= getCategoria($pdo, $fila['titulo']) ?></p>
                        <!-- <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a> -->
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php
}

function getCategoria($pdo, $titulo)
{
    // consulta : SELECT denominacion FROM categorias WHERE id in (SELECT categoria_id FROM noticias);

    $sent = $pdo->query("SELECT denominacion FROM categorias NATURAL JOIN noticias WHERE id IN  
    (SELECT categoria_id FROM noticias WHERE titulo = '$titulo')");

    $categoria = $sent->fetchColumn();
    return $categoria;
}

function dibujarFormularioNoticia()
{
    ?>
    <div id="form-login" class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-5">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="noticia">Titulo de la noticia</label>
                        <input type="text" class="form-control" id="noticia" name="noticia" placeholder="Introduce el titulo de la noticia">
                    </div>
                    <div class="form-group">
                        <label for="cuerpo">Cuerpo de la noticia</label>
                        <textarea name="cuerpo" id="cuerpo" cols="70" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Introduzca la categoria de la noticia</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Introduce de nuevo la contraseña">
                        <!-- aqui es mejor hacer un select... -->
                    </div>
                    <!-- <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                    <button type="submit" class="btn btn-success">Publicar</button>
                    <a href="index.php" class="btn btn-info" role="button">Volver</a>
                </form>
            </div>
        </div>
    </div>
<?php
}

function alert($mensaje, $severidad = 'success')
{
    ?>
    <div class="alert alert-<?=$severidad?>" role="alert">
        <?= $mensaje ?>
    </div>
<?php
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
