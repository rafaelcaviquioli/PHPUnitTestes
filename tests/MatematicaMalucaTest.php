<?php
require_once(__DIR__ . '/../MatematicaMaluca.php');
require_once(__DIR__ . '/../vendor/autoload.php');

class MatematicaMalucaTest extends PHPUnit_Framework_TestCase
{
    function testContaMaluca(){
        $calculadora = new MatematicaMaluca();

        $this->assertEquals(200, $calculadora->contaMaluca(50));
        $this->assertEquals(60, $calculadora->contaMaluca(20));
        $this->assertEquals(10, $calculadora->contaMaluca(5));
    }
}