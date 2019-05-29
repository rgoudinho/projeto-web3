<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_USUARIO_ID = 'SELECT * FROM usuario WHERE id_usuario = ?';
    const BUSCAR_USUARIO_NOME = 'SELECT * FROM usuario WHERE nome = ?';
    const INSERIR = 'INSERT INTO usuario(nome, email, senha) VALUES (?,?,?)';

    private $id_usuario;
    private $nome;
    private $senha;
    private $email;

    public function __construct(
        $nome,
        $email,
        $senha,
        $id_usuario = null
    )
    {
        $this->email = $email;
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->senha = $senha;
    }

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function inserir(){
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

}