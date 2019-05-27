<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_USUARIO = 'SELECT * FROM usuario WHERE id_usuario = ?';
    
    private $id_usuario;
    private $nome;
    private $senha;

    public function __construct(
        $id_usuario,
        $nome,
        $senha
    )
    {
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

}