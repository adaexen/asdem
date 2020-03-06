<?php

class Conectar
{
 public static function con()
 {
  if(!$conexion=mysqli_connect("localhost","root","M01ses8o8o@1980","axclick2call"))
 {
  echo 'No hubo conexion';
  exit();
 }
  return $conexion;
 }
}



class Trabajos
{

 private $comodin=array();


  public function insertaRegistro($uniqueid,$numero,$fecha,$callerid,$estado,$record,$cedula,$proveedor,$servicio,$pdusuario)
  {
   $sql="INSERT INTO registros VALUES(null,'$uniqueid','$numero',now(),'$callerid','ANSWER','$record','1','$cedula','$proveedor','$servicio','$pdusuario')";
   $res=mysqli_query(Conectar::con(),$sql);
  }

  
  public function updateEstado($estado,$uniqueid)
  {
   $sql="UPDATE registros SET estado='$estado' WHERE uniqueid='$uniqueid'";
   $res=mysqli_query(Conectar::con(),$sql);
  }

  

  public function traerEstado($callerid)
  {
   $sql="select estado FROM registros WHERE extension='$callerid' ORDER BY id DESC LIMIT 0, 1;";
   $res=mysqli_query(Conectar::con(),$sql);
   while($reg=mysqli_fetch_array($res))
         {
          array_push($this->comodin, $reg[0]);
         }
     
   return $this->comodin[0];
  }



  public function traerRecording($callerid)
  {
   $sql="select record FROM registros WHERE extension='$callerid' ORDER BY id DESC LIMIT 0, 1;";
   $res=mysqli_query(Conectar::con(),$sql);
   while($reg=mysqli_fetch_array($res))
         {
          array_push($this->comodin, $reg[0]);
         }

   return $this->comodin[0];
  }
    
    
  public function updateDuracion($billsec,$uniqueid)
  {
   $sql="UPDATE registros SET duracion='$billsec' WHERE uniqueid='$uniqueid'";
   $res=mysqli_query(Conectar::con(),$sql);
  }

    
    
    
 }

?>
