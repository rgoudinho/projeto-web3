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

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
        $usuario->inserir();
        # perguntar ao professor pq no codigo dele ele utilisa o salvar q somente chama o inserir.
    }
}