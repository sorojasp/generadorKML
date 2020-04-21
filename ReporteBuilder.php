<?php

abstract class ReporteBuilder{


    public abstract function addFooter();
    public abstract function addHeader();
    //private abstract function addPoint(); 
    public abstract function addRoute($nombrePuntoInicial_,$descripcionPuntoInicial_,$nombrePuntoFinal_,
    $descripcionPuntoFinal_,$coordenadas_,$estiloCoordenada_,$coordenadaInicial_,$coordenadaFinal_);
    public abstract function addStyles();
    //public abstract function createFile();



}





?>