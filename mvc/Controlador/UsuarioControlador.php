<?php 
namespace Controlador;

use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function perfil()
    {
        $this->visao('usuario/perfil.php');
    }
}