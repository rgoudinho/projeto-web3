<?php 
namespace Controlador;

use \Modelo\Usuario;
use \framework\DW3Sessao;

class UsuarioControlador extends Controlador
{

    public function cadastro()
    {
        $this->visao('usuario/cadastrar.php');
    }

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);
        
        if($usuario->isValido()){
            $usuario->salvar();
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php');
        }
    }
}