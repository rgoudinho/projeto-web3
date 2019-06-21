<?php
namespace Controlador;

use \Modelo\Pergunta;
use \framework\DW3Sessao;
use Modelo\Usuario;

class PerguntaControlador extends Controlador
{

    public function index()
    {
        $perguntas = Pergunta::buscarTodos();
        $this->visao('perguntas/index.php', [
            'perguntas' => $perguntas
        ]);
    }

    public function criar() 
    {
        $this->verificarLogado();
        $this->visao('perguntas/criar.php', [            
            'usuario' => $this->getUsuario(),
            'mensagem' => DW3Sessao::getFlash('mensagem', null)
        ]);
    }

    public function armazenar()
    {
        $foto = array_key_exists('foto', $_FILES) ? $_FILES['foto'] : null;
        
        $pergunta = new Pergunta(
            $_POST['pergunta'],
            $_POST['resposta-correta'],
            $_POST['resposta-errada1'],
            $_POST['resposta-errada2'],
            $_POST['resposta-errada3'],
            $_POST['resposta-errada4'],
            $_POST['dificuldade'],
            $foto
        );
        $usuario = Usuario::buscarPeloNome($_POST['usuario']);
        $pergunta->setId_usuario($usuario->getId_usuario());

        $pergunta->salvar();
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }

    // public function mostrar($id)
    // {
    //     $pergunta = Pergunta::buscarId($id);
    //     $this->visao('perguntas/mostrar.php', [
    //         'pergunta' => $pergunta
    //     ]);
    // }

    // public function criar()
    // {
    //     $this->visao('perguntas/criar.php');
    // }

    // public function editar($id)
    // {
    //     $pergunta = Pergunta::buscarId($id);
    //     $this->visao('contatos/editar.php', [
    //         'contato' => $pergunta
    //     ]);
    // }

    // public function atualizar($id)
    // {
    //     $contato = Pergunta::buscarId($id);
    //     $contato->setNome($_POST['nome']);
    //     $contato->setEndereco($_POST['endereco']);
    //     $contato->setTelefone1($_POST['telefone1']);
    //     $contato->setTelefone2($_POST['telefone2']);
    //     $contato->setTelefone3($_POST['telefone3']);
    //     $contato->salvar();
    //     $this->redirecionar(URL_RAIZ . 'perguntas');
    // }

    // public function destruir($id)
    // {
    //     Pergunta::destruir($id);
    //     $this->redirecionar(URL_RAIZ . 'perguntas');
    // }
}
