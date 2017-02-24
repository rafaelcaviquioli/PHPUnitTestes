<?php

class Avaliador
{
    public $maiorValor = -INF;
    public $menorValor = INF;
    public $valorMedioLance;
    public $maiores;

    public function avalia(Leilao $leilao)
    {
        $i = $valor = 0;

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }

            $i++;
            $valor += $lance->getValor();
        }

        $this->valorMedioLance = number_format($valor / $i, 2);

        $this->pegaOsMaioresNo($leilao);
    }
    public function pegaOsMaioresNo(Leilao $leilao) {

        $lances = $leilao->getLances();
        usort($lances,function ($a,$b) {
            if($a->getValor() == $b->getValor()) return 0;
            return ($a->getValor() < $b->getValor()) ? 1 : -1;
        });

        $this->maiores = array_slice($lances, 0,3);
    }
    /**
     * @return mixed
     */
    public function getMaiorValor()
    {
        return $this->maiorValor;
    }

    /**
     * @return mixed
     */
    public function getMenorValor()
    {
        return $this->menorValor;
    }

    /**
     * @return mixed
     */
    public function getValorMedioLance()
    {
        return $this->valorMedioLance;
    }

    public function getTresMaiores() {
        return $this->maiores;
    }
}