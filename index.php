<?php

include './GeneradorRGB.php';
include './GeneradorHEX.php';
//include './GeneradorColorKML.php';
include './FactoryGeneradorColores.php';
include './db_connect.php';



include './KMLBuilder.php';





//$fechas="2019-09-04 01:02:03;2019-09-04 02:08:08";



$fechas="2019-07-05 01:02:03;2019-07-05 2:10:08";



$fechaBusqueda=[];

$fechaBusqueda=explode(";",$fechas);



$supervisores=null;

$supervisores=obneterSupervisores($link);
echo sizeof($supervisores);





//puntos iniciales y finales

$puntoInicial=null;
$puntoFinal=null;

$rutaReporte="output/";
$archivo="seguimientoTodos_".rand().".kml";

$rutaSupervisor=null;



$kmlBuilder=new KMLBuilder(sizeof($supervisores),$rutaReporte.$archivo);

$kmlBuilder->addHeader();
$kmlBuilder->addStyles();
$kmlBuilder->addElementosIntermedios();






$contadorRutas=0;
 foreach($supervisores as $supervisor){ //ciclo para buscar las ubicaciones de los supervisores
   //echo "sub: ".$supervisor;
   
   $movil=explode(";",$supervisor)[0];

   echo "<br>";
   echo "movil:".$movil;
   echo "<br>";
   //$movil=11;
   
  


 
  $query2 = "SELECT tbl_seguimiento.*, Nombres, Apellidos FROM tbl_seguimiento INNER JOIN tbl_usuarios ON tbl_seguimiento.movil=tbl_usuarios.movil WHERE tbl_seguimiento.movil='".$movil."' AND fecha_hora between '".$fechaBusqueda[0]."' AND '".$fechaBusqueda[1]."'ORDER BY fecha_hora  DESC  ";
  $result2=null;
  echo $query2;
  //echo "<br>";
  
  if (!mysqli_connect_errno()) {
    $result2 = mysqli_query($link, $query2);

if($result2){

 // echo "tamaño de la consulta: ".mysqli_num_rows($result2)."";
  //echo "<br>";

  $contadorPuntos=0;
  $cantidadPuntos=mysqli_num_rows($result2);

  while($row=mysqli_fetch_array($result2)){

    if ($contadorPuntos==0){
      $puntoFinal=" ".$row["longitud"].",".$row["latitud"].","."0";
    }

    if($contadorPuntos==$cantidadPuntos-1){
      $puntoInicial=" ".$row["longitud"].",".$row["latitud"].","."0";

    }


    $rutaSupervisor=$rutaSupervisor." ".$row["longitud"].",".$row["latitud"].","."0"." ";
    //echo " ".$row["longitud"].",".$row["latitud"].","."0";
    echo "<br>";
    echo $rutaSupervisor;
    echo "<br>";
   $contadorPuntos=$contadorPuntos+1;
    
  }

  

$kmlBuilder->addRoute("pi"." movil:".$movil,"punto Inicial","pf"." movil:".$movil,"puntoFinal",$rutaSupervisor,$contadorRutas,$puntoInicial,$puntoFinal);



}else{
  
}
//echo "puntoIncial: ".$puntoInicial;
//echo "<br>";
//echo "puntoFinal: ".$puntoFinal;
//echo "<br>";


//addRoute($nombrePuntoInicial_,$descripcionPuntoInicial_,$nombrePuntoFinal_,$descripcionPuntoFinal_,$coordenadas_,$estiloCoordenada_,$coordenadaInicial_,$coordenadaFinal_)



$rutaSupervisor=null;
$result2=null;
$puntoFinal=null;
$puntoInicial=null;




}


//echo "rutaSupervisor: ".$rutaSupervisor;
    
$contadorRutas=$contadorRutas+1;
 }//cierre de ciclo para hacer las consultas de los puntos de los supervisores

 $kmlBuilder->addFooter();

 


 
function obneterSupervisores($link){
// link es el parámetro de entrada de enlace a la base de datos a la que se le realizará la consulta


$supervisores=[];
$result=null;
if (!mysqli_connect_errno()) 
{ 
  $conexion=true;
  //supervisores
  $sql="SELECT movil, Nombres, Apellidos FROM tbl_usuarios WHERE Perfil='supervisor' order by Nombres, Apellidos";
  //echo $sql;
  //echo "<br>";

  $result=mysqli_query($link,$sql);
  if($result){
    $sel="";
    while($row=mysqli_fetch_array($result))
    {     
     //echo $row["movil"].$row["Nombres"].$row["Apellidos"];
     //echo "<br>";
     array_push($supervisores, $row["movil"].";".$row["Nombres"].";".$row["Apellidos"]);

    }

    //echo $result ->num_rows;
  }
  else
    $supervisores='<option>'.mysqli_error($link).'</option>';
    }

    return $supervisores;


 }
 

















?>



