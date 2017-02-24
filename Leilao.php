<?php

class Leilao
{
    private $descricao;
    private $lances;

    /**
     * Leilao constructor.
     * @param $descricao
     */
    public function __construct($descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function propoe(Lance $lance)
    {
        $this->lances[] = $lance;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @return Lance[]
     */
    public function getLances()
    {
        return $this->lances;
    }
}