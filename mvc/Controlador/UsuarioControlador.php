<?php 
namespace Controlador;

use \Modelo\Usuario;
use \framework\DW3Sessao;

class UsuarioControlador extends Controlador
{
    public function perfil()
    {
        $this->verificarLogado();
        $this->visao('usuario/perfil.php', [
            'usuario' => $this->getUsuario(),
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ]);
    }

    public function cadastrar()
    {
        $this->visao('usuario/cadastrar.php');
    }

    public function verificarCampos()
    {
        if (empty($_POST['nome'])) {

        } elseif (empty($_POST['email'])) {

        } elseif (empty($_POST['senha'])) {

        } else {
            $this->armazenar();
        }
    }

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
        $usuario->salvar();
        $this->redirecionar(URL_RAIZ . 'usuario/perfil');
    }
}