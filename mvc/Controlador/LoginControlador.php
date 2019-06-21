<?php
namespace Controlador;

use \Modelo\Usuario;
use \framework\DW3Sessao;

class LoginControlador extends Controlador
{
    public function login()
    {
        $this->visao('usuario/login.php');
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarPeloEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId_usuario());
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('usuario/login.php');
        }
    }
}
