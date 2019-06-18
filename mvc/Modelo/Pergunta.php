<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Pergunta extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM perguntas';
    const INSERIR = 'INSERT INTO perguntas(pergunta, alternativa_correta, alternativa_errada1, alternativa_errada2, alternativa_errada3, alternativa_errada4, dificuldade, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    private $id;
    private $pergunta;
    private $id_usuario;
    private $dificuldade;
    private $alternativaCorreta;
    private $alternativaErrada1;
    private $alternativaErrada2;
    private $alternativaErrada3;
    private $alternativaErrada4;
    private $foto;

    private $aleatorios = [];

    public function __construct(
        $pergunta = null,
        $alternativaCorreta = null,
        $alternativaErrada1 = null,
        $alternativaErrada2 = null,
        $alternativaErrada3 = null,
        $alternativaErrada4 = null,
        $dificuldade = null,
        $id_usuario = null,
        $foto = null,
        $id = null
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
        $this->foto = $foto;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function getPergunta()
    {
        return $this->pergunta;
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

    public function getAleatorios()
    {
        return $this->aleatorios;
    }

    public function getFoto()
    {
        $imagemNome = "{$this->id}.png";
        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }
        return $imagemNome;
    }

    public function setId_usuario($id_usuario)
    {
        return $this->id_usuario = $id_usuario;
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

    public function setAleatorios($posicao, $aleatorio)
    {
        $this->aleatorios[$posicao] = $aleatorio;
    }

    public static function buscarTodos()
    {
        $registros = DW3BancoDeDados::query(self::BUSCAR_TODOS);
        $objetos = [];
        foreach ($registros as $registro) {
            $objetos[] = new Pergunta(
                $registro['pergunta'],
                $registro['alternativa_correta'],
                $registro['alternativa_errada1'],
                $registro['alternativa_errada2'],
                $registro['alternativa_errada3'],
                $registro['alternativa_errada4'],
                $registro['dificuldade'],
                $registro['id_usuario'],
                null,
                $registro['id']
            );
            // $pergunta = null,
            // $alternativaCorreta = null,
            // $alternativaErrada1 = null,
            // $alternativaErrada2 = null,
            // $alternativaErrada3 = null,
            // $alternativaErrada4 = null,
            // $dificuldade = null,
            // $id_usuario = null,
            // $foto = null,
            // $id = null
        }
        return $objetos;
    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->pergunta, PDO::PARAM_STR);
        $comando->bindValue(2, $this->alternativaCorreta, PDO::PARAM_STR);
        $comando->bindValue(3, $this->alternativaErrada1, PDO::PARAM_STR);
        $comando->bindValue(4, $this->alternativaErrada2, PDO::PARAM_STR);
        $comando->bindValue(5, $this->alternativaErrada3, PDO::PARAM_STR);
        $comando->bindValue(6, $this->alternativaErrada4, PDO::PARAM_STR);
        $comando->bindValue(7, $this->dificuldade, PDO::PARAM_STR);
        $comando->bindValue(8, $this->id_usuario, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.jpg";
            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
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
}
