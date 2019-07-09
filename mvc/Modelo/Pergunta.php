<?php

namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;
use \Modelo\Usuario;

class Pergunta extends Modelo
{
    const BUSCAR_TODOS = 'SELECT * FROM perguntas ORDER BY id DESC LIMIT ? OFFSET ?';
    const BUSCAR_POR_DIFICULDADE = 'SELECT * FROM perguntas WHERE dificuldade = ? ORDER BY id DESC LIMIT ? OFFSET ?';
    const INSERIR = 'INSERT INTO perguntas(pergunta, alternativa_correta, alternativa_errada1, alternativa_errada2, alternativa_errada3, alternativa_errada4, dificuldade, id_usuario, acertos, erros) VALUES (?, ?, ?, ?, ?, ?, ?, ?,0,0)';
    const BUSCAR_PELO_ID = 'SELECT * FROM perguntas WHERE id = ? LIMIT 1';
    const DELETAR = 'DELETE FROM perguntas WHERE id = ?';
    const ATUALIZAR = 'UPDATE perguntas SET pergunta = ?, alternativa_correta = ?, alternativa_errada1 = ?, alternativa_errada2 = ?, alternativa_errada3 = ?, alternativa_errada4 = ?, dificuldade = ?, id_usuario = ? WHERE id = ?';
    const BUSCAR_PELA_PERGUNTA = 'SELECT * FROM perguntas WHERE pergunta = ? LIMIT 1';
    const CONTAR_TODOS = 'SELECT count(id) FROM perguntas';
    const CONTAR_TODOS_POR_DIFICULDADE = 'SELECT count(id) FROM perguntas WHERE dificuldade = ? ';
    const ATUALIZAR_ACERTOS = 'UPDATE perguntas SET acertos = ? WHERE id = ?';
    const ATUALIZAR_ERROS = 'UPDATE perguntas SET erros = ? WHERE id = ?';
    const BUSCA_ACERTOS = 'SELECT acertos FROM perguntas WHERE id = ?';
    const BUSCA_ERROS = 'SELECT erros FROM perguntas WHERE id = ?';

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
    private $acertos;
    private $erros;

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

    public function getDificuldade()
    {
        if ($this->dificuldade == 1)
            return "Facíl";
        elseif ($this->dificuldade == 2)
            return "Médio";
        else
            return "Didícil";
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

    public function getUsuario()
    {
        return Usuario::buscarNome($this->getId_usuario());
    }

    public function getAcertos()
    {
        return $this->acertos;
    }

    public function getErros()
    {
        return $this->erros;
    }

    public function setId_usuario($id_usuario)
    {
        return $this->id_usuario = $id_usuario;
    }

    public function setPergunta($pergunta)
    {
        return $this->pergunta = $pergunta;
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

    public function setDificuldade($dificuldade)
    {
        $this->dificuldade = $dificuldade;
    }

    public function setAcertos($acerto)
    {
        $this->acertos = $acerto;
    }

    public function setErros($erro)
    {
        $this->erros = $erro;
    }

    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindvalue(1, $limit, PDO::PARAM_INT);
        $comando->bindvalue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
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
        }
        return $objetos;
    }

