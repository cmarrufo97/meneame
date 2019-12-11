<?php

function comprobarUsuario($pdo, $usuario)
{
    $sent = $pdo->prepare("SELECT login FROM usuarios WHERE login = :usuario");
    $sent->execute([':usuario' => $usuario]);
    $usuario = $sent->fetchColumn();

    return $usuario;
}

function comprobarContraseña($pdo, $contraseña, $usuario)
{
    $sent = $pdo->prepare("SELECT password FROM usuarios WHERE password = :password AND login = :login");
    $sent->execute([':password' => $contraseña, ':login' => $usuario]);

    $correcto = $sent->fetchColumn();

    return $correcto;
}

function getContraseñaUsuario($pdo,$usuario) {
    $sent = $pdo->prepare("SELECT password FROM usuarios WHERE login = :usuario");
    $sent->execute([':usuario' => $usuario]);

    $res = $sent->fetchColumn();

    return $res;
}
