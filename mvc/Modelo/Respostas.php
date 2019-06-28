<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Respostas extends Modelo
{
    private const INSERIR = 'INSERT INTO respostas(id_usuario, id_pergunta) VALUES(?,?)';
    private const VERIFICASEUSUARIOJARESPONDEUAPERGUNTA = 'SELECT * FROM respostas WHERE id_usuario = ? AND id_pergunta = ?';
    private const PERGUNTAJARESPONDIDA ='SELECT * FROM respostas WHERE id_pergunta = ?' ;
    const DELETAR = 'DELETE FROM perguntas WHERE id_pergunta = ?';

    private $id;
    private $idUsuario;
    private $idPergunta;

    public function __construct($idUsuario, $idPergunta, $id = null)
    {
        $this->idUsuario = $idUsuario;
        $this->idPergunta = $idPergunta;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function getIdPergunta()
    {
        return $this->idPergunta;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
    public function setIdPergunta($idPergunta)
    {
        $this->idPergunta = $idPergunta;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->idUsuario, PDO::PARAM_INT);
        $comando->bindValue(2, $this->idPergunta, PDO::PARAM_INT);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    
    }

    public static function verificaSeUsuarioJaRespondeuAPergunta($idUsuario, $idPergunta)
    {
        $comando = DW3BancoDeDados::prepare(self::VERIFICASEUSUARIOJARESPONDEUAPERGUNTA);
        $comando->bindValue(1, $idUsuario, PDO::PARAM_INT);
        $comando->bindValue(2, $idPergunta, PDO::PARAM_INT);
        $comando->execute();
        $pesquisa = $comando->fetch();

        if($pesquisa == null) {
            return false;
        }
        return true;
    }

    public function perguntaJaRespondida()
    {
        $comando = DW3BancoDeDados::prepare(self::PERGUNTAJARESPONDIDA);
        $comando->bindValue(1, $this->idPergunta, PDO::PARAM_INT);
        $comando->execute();
        $pesquisa = $comando->fetch();

        if($pesquisa == null) {
            return false;
        }
        return true;
    }

    public function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }
}