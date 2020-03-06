#!/usr/bin/php -q
<?php

pcntl_signal(SIGHUP, SIG_IGN);

include_once("/var/www/html/class/class.php");
include_once("phpagi/phpagi.php");

$agi = new AGI();
$nmarcado = $argv[1];
$callerid = $argv[2];
$uniqueid = $argv[3];
$date     = $argv[4];
$cedula   = $argv[5];
$proveedor = $argv[6];
$servicio = $argv[7];
$pdusuario = $argv[8];
$record   ="/var/www/html/recordings/$uniqueid.wav";
$agi->exec('MixMonitor',"/var/www/html/recordings/$uniqueid.wav,bW(3)");
$agi->exec('DIAL',"SIP/1980tic/57$nmarcado");
$dialstatus=$agi->get_variable("DIALSTATUS");
$estado="${dialstatus['data']}";

$ins=new Trabajos();
$ins->insertaRegistro($uniqueid,$nmarcado,$date,$callerid,$estado,$record,$cedula,$proveedor,$servicio,$pdusuario);
$ins->updateEstado($estado,$uniqueid);

$billsec=$agi->get_variable('CDR(billsec)',true);
$ins->updateDuracion($billsec,$uniqueid);
exit();
?>

