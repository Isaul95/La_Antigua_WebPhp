<?php
// $server="localhost";
// $db="antigua";
// $user="root";
// $pass="";
// $version="0.9d";
// $pgport=5432;
// $pchartfolder="./class/pchart2";


$servidor = "localhost";
$usuario = "root";
$pass = "";
$dbname = "antigua";

//Crear conexion con MySQL
$conn = mysqli_connect($servidor, $usuario, $pass, $dbname);

if(!$conn){
    die("Fallo la conexion: " . mysqli_connect_error());
}
