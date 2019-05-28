<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],

    '/usuario/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],

    '/usuario/cadastrar' => [
        'GET' => '\Controlador\UsuarioControlador#cadastrar'
    ],
];
