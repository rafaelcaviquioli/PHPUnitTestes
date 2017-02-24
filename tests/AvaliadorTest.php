<?php
require_once(__DIR__ . '/../Usuario.php');
require_once(__DIR__ . '/../Lance.php');
require_once(__DIR__ . '/../Leilao.php');
require_once(__DIR__ . '/../Avaliador.php');
require_once(__DIR__ . '/../vendor/autoload.php');

class AvaliadorTest extends PHPUnit_Framework_TestCase
{
    function testAceitaLeilaoValoresRamdomicos()
    {
        $leilao = new Leilao('PS4');

        $rafael = new Usuario('Rafael', 1);
        $joao = new Usuario('João', 2);
        $maria = new Usuario('Maria', 3);

        $leilao->propoe(new Lance($rafael, 4000));
        $leilao->propoe(new Lance($joao, 1000));
        $leilao->propoe(new Lance($rafael, 100));
        $leilao->propoe(new Lance($maria, 25000));
        $leilao->propoe(new Lance($joao, 3505));
        $leilao->propoe(new Lance($maria, 50));

        $avaliador = new Avaliador();
        $avaliador->avalia($leilao);

        $maiorEsperado = 25000;
        $menorEsperado = 50;

        $this->assertEquals($maiorEsperado, $avaliador->getMaiorValor());
        $this->assertEquals($menorEsperado, $avaliador->getMenorValor());

    }

    function testAceitaLeilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('PS4');

        $rafael = new Usuario('Rafael', 1);
        $joao = new Usuario('João', 2);
        $maria = new Usuario('Maria', 3);

        $leilao->propoe(new Lance($maria, 250));
        $leilao->propoe(new Lance($joao, 350));
        $leilao->propoe(new Lance($rafael, 400));

        $avaliador = new Avaliador();
        $avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;

        $this->assertEquals($maiorEsperado, $avaliador->getMaiorValor());
        $this->assertEquals($menorEsperado, $avaliador->getMenorValor());

    }

    function testAceitaLeilaoEmOrdemDecrecente()
    {
        $leilao = new Leilao('PS4');

        $rafael = new Usuario('Rafael', 1);
        $joao = new Usuario('João', 2);
        $maria = new Usuario('Maria', 3);

        $leilao->propoe(new Lance($rafael, 400));
        $leilao->propoe(new Lance($joao, 300));
        $leilao->propoe(new Lance($maria, 200));
        $leilao->propoe(new Lance($maria, 100));

        $avaliador = new Avaliador();
        $avaliador->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 100;

        $this->assertEquals($maiorEsperado, $avaliador->getMaiorValor());
        $this->assertEquals($menorEsperado, $avaliador->getMenorValor());

    }

    function testValorMedioDeLance()
    {
        $leilao = new Leilao('PS4');

        $rafael = new Usuario('Rafael', 1);
        $joao = new Usuario('João', 2);
        $maria = new Usuario('Maria', 3);

        $leilao->propoe(new Lance($rafael, 400));
        $leilao->propoe(new Lance($joao, 350));
        $leilao->propoe(new Lance($maria, 250));

        $avaliador = new Avaliador();
        $avaliador->avalia($leilao);

        $valorMedioEsperado = 333.33;

        $this->assertEquals($valorMedioEsperado, $avaliador->getValorMedioLance($leilao), 0.00001);
    }

    public function testAceitaLeilaoComUmLance()
    {

        $joao = new Usuario("Joao", 1);

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 250;
        $menorEsperado = 250;

        $this->assertEquals($leiloeiro->getMaiorValor(), $maiorEsperado);
        $this->assertEquals($leiloeiro->getMenorValor(), $menorEsperado);
    }

    public function testPegaOsTresMaiores()
    {

        $joao = new Usuario("Joao", 1);
        $renan = new Usuario("Renan", 2);
        $felipe = new Usuario("Felipe", 3);

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($felipe, 400));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(count($maiores), 3);
        $this->assertEquals($maiores[0]->getValor(), 400);
        $this->assertEquals($maiores[1]->getValor(), 300);
        $this->assertEquals($maiores[2]->getValor(), 250);
    }

    public function testPegaOsTresMaioresLancesDeUmLeilaoComCincoLances()
    {

        $joao = new Usuario("Joao", 1);
        $renan = new Usuario("Renan", 2);
        $felipe = new Usuario("Felipe", 3);

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 250));
        $leilao->propoe(new Lance($renan, 300));
        $leilao->propoe(new Lance($joao, 800));
        $leilao->propoe(new Lance($felipe, 1500));
        $leilao->propoe(new Lance($renan, 2200));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getTresMaiores();

        $this->assertEquals(count($maiores), 3);
        $this->assertEquals($maiores[0]->getValor(), 2200);
        $this->assertEquals($maiores[1]->getValor(), 1500);
        $this->assertEquals($maiores[2]->getValor(), 800);
    }
    public function testLeilaoComDoisLances()
    {

        $joao = new Usuario("Joao", 1);
        $renan = new Usuario("Renan", 2);

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao, 500));
        $leilao->propoe(new Lance($renan, 1000));

        $this->assertEquals(count($leilao->getLances()), 2);
        $this->assertEquals($leilao->getLances()[0]->getValor(), 500);
        $this->assertEquals($leilao->getLances()[1]->getValor(), 1000);
    }

    public function testLeilaoSemLances()
    {

        $leilao = new Leilao("Playstation 3");

        $this->assertEquals(count($leilao->getLances()), 0);
    }
}