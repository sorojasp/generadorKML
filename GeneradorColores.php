<?php

abstract class GeneradorColores{

    private $cantidadColores;
    private $colores=array();

    function __construct($cantidadColores_){
        $this->cantidadColores=$cantidadColores_;
    }



    abstract public function generarColores();
    
    public function getCantidadColores(){
        return $this->cantidadColores;
    }

    public function setCantidadColores($cantidadColores_){

        $this->cantidadColores=$cantidadColores_;
    }

    public function getColores(){

        return $this->colores;
    }


    public function addColor($color_){
        array_push($this->colores,$color_);

    }

}




?>