<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],

    '/usuario/perfil.php' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],

];
