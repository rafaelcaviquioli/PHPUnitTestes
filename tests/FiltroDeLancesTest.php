<?php

require_once(__DIR__ . '/../MatematicaMaluca.php');
require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../Usuario.php');
require_once(__DIR__ . '/../Lance.php');
require_once(__DIR__ . '/../Leilao.php');
require_once(__DIR__ . '/../Avaliador.php');
require_once(__DIR__ . '/../FiltroDeLances.php');
class FiltroDeLancesTest extends PHPUnit_Framework_TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao", 1);

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,2000);
        $lances[] = new Lance($joao,1000);
        $lances[] = new Lance($joao,3000);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);

        $this->assertEquals(1, count($resultado));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao", 1);

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,600);
        $lances[] = new Lance($joao,500);
        $lances[] = new Lance($joao,700);
        $lances[] = new Lance($joao,800);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(1, count($resultado));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesMaioresQue5000() {
        $joao = new Usuario("Joao", 1);

        $filtro = new FiltroDeLances();
        $lances = [];
        $lances[] = new Lance($joao,3200);
        $lances[] = new Lance($joao,3500);
        $lances[] = new Lance($joao,3800);
        $lances[] = new Lance($joao,4000);
        $lances[] = new Lance($joao,8000);
        $lances[] = new Lance($joao,9000);

        $resultado = $filtro->filtra($lances);
        $this->assertEquals(2, count($resultado));
        $this->assertEquals(8000, $resultado[0]->getValor(), 0.00001);
        $this->assertEquals(9000, $resultado[1]->getValor(), 0.00001);
    }
}