    public static function buscarPelaPergunta($pergunta)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_PELA_PERGUNTA);
        $comando->bindValue(1, $pergunta, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Pergunta(
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
        }
        return $objeto;
    }

    public static function buscarTodosPorDificuldade($limit, $offset, $dificuldade)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_DIFICULDADE);
        $comando->bindvalue(1, $dificuldade, PDO::PARAM_INT);
        $comando->bindvalue(2, $limit, PDO::PARAM_INT);
        $comando->bindvalue(3, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
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
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function contarTodosPorDificuldade($dificuldade)
    {
        $comando = DW3BancoDeDados::prepare(self::CONTAR_TODOS_POR_DIFICULDADE);
        $comando->bindvalue(1, $dificuldade, PDO::PARAM_INT);
        $comando->execute();
        $total = $comando->fetch();
        return intval($total[0]);
    }

    public static function buscarPeloId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_PELO_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Pergunta(
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
        }
        return $objeto;
    }

    public function verificaUsuarioPergunta($id, $usuarioAtivo)
    {
        $pergunta = $this->buscarPeloId($id);

        if ($pergunta->getId_usuario() == $usuarioAtivo->getId_usuario()) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarResposta($resposta)
    {
        if ($resposta == $this->getAlternativaCorreta()) {
            return true;
        } else {
            return false;
        }
    }

    protected function verificarErros()
    {
        if (strlen($this->pergunta) < 10 || strlen($this->pergunta) > 1000)
            $this->setErroMensagem('pergunta', 'Mínimo 10 caracteres e maximo de 1000.');
        if (strlen($this->alternativaCorreta) < 1 || strlen($this->alternativaCorreta) > 200)
            $this->setErroMensagem('alternativacorreta', 'Mínimo 1 caracteres e maximo de 200.');
        if (strlen($this->alternativaErrada1) < 1 || strlen($this->alternativaErrada1) > 200)
            $this->setErroMensagem('alternativaErrada1', 'Mínimo 1 caracteres e maximo de 200.');
        if (strlen($this->alternativaErrada2) > 200)
            $this->setErroMensagem('alternativaErrada2', 'Maximo de 200.');
        if (strlen($this->alternativaErrada3) > 200)
            $this->setErroMensagem('alternativaErrada3', 'Maximo de 200.');
        if (strlen($this->alternativaErrada4) > 200)
            $this->setErroMensagem('alternativaErrada4', 'Maximo de 200.');
    }

    public function salvar()
    {
        if ($this->id == null) {
            $this->inserir();
            $this->salvarImagem();
        } else {
            $this->atualizar();
        }
    }

    private function salvarImagem()
    {
        if (DW3ImagemUpload::isValida($this->foto)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";

            DW3ImagemUpload::salvar($this->foto, $nomeCompleto);
        }
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->pergunta, PDO::PARAM_STR);
        $comando->bindValue(2, $this->alternativaCorreta, PDO::PARAM_STR);
        $comando->bindValue(3, $this->alternativaErrada1, PDO::PARAM_STR);
        $comando->bindValue(4, $this->alternativaErrada2, PDO::PARAM_STR);
        $comando->bindValue(5, $this->alternativaErrada3, PDO::PARAM_STR);
        $comando->bindValue(6, $this->alternativaErrada4, PDO::PARAM_STR);
        $comando->bindValue(7, $this->dificuldade, PDO::PARAM_INT);
        $comando->bindValue(8, $this->id_usuario, PDO::PARAM_INT);
        $comando->bindValue(9, $this->id, PDO::PARAM_INT);
        $comando->execute();
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
        $comando->bindValue(7, $this->dificuldade, PDO::PARAM_INT);
        $comando->bindValue(8, $this->id_usuario, PDO::PARAM_STR);

        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public function atualizarAcertos($id)
    {
        $this->acertos = $this->buscarAcertos($id) + 1;
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_ACERTOS);
        $comando->bindValue(1, $this->acertos, PDO::PARAM_INT);
        $comando->bindValue(2, $id, PDO::PARAM_INT);
        $comando->execute();
        $this->setAcertos($this->buscarAcertos($id));
    }

    public function buscarAcertos($id)
    {
        $comando = DW3BancoDeDados::prepare((self::BUSCA_ACERTOS));
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $pesquisa = $comando->fetch();
        return $pesquisa[0];
    }

    public function atualizarErros($id)
    {
        $this->erros = $this->buscarErros($id) + 1;
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR_ERROS);
        $comando->bindValue(1, $this->erros, PDO::PARAM_INT);
        $comando->bindValue(2, $id, PDO::PARAM_INT);
        $comando->execute();
        $this->setAcertos($this->buscarErros($id));
    }

    public function buscarErros($id)
    {
        $comando = DW3BancoDeDados::prepare((self::BUSCA_ERROS));
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $pesquisa = $comando->fetch();
        return $pesquisa[1];
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
