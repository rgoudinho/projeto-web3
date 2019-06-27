<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio extends Modelo
{
    const BUSCARMAISACERTADAFACIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 1)';
    const BUSCARMAISACERTADAMEDIA = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 2)';
    const BUSCARMAISACERTADADIFICIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 3)';
    const BUSCARMAISERRADAFACIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 1)';
    const BUSCARMAISERRADAMEDIA = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 2)';
    const BUSCARMAISERRADADIFICIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 3)';

    private $nome;
    private $pergunta;
    private $acertos;
    private $erros;

    public function __construct(
        $nome,
        $pergunta,
        $acertos,
        $erros
    ) 
    { 
        $this->nome = $nome;
        $this->pergunta = $pergunta;
        $this->acertos = $acertos;
        $this->erros = $erros;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPergunta()
    {
        return $this->pergunta;
    }

    public function getAcertos()
    {
        return $this->acertos;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setPergunta($perguntas)
    {
        $this->pergunta = $perguntas;
    }

    public function setAcertos($acertos)
    {
        $this->acertos = $acertos;
    }

    public function setErros($erros)
    {
        $this->erros = $erros;
    }

    public static function buscarMaisAcertadaFacil()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISACERTADAFACIL);
        $comando->execute();
        $relatorio = new Relatorio(
            $comando['nome'],
            $comando['pergunta'],
            $comando['acertos'],
            $comando['erros']
        );

        return $relatorio;
    }
}
