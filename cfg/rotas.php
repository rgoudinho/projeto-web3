<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],

    '/perguntas' => [
        'GET' => '\Controlador\PerguntaControlador#index',
    ],

    '/perguntas/criar' => [
        'GET' => '\Controlador\PerguntaControlador#criar',
        'POST' => '\Controlador\PerguntaControlador#armazenar',
    ],

    '/perguntas/relatorio' => [
        'GET' => '\Controlador\RelatorioControlador#gerar'
    ],

    '/usuario/cadastrar' => [
        'GET' => '\Controlador\UsuarioControlador#cadastro',
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],

    '/usuario/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],

    '/usuario/login' => [
        'GET' => '\Controlador\LoginControlador#login',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],

    '/perguntas/?' => [
        'GET' => '\Controlador\PerguntaControlador#trazerPorDificuldade',
        'PATCH' => '\Controlador\PerguntaControlador#atualizar',
        'DELETE' => '\Controlador\PerguntaControlador#destruir',
    ],

    '/perguntas/?/editar' => [
        'GET' => '\Controlador\PerguntaControlador#editar',
    ],

    '/perguntas/?/?' => [
        'GET' => '\Controlador\PerguntaControlador#responder',
    ],
];
