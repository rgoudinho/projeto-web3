<?php
namespace Controlador;

use \Framework\DW3Controlador;
use \Framework\DW3Sessao;
use \Modelo\Usuario;

trait ControladorVisao
{
    protected function getErroCss($campoNome)
    {
        return $this->temErro($campoNome) ? 'text-danger' : '';
    }
}
