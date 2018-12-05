<?php
/*
Buscador google search
limitaciones: max 8 resultados por pagina y 64 en total
en el config.php se encuentra el apigoogle y el Search_engine_ID
*/
include ("includes/config.php");
require_once 'vendor/autoload.php';
$param=$_POST['param'];
if ($param=="") $param="es por tí - complices (original - audio HQ).mp3";
//$Search_engine_ID="017576662512468239146:omuauf_lfve";
$ruta="https://www.googleapis.com/customsearch/v1?key=".$apigoogle."&cx=".$Search_engine_ID;
$ruta.="&q=".$param;
$response = Unirest\Request::get($ruta);
$cuerpo=$response->raw_body;
$data=json_decode($cuerpo,true);
$res=array();
if ($param<>"") {
	//print_r($data["items"]);
	for ($i=0; $i <count($data) ; $i++) { 
		$title=$data["items"][$i]["title"];
		$displayLink=$data["items"][$i]["displayLink"];
		$snippet=$data["items"][$i]["snippet"];
		$formattedUrl=$data["items"][$i]["formattedUrl"];
		$res[]=array("title"=>$title,"displayLink"=>$displayLink,"snippet"=>$snippet,"formattedUrl"=>$formattedUrl);
	}
}
echo json_encode($res);