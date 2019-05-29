<?php
namespace Controlador;

use \Modelo\Pergunta;

class PerguntaControlador extends Controlador
{
    private $aleatorios = [];

    public function getAleatorios()
    {
        return $this->aleatorios;
    }

    public function setAleatorios($posicao, $aleatorio)
    {
        $this->aleatorios[$posicao] = $aleatorio;
    }

    public function index()
    {
        $perguntas = Pergunta::buscarTodos();
        $this->visao('perguntas/index.php', [
            'perguntas' => $perguntas
        ]);
    }

    public function embaralhaPerguntas($pergunta)
    {
        $alternativas = [];
        for ($i = 1; $i < 6; $i++) {
            switch ($i) {
                case 1:
                    $alternativas[1] = $this->escolheAlternativa($pergunta, $i);
                    break;
                case 2:
                    $alternativas[2] = $this->escolheAlternativa($pergunta, $i);
                    break;
                case 3:
                    $alternativas[3] = $this->escolheAlternativa($pergunta, $i);
                    break;
                case 4:
                    $alternativas[4] = $this->escolheAlternativa($pergunta, $i);
                    break;
                case 5:
                    $alternativas[5] = $this->escolheAlternativa($pergunta, $i);
                    break;
            }
        }
        return $alternativas;
    }

    public function escolheAlternativa($pergunta, $posicao)
    {
        do {
            $aleatorio = rand(1, 5);
        } while (in_array($aleatorio, $this->getAleatorios()));

        switch ($aleatorio) {
            case 1:
                $this->setAleatorios($posicao, $aleatorio);
                return $pergunta->getAlternativaCorreta();
            case 2:
                $this->setAleatorios($posicao, $aleatorio);
                return $pergunta->getAlternativaErrada1();
            case 3:
                $this->setAleatorios($posicao, $aleatorio);
                return $pergunta->getAlternativaErrada2();
            case 4:
                $this->setAleatorios($posicao, $aleatorio);
                return $pergunta->getAlternativaErrada3();
            case 5:
                $this->setAleatorios($posicao, $aleatorio);
                return $pergunta->getAlternativaErrada4();
        }
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
