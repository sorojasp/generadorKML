<?php

include './ReporteBuilder.php';

include './GeneradorColorKML.php';



class KMLBuilder extends ReporteBuilder {

    private $cantidadRutas=0;
    private $enlaceArchivo;
    private $rutaBaseRuta='./reportesKML/kml_route.txt';
    private $rutaCabecera='./reportesKML/kml_head.txt';
    private $rutaEnding='./reportesKML/kml_ending.txt';
    private $rutaIntermedio='./reportesKML/kml_elementosIntermedios.txt';
    private $rutaPunto='./reportesKML/kml_point.txt';
    private $rutaStyle= './reportesKML/kml_style.txt';
    private $gestorArchivo;
    private $contadorRutasEscritas=0;

    function __construct($cantidadRutas_, $enlaceArchivo_)
    {
        $this->cantidadRutas=$cantidadRutas_;
        $this->enlaceArchivo=$enlaceArchivo_;

        $this->createFile();
    }

    private function getTextoCabecera(){

        return file_get_contents($this->rutaCabecera);

    }


    private function getTextoRuta(){

        return file_get_contents($this->rutaBaseRuta);

    }


    private function getTextoPunto(){

        return file_get_contents($this->rutaPunto);
    }



    private function getTextoEnding(){
        return file_get_contents($this->rutaEnding);
    }

    
    private function getTextRutaIntermedio(){

        return file_get_contents($this->rutaIntermedio);
    }

    private function getTextStyle(){

        return file_get_contents($this->rutaStyle);
    }



    private function createFile()
    {
        if (!$this->gestorArchivo = fopen($this->enlaceArchivo, 'w')) {
    echo "Error: No se pudo crear el archivo KML.";
    exit;
}

    }

    public function addHeader()
    {
        if (fwrite($this->gestorArchivo, $this->getTextoCabecera()."\n\r") === FALSE) {
            echo "Error: No se pudo escribir la seccion HEAD del archivo KML.";
            exit;
          }
             
    }


    public function addStyles(){

        $generadorColorKML = new GeneradorColorKML($this->cantidadRutas);

        $arraykMLcolors= $generadorColorKML->generarColores();
        $contador=0;

        foreach($arraykMLcolors as $key=>$val){

            $textoStyle=$this->getTextStyle();

            $textoStyle=str_replace("idEstiloColor",$contador,$textoStyle);

            $textoStyle=str_replace("colorKML",$val,$textoStyle);


            if (fwrite($this->gestorArchivo, $textoStyle."\n\r") === FALSE) {
                echo "Error: No se pudo escribir la seccion Style del archivo KML.";
                exit;
              }



             $contador=$contador+1;
            }

        

    }


    public function addElementosIntermedios(){
        if (fwrite($this->gestorArchivo, $this->getTextRutaIntermedio()."\n\r") === FALSE) {
            echo "Error: No se pudo escribir la seccion elementosIntermedios del archivo KML.";
            exit;
          }



    }


    private function addPoint($nombrePunto_, $descripcionPunto_,$coordenada_){

        
        $textoPunto=$this->getTextoPunto();
        $textoPunto= str_replace("nombrePunto",$nombrePunto_,$textoPunto);
        $textoPunto= str_replace("descripcionPunto",$descripcionPunto_,$textoPunto);
        $textoPunto=str_replace("coordenada",$coordenada_,$textoPunto);


        if (fwrite($this->gestorArchivo, $textoPunto."\n\r") === FALSE) {
            echo "Error: No se pudo escribir la seccion punto del archivo KML.";
            exit;
          }

    }





    public function addFooter(){

        if (fwrite($this->gestorArchivo, $this->getTextoEnding()."\n\r") === FALSE) {
            echo "Error: No se pudo escribir la seccion ending del archivo KML.";
            exit;
          }




    }


    public function addRoute($nombrePuntoInicial_,$descripcionPuntoInicial_,$nombrePuntoFinal_,
    $descripcionPuntoFinal_,$coordenadas_,$estiloCoordenada_,$coordenadaInicial_,$coordenadaFinal_){

        //if($this->contadorRutasEscritas<($this->cantidadRutas-1)){
            if(true){ 
            
        
        
        
        $this->addPoint($nombrePuntoInicial_,$descripcionPuntoInicial_,$coordenadaInicial_);//escritura de punto incial de la ruta


        $textoRuta=$this->getTextoRuta();
        $textoRuta=str_replace("coordenada",$coordenadas_,$textoRuta);
        $textoRuta=str_replace("nombreEstilo",$estiloCoordenada_,$textoRuta);

        if (fwrite($this->gestorArchivo, $textoRuta."\n\r") === FALSE) {
            echo "Error: No se pudo escribir la seccion ending del archivo KML.";
            exit;
          }
        

        $this->addPoint($nombrePuntoFinal_,$descripcionPuntoFinal_,$coordenadaFinal_);//escritura de punto final de la ruta

    $this->contadorRutasEscritas=$this->contadorRutasEscritas+1;
    
    }else{

        return false;



    }



    }







































}








?>