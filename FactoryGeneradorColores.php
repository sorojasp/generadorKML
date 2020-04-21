<?php

use GeneradorColorKML as GeneKML;
use GeneradorHEX as GeneHEX;
use GeneradorRGB as GeneRGB;


class FactoryGeneradorColores{


public function __construct()
{
    
}


public function obtenerGeneradorColores($type, $cantidadColores){

    switch($type){

        case "RGB":
            return new GeneRGB($cantidadColores);

        case "KML":
            return new GeneKML($cantidadColores);

        case "HEX":
            return new GeneHEX($cantidadColores);



    }



}


}








?>