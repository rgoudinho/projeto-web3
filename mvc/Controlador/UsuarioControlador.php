<?php 
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function perfil()
    {
        $this->visao('usuario/perfil.php');
    }

    public function cadastrar()
    {
        $this->visao('usuario/cadastrar.php');
    }
}