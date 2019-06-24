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
            'perguntas' => $perguntas,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
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
            null,
            $foto
        );
        $usuario = Usuario::buscarPeloNome($_POST['usuario']);
        $pergunta->setId_usuario($usuario->getId_usuario());

        $pergunta->salvar();
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $pergunta = Pergunta::buscarPeloId($id);
        $usuarioPergunta = Usuario::buscarPeloId($pergunta->getId_usuario());
        $usuarioLogado = $this->getUsuario();

        if ($usuarioPergunta->getId_usuario() == $usuarioLogado->getId_usuario()) {
            Pergunta::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }

    public function editar($id)
    {
        $pergunta = Pergunta::buscarPeloId($id);
        $usuario = $this->getUsuario();

        if ($pergunta->verificaUsuarioPergunta($id, $usuario)) {
            $this->visao('perguntas/editar.php', [
                'pergunta' => $pergunta
            ]);
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Vocẽ não pode editar perguntas de outros usuarios.');
            $this->redirecionar(URL_RAIZ . 'perguntas');
        }
    }

    public function atualizar($id)
    {
        $pergunta = Pergunta::buscarPeloId($id);
        $pergunta->setPergunta($_POST['pergunta']);
        $pergunta->setAlternativaCorreta($_POST['resposta-correta']);
        $pergunta->setAlternativaErrada1($_POST['resposta-errada1']);
        $pergunta->setAlternativaErrada2($_POST['resposta-errada2']);
        $pergunta->setAlternativaErrada3($_POST['resposta-errada3']);
        $pergunta->setAlternativaErrada4($_POST['resposta-errada4']);
        $pergunta->setDificuldade($_POST['dificuldade']);
        $pergunta->salvar();
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }

    public function responder($resposta, $id_pergunta)
    {
        $pergunta = Pergunta::buscarPeloId($id_pergunta);
        if($pergunta->verificarResposta($resposta)){
            DW3Sessao::setFlash('mensagemFlash', 'Resposta correta.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Resposta errada.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }
}
