<?php
class Usuario {
    private $nome;
    private $id;

    /**
     * Usuario constructor.
     * @param $nome
     * @param $id
     */
    public function __construct($nome, $id)
    {
        $this->nome = $nome;
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}