<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio extends Modelo
{
    const BUSCAR_MAIS_ACERTADA_FACIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 1)';
    const BUSCAR_MAIS_ACERTADA_MEDIA = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 2)';
    const BUSCAR_MAIS_ACERTADA_DIFICIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND acertos = (SELECT MAX(acertos) FROM perguntas WHERE dificuldade = 3)';
    const BUSCAR_MAIS_ERRADA_FACIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 1)';
    const BUSCAR_MAIS_ERRADA_MEDIA = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 2)';
    const BUSCAR_MAIS_ERRADA_DIFICIL = 'SELECT nome, pergunta, acertos, erros FROM usuarios JOIN perguntas WHERE perguntas.id_usuario = usuarios.id AND erros = (SELECT MAX(erros) FROM perguntas WHERE dificuldade = 3)';

    private $nome;
    private $pergunta;
    private $acertos;
    private $erros;
    private $tipo;

    public function __construct(
        $nome,
        $pergunta,
        $acertos,
        $erros,
        $tipo
    ) 
    { 
        $this->nome = $nome;
        $this->pergunta = $pergunta;
        $this->acertos = $acertos;
        $this->erros = $erros;
        $this->tipo = $tipo;
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

    public function getTipo()
    {
        return $this->tipo;
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

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public static function buscarMaisAcertadaFacil()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISACERTADAFACIL);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Facíl - mais acertada'
        );

        return $relatorio;
    }

    public static function buscarMaisErradaFacil()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISERRADAFACIL);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Facíl - mais errada'
        );

        return $relatorio;
    }

    public static function buscarMaisAcertadaMedia()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISACERTADAMEDIA);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Média - mais acertada'
        );

        return $relatorio;
    }

    public static function buscarMaisErradaMedia()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISERRADAMEDIA);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Média - mais errada'
        );

        return $relatorio;
    }

    public static function buscarMaisAcertadaDificil()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISACERTADADIFICIL);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Difícil - mais acertada'
        );

        return $relatorio;
    }

    public static function buscarMaisErradaDificil()
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCARMAISERRADADIFICIL);
        $comando->execute();
        $pesquisa = $comando->fetch();
        $relatorio = new Relatorio(
            $pesquisa['nome'],
            $pesquisa['pergunta'],
            $pesquisa['acertos'],
            $pesquisa['erros'],
            'Difícil - mais errada'
        );

        return $relatorio;
    }
}
