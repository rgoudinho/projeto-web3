<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
    ],

    '/criar' => [
        'GET' => '\Controlador\PerguntaControlador#criar',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],

    '/usuario/cadastrar' => [
        'GET' => '\Controlador\UsuarioControlador#cadastro',
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],

    '/usuario/login' => [
        'GET' => '\Controlador\LoginControlador#login',
        'POST' => '\Controlador\LoginControlador#verificar',
    ],
];
