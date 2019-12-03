<?php

function comprobarUsuario($pdo,$usuario)
{ 
    $sent = $pdo->prepare("SELECT login FROM usuarios WHERE login = :usuario");
    $sent->execute([':usuario' => $usuario]);
    $usuario = $sent->fetchColumn();

    return $usuario;
}
