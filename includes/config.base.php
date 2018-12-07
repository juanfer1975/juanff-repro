<?php
// Habilitar debugging
// Ejemplo: $debugging = true;
$debugging = false;

// La ruta RELATIVA
// Ejemplo: $root = '../../../backup/music'; (antes de la carpeta web)
// Ejemplo: $root = 'assets/music'; (Despues de la carpeta web)
// Ejemplo: $root = 'c:\\musica\\'; (Colocar doble \\ para reproducir desde su maquina o red)

$root = '../../../Musica/';
$root = 'c:\\xampp\\htdocs\\Musica\\';

// Ruta del reproductor URL con puerto si es necesario
// solo es requerido cuabndo se usa listas tipo m3u.
// ejemplo: $url = 'https://thejamesmachine.com';
// ejemplo: $url = 'https://mynas.dyndns.org:8080/music';
$url = '';

// Listado inicial por letra (#, A, B, C...)
// Ejemplo: $group = false;
$group = false;

// Adicionar el enlace de descargar
// Ejemplo: $download = true;
$download = true;

// Adiciona el enlace al M3U pero si su directorio web esta protegido es posible que no funcione
// Ejemplo: $m3u = false;
$m3u = false;

// Extensiones soportadas
// Borrar los que deseen. Las extensiones son en minusculas
$types[] = 'aac';
$types[] = 'm4a';
$types[] = 'f4a';
$types[] = 'mp3';
$types[] = 'ogg';
$types[] = 'oga';

// Metodo entrega del archivo: Download or Stream
// Download es sencillo y  JWPlayer muestra la barra de progreso
// Stream es compatible con android y IOS, Pero mostrara  "Live Stream" y sin barra de progreso
// Ejemplo: $delivery = 'download';
$delivery = 'stream';

// Repetir se le debe agregar al final la coma
// Ejemplo: $repeat = 'repeat: true,';
$repeat = 'repeat: false,';

// Numero de canciones incluidas en el modo aleatorio
// Si hay pocas canciones, el sistema se ajusta automaticamente.
$rand_count = 100;

// JWPlayer version 6
// Se puede usar sin liencia
// Version 7 requiere registro y acceso a una clave o key
// https://www.jwplayer.com/sign-up/
// Ejemplo: $jwversion = 6;
// Ejemplo: $jwversion = 7;
$jwversion = 6;

// JWPlayer version y configuraciones especificas
if ( $jwversion == 6 )
{
	// Reproductor por defecto y requiere la coma
	// Ejemplo: $player = 'primary: "flash",';
	$player = 'primary: "flash",';

	// Plantilla vista de reproductor, con coma incluida
	// En blanco, ejecuta un reproductor pequeño
	// mlp es una plantilla que maneja el doble del tamaño del reproductor por defecto
	// Ejemplo: $skin = 'skin: "jwplayer6/mlp/mlp.xml",';
	$skin = 'skin: "jwplayer6/mlp/mlp.xml",';

	// Acceso a clave
	// Se deja en blanco en Version 6
	$jwplayer_key = '';
}
elseif ( $jwversion == 7 )
{
	// Player default
	// Leave empty in Version 7
	$player = '';

	// Plantilla vista de reproductor, con coma incluida
	// En blanco, ejecuta un reproductor pequeño
	// mlp es una plantilla que maneja el doble del tamaño del reproductor por defecto
	// Ejemplo: $skin = 'skin: "jwplayer6/mlp/mlp.xml",';

	$skin = 'skin: {name: "MLP"},';

	// Player key
	// $jwplayer_key = 'P0FgzfAFbLEuegWaWLPdlec+1JHYXAiuoDcqaQ==';
	$jwplayer_key = '';
}
// buscador de google
// estos parametros los debe extraer del google api console
$apigoogle=""; // https://developers.google.com/
$Search_engine_ID=""; // https://cse.google.com/
?>