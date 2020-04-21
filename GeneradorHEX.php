<?php

use GeneradorColores as GC;
use GeneradorRGB as GRGB;

class GeneradorHEX  extends GeneradorColores{
    
    
    
    public function __construct($cantidadColores_){

        GC::__construct($cantidadColores_);
        
    }

    public function generarColores(){
       $coloresRGB=array();

        
        $objRGB= new GRGB(GC::getCantidadColores());
        $coloresRGB= $objRGB->generarColores();

        foreach($coloresRGB as $key=>$val) {
            
            
            GC::addColor($this->convertirFormatoHEX($val));

        } 

        return GC::getColores();

    
    }


    private function convertirFormatoHEX($colorRGB){

        $arrayRGBcolor= explode(",",$colorRGB);

        $R=$arrayRGBcolor[0];
        $G=$arrayRGBcolor[1];
        $B=$arrayRGBcolor[2];

        $R = dechex($R);
        if (strlen($R)<2)
        $R = '0'.$R;
    
        $G = dechex($G);
        if (strlen($G)<2)
        $G = '0'.$G;
    
        $B = dechex($B);
        if (strlen($B)<2)
        $B = '0'.$B;
    
        return  strtoupper($R . $G . $B);

    }


    







}

?>