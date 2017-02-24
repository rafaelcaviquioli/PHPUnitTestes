<?php

class Lance
{
    private $usuario;
    private $valor;

    function __construct(Usuario $usuario, $valor)
    {
        $this->usuario = $usuario;
        $this->valor = $valor;
    }

    /**
     * @return Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     * @return Lance
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param mixed $valor
     * @return Lance
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

}