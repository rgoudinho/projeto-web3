<?php
namespace Controlador;

use \Modelo\Relatorio;

class RelatorioControlador extends Controlador
{
    public function gerar()
    {
        $relatorio = [];
        $relatorio[1] = Relatorio::buscarMaisAcertadaFacil();
        $relatorio[2] = Relatorio::buscarMaisErradaFacil();
        $relatorio[3] = Relatorio::buscarMaisAcertadaMedia();
        $relatorio[4] = Relatorio::buscarMaisErradaMedia();
        $relatorio[5] = Relatorio::buscarMaisAcertadaDificil();
        $relatorio[6] = Relatorio::buscarMaisErradaDificil();

        $this->visao('perguntas/relatorio.php', [
            'relatorio' => $relatorio
        ]);
    }
}