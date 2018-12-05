<?php 
/*
header
*/
?>
<title>Reproductor de musica</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
<link href='css/style.css' rel='stylesheet'>
<?php
include('includes/config.php');
/* Link to the jwplayer script */
?>
<script type='text/javascript' src='jwplayer<?php echo $jwversion;?>/jwplayer.js'></script>
<?php
if ( $jwversion == 7 )
{
	?>
	<script>jwplayer.key="<?php echo $jwplayer_key;?>";</script>
	<link href='css/mlp-skin.css' rel='stylesheet'>
	<?php
}
?>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src='//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
<script src='//oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
<![endif]-->
<link href="css/pace.css" rel="stylesheet" />
<script src="js/pace.min.js"></script>

