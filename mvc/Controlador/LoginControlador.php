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

    public function verificar()
    {
        $usuario = Usuario::buscarEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId_usuario());
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->visao('login/criar.php');
        }
    }
}
