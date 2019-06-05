<?php
namespace Controlador;

use \Modelo\Pergunta;


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
        $this->visao('perguntas/criar.php');
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

    // public function armazenar()
    // {
    //     $pergunta = new Pergunta(
    //         $_POST['nome'],
    //         $_POST['endereco'],
    //         $_POST['telefone1'],
    //         $_POST['telefone2'],
    //         $_POST['telefone3']
    //     );
    //     $pergunta->salvar();
    //     $this->redirecionar(URL_RAIZ . 'pergunta');
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
