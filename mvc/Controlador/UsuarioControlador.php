<?php 
namespace Controlador;

use \Modelo\Usuario;

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
            $this->redirecionar(URL_RAIZ . 'usuario/sucesso');
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuario/cadastrar.php');
        }
    }

    public function sucesso()
    {
        $this->visao('usuario/sucesso.php');
    }
}