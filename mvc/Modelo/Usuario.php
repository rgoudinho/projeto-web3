<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_USUARIO_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_USUARIO_EMAIL = 'SELECT * FROM usuarios WHERE email = ?';
    const BUSCAR_USUARIO_NOME = 'SELECT * FROM usuarios WHERE nome = ?';
    const INSERIR = 'INSERT INTO usuarios(nome, email, senha) VALUES (?,?,?)';

    private $id_usuario;
    private $nome;
    private $senha;
    private $senhaPlana;
    private $email;

    public function __construct(
        $nome,
        $email,
        $senhaPlana,
        $id_usuario = null
    )
    {
        $this->email = $email;
        $this->id_usuario = $id_usuario;
        $this->nome = $nome;
        $this->senhaPlana = $senhaPlana;
        $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
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

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public function salvar()
    {
        $this->inserir();
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

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_USUARIO_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();
        $usuario = null;
        if ($registro) {
            $usuario = new Usuario(
                $registro['nome'],
                $registro['email'],
                null,
                $registro['id']
            );
            $usuario->senha = $registro['senha'];
        }
        return $usuario;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_USUARIO_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Usuario(
            $registro['nome'],
            $registro['email'],
            null,
            $registro['id']
        );
    }

    public static function buscarNome($nome)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_USUARIO_NOME);
        $comando->bindValue(1, $nome, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();
        return new Usuario(
            $registro['nome'],
            $registro['email'],
            null,
            $registro['id']
        );
    }

}