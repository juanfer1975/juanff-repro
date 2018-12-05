<?php
if ( !file_exists('includes/config.php') )
{
	header('location: setup.php');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include("includes/head.php");
?>
</head>
<body>
<?php 
include("includes/validate.php");
include("includes/div.php");
include("includes/process.php");?>
</body>
</html>