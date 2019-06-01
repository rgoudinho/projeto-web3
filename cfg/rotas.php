<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],

    '/usuario' => [
        'POST' => '\Controlador\UsuarioControlador#verificarCampos',
    ],

    '/usuario/perfil' => [
        'GET' => '\Controlador\UsuarioControlador#perfil',
    ],

    '/usuario/cadastrar' => [
        'GET' => '\Controlador\UsuarioControlador#cadastrar',
    ],

    '/usuario/login' => [
        'GET' => '\Controlador\LoginControlador#login',
        'POST' => '\Controlador\LoginControlador#verificar',
    ]
];
