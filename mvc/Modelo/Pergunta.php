<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Pergunta extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM pergunta';

    private $id;
    private $pergunta;
    private $id_usuario;
    private $dificuldade;
    private $alternativaCorreta;
    private $alternativaErrada1;
    private $alternativaErrada2;
    private $alternativaErrada3;
    private $alternativaErrada4;

    private $aleatorios = [];

    public function __construct(
        $id = null,
        $pergunta = null,
        $id_usuario = null,
        $dificuldade = null,
        $alternativaCorreta = null,
        $alternativaErrada1 = null,
        $alternativaErrada2 = null,
        $alternativaErrada3 = null,
        $alternativaErrada4 = null
    ) {
        $this->id = $id;
        $this->pergunta = $pergunta;
        $this->id_usuario = $id_usuario;
        $this->dificuldade = $dificuldade;
        $this->alternativaCorreta = $alternativaCorreta;
        $this->alternativaErrada1 = $alternativaErrada1;
        $this->alternativaErrada2 = $alternativaErrada2;
        $this->alternativaErrada3 = $alternativaErrada3;
        $this->alternativaErrada4 = $alternativaErrada4;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPergunta()
    {
        return $this->pergunta;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function getDificuldade()
    {
        return $this->dificuldade;
    }

    public function getAlternativaCorreta()
    {
        return $this->alternativaCorreta;
    }

    public function getAlternativaErrada1()
    {
        return $this->alternativaErrada1;
    }

    public function getAlternativaErrada2()
    {
        return $this->alternativaErrada2;
    }

    public function getAlternativaErrada3()
    {
        return $this->alternativaErrada3;
    }

    public function getAlternativaErrada4()
    {
        return $this->alternativaErrada4;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPergunta($pergunta)
    {
        $this->pergunta = $pergunta;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setDificuldade($dificuldade)
    {
        $this->dificuldade = $dificuldade;
    }

    public function setAlternativaCorreta($alternativaCorreta)
    {
        $this->alternativaCorreta = $alternativaCorreta;
    }

    public function setAlternativaErrada1($alternativaErrada1)
    {
        $this->alternativaErrada1 = $alternativaErrada1;
    }

    public function setAlternativaErrada2($alternativaErrada2)
    {
        $this->alternativaErrada2 = $alternativaErrada2;
    }

    public function setAlternativaErrada3($alternativaErrada3)
    {
        $this->alternativaErrada3 = $alternativaErrada3;
    }

    public function setAlternativaErrada4($alternativaErrada4)
    {
        $this->alternativaErrada4 = $alternativaErrada4;
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pergunta(
                $registro['id_pergunta'],
                $registro['pergunta'],
                $registro['id_usuario'],
                $registro['dificuldade'],
                $registro['alternativa_correta'],
                $registro['alternativa_errada1'],
                $registro['alternativa_errada2'],
                $registro['alternativa_errada3'],
                $registro['alternativa_errada4']
            );
        }
        return $objetos;
    }
}
