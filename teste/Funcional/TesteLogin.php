<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuario/login');
        $this->verificarContem($resposta, 'Logar');
    }

    public function testeLogin()
    {
        (new Usuario('Joao', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'perguntas');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('Joao', 'joao@teste.com', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'usuario/login', [
            'email' => 'joao@teste.com',
            'senha' => '123'
        ]);
        $resposta = $this->delete(URL_RAIZ . 'usuario/login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'usuario/login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
