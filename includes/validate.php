<?php 
/*
Validaciones generales
*/
if ( isset($_GET['debug']) && $_GET['debug']=='log' && $debugging == true )
{
	$debug = 'log';
}
include('includes/functions.php');
if ( isset($_GET['playmode']) )
{
	$playMode = rawurlencode($_GET['playmode']);
	$container_class = 'container-fluid container-fluid-noplayer';
}
else
{
	// Apply a different container class for player vs. no player
	$container_class = 'container-fluid';
}
if ( isset($_GET['track']) )
{
	$track = rawurlencode($_GET['track']);
}
if ( isset($_GET['trackno']) )
{
	$trackno = rawurlencode($_GET['trackno']);
}
// Determine if direct links to files are OK or if stream is required
$stream = getWebRoot($root);
?>