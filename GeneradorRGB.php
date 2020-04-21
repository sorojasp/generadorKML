<?php
include './GeneradorColores.php';

class GeneradorRGB extends GeneradorColores{

    public function __construct($cantidadColores_){

        GeneradorColores::__construct($cantidadColores_);

        
    }   
    

    public function generarColores(){

        
        $spread = 25;
        for ($row = 0; $row < GeneradorColores::getCantidadColores(); ++$row) {
        for($c=0;$c<3;++$c) {
            $color[$c] = rand(0+$spread,255-$spread);
        }
        //echo "<div style='float:left; background-color:rgb($color[0],$color[1],$color[2]);'>&nbsp;Base Color&nbsp;</div><br/>";
        for($i=0;$i<1;++$i) {
            $r = rand($color[0]-$spread, $color[0]+$spread);
            $g = rand($color[1]-$spread, $color[1]+$spread);
            $b = rand($color[2]-$spread, $color[2]+$spread);    
            //echo "<div style='background-color:rgb($r,$g,$b); width:10px; height:10px; float:left;'></div>";
            GeneradorColores::addColor("$r".","."$g".","."$b");
            //echo strtoupper("FF".fromRGB("$r","$g","$b"));
        }

     
    }


    return GeneradorColores::getColores();

}






}




?>