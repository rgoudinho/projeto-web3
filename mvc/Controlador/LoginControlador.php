<?php
namespace Controlador;

use \Modelo\Usuario;
use \Framework\DW3Sessao;

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
            $this->redirecionar(URL_RAIZ . 'usuario/perfil');
        } else {
            $this->visao('login/criar.php');
        }
    }
}
