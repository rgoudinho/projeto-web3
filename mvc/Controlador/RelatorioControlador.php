<?php
namespace Controlador;

use \Modelo\Relatorio;

class RelatorioControlador extends Controlador
{
    public function gerar()
    {
        $relatorio = Relatorio::buscarMaisAcertadaFacil();
        
        $this->visao('perguntas/relatorio.php', [
            'relatorio' => $relatorio
        ]);
    }
}