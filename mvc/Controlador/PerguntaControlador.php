<?php

namespace Controlador;

use \Modelo\Pergunta;
use \framework\DW3Sessao;
use \Modelo\Usuario;
use \Modelo\Respostas;

class PerguntaControlador extends Controlador
{
    public function index()
    {
        $paginacao = $this->calcularPaginacao();
        $this->visao('perguntas/index.php', [
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'perguntas' => $paginacao['perguntas'],
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
        ]);
    }

    private function calcularPaginacao($dificuldade = null)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 4;
        $offset = ($pagina - 1) * $limit;
        if ($dificuldade == null) {
            $perguntas = Pergunta::buscarTodos($limit, $offset);
            $ultimaPagina = ceil(Pergunta::contarTodos() / $limit);
        } else {
            $perguntas = Pergunta::buscarTodosPorDificuldade($limit, $offset, $dificuldade);
            $ultimaPagina = ceil(Pergunta::contarTodosPorDificuldade($dificuldade) / $limit);
        }
        return compact('pagina', 'perguntas', 'ultimaPagina');
    }

    public function trazerPorDificuldade($dificuldade)
    {
        $paginacao = $this->calcularPaginacao($dificuldade);
        $this->visao('perguntas/index.php', [
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'perguntas' => $paginacao['perguntas'],
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

        $usuario = $this->getUsuario();
        $pergunta->setId_usuario($usuario->getId_usuario());
        if ($pergunta->isValido()) {
            $pergunta->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Pergunta cadastrada.');
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->setErros($pergunta->getValidacaoErros());
            $this->visao(
                'perguntas/criar.php',
                [
                    'pergunta' => $pergunta,
                    'usuario' => $this->getUsuario(),
                    'mensagem' => DW3Sessao::getFlash('mensagem', null)
                ]
            );
        }
    }

    public function editar($id)
    {
        $pergunta = Pergunta::buscarPeloId($id);
        $usuario = $this->getUsuario();
        $respostas = new Respostas($usuario->getId_usuario(), $pergunta->getId());

        if ($pergunta->verificaUsuarioPergunta($id, $usuario) == false) {
            DW3Sessao::setFlash('mensagemFlash', 'Vocẽ não pode editar ou excluir perguntas de outros usuarios.');
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } elseif ($respostas->perguntaJaRespondida()) {
            DW3Sessao::setFlash('mensagemFlash', 'Vocẽ não pode editar perguntas que já foram respondidas.');
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->visao('perguntas/editar.php', [
                'pergunta' => $pergunta
            ]);
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

        if ($pergunta->isValido()) {
            $pergunta->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Pergunta atualizada.');
            $this->redirecionar(URL_RAIZ . 'perguntas');
        } else {
            $this->setErros($pergunta->getValidacaoErros());
            $this->visao(
                'perguntas/editar.php',
                [
                    'pergunta' => $pergunta,
                    'usuario' => $this->getUsuario(),
                    'mensagem' => DW3Sessao::getFlash('mensagem', null)
                ]
            );
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $pergunta = Pergunta::buscarPeloId($id);
        $usuarioPergunta = Usuario::buscarPeloId($pergunta->getId_usuario());
        $usuarioLogado = $this->getUsuario();
        $respostas = new Respostas($usuarioLogado->getId_usuario(), $pergunta->getId());

        if ($usuarioPergunta->getId_usuario() != $usuarioLogado->getId_usuario()) {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        } elseif ($respostas->perguntaJaRespondida()) {
            DW3Sessao::setFlash('mensagemFlash', 'Vocẽ não pode editar perguntas que já foram respondidas.');
        } else {
            Pergunta::destruir($id);
            $respostas->destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }

    public function responder($resposta, $id_pergunta)
    {
        $pergunta = Pergunta::buscarPeloId($id_pergunta);
        $usuarioAtivo = $this->getUsuario();
        $respostas = new Respostas($usuarioAtivo->getId_usuario(), $id_pergunta);
        if ($respostas->verificaSeUsuarioJaRespondeuAPergunta($usuarioAtivo->getId_usuario(), $id_pergunta)) {
            DW3Sessao::setFlash('mensagemFlash', 'Vocẽ já respondeu está pergunta antes.');
        } elseif ($pergunta->getId_usuario() == $usuarioAtivo->getId_usuario()) {
            DW3Sessao::setFlash('mensagemFlash', 'O usuario que criou a pergunta não pode responde-lá.');
        } elseif ($pergunta->verificarResposta($resposta)) {
            $respostas->inserir();
            $pergunta->atualizarAcertos($pergunta->getId());
            DW3Sessao::setFlash('mensagemFlash', 'Resposta correta.');
        } else {
            $respostas->inserir();
            $pergunta->atualizarErros($pergunta->getId());
            DW3Sessao::setFlash('mensagemFlash', 'Resposta errada.');
        }
        $this->redirecionar(URL_RAIZ . 'perguntas');
    }
}
