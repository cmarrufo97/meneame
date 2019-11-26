<?php

function barraLogin()
{
    ?>
    <nav id="barra" class="navbar navbar-expand-lg navbar-light">
        <a id="titulo" class="navbar-brand" href="/index.php">Menéame</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-link">
                    <a id="register" class="nav-link" href="/usuarios/registrar.php">Registrarse</a>
                </li>
                <!-- <button type="button" class="btn btn-primary mr-1">Login</button>
                <button type="button" class="btn btn-success">Registrarse</button> -->
            </ul>
        </div>
    </nav>
<?php

}

function barraRegistrar()
{
    ?>
    <nav id="barra" class="navbar navbar-expand-lg navbar-light">
        <a id="titulo" class="navbar-brand" href="/index.php">Menéame</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-link">
                    <a id="register" class="nav-link" href="/usuarios/login.php">Login</a>
                </li>
                <!-- <button type="button" class="btn btn-primary mr-1">Login</button>
                <button type="button" class="btn btn-success">Registrarse</button> -->
            </ul>
        </div>
    </nav>
<?php

}