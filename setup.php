<!DOCTYPE html>
<html lang="en">
<head>
<title>Configurar</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="container" class="container-fluid">
	<div class="row playerrow setup-title-bar">
		<h1>Panel de configuración</h1>
	</div>
	<?php
	$alert = null;
	$mode = (isset($_POST['mode'])?$_POST['mode']:null);
	$debugging = (isset($_POST['debugging'])?$_POST['debugging']:'false');
	if ( $debugging == 'true' )
	{
		$debugging_true = ' CHECKED ';
		$debugging_false = '';
	}
	else
	{
		$debugging_true = '';
		$debugging_false = ' CHECKED ';
	}
	$root = (isset($_POST['root'])?$_POST['root']:null);
	$url = '//'.(isset($_POST['url'])?$_POST['url']:$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])));
	$group = (isset($_POST['group'])?$_POST['group']:'false');
	if ( $group == 'true' )
	{
		$group_true = ' CHECKED ';
		$group_false = '';
	}
	else
	{
		$group_true = '';
		$group_false = ' CHECKED ';
	}
	$download = (isset($_POST['download'])?$_POST['download']:'false');
	if ( $download == 'true' )
	{
		$download_true = ' CHECKED ';
		$download_false = '';
	}
	else
	{
		$download_true = '';
		$download_false = ' CHECKED ';
	}
	$m3u = (isset($_POST['m3u'])?$_POST['m3u']:'false');
	if ( $m3u == 'true' )
	{
		$m3u_true = ' CHECKED ';
		$m3u_false = '';
	}
	else
	{
		$m3u_true = '';
		$m3u_false = ' CHECKED ';
	}
	$types = (isset($_POST['types'])?$_POST['types']:null);
	if ( is_null($types) )
	{
		$aac_selected = ' CHECKED ';
		$m4a_selected = ' CHECKED ';
		$f4a_selected = ' CHECKED ';
		$mp3_selected = ' CHECKED ';
		$ogg_selected = ' CHECKED ';
		$oga_selected = ' CHECKED ';
	}
	else
	{
		$aac_selected = null;
		$m4a_selected = null;
		$f4a_selected = null;
		$mp3_selected = null;
		$ogg_selected = null;
		$oga_selected = null;
		if ( is_array($types) )
		{
			foreach ( $types as $type )
			{
				switch($type)
				{
					case 'aac':
						$aac_selected = ' CHECKED ';
						break;
					case 'm4a':
						$m4a_selected = ' CHECKED ';
						break;
					case 'f4a':
						$f4a_selected = ' CHECKED ';
						break;
					case 'mp3':
						$mp3_selected = ' CHECKED ';
						break;
					case 'ogg':
						$ogg_selected = ' CHECKED ';
						break;
					case 'oga':
						$oga_selected = ' CHECKED ';
						break;
				}
			}		
		}
		else
		{
			switch($types)
			{
				case 'aac':
					$aac_selected = ' CHECKED ';
					break;
				case 'm4a':
					$m4a_selected = ' CHECKED ';
					break;
				case 'f4a':
					$f4a_selected = ' CHECKED ';
					break;
				case 'mp3':
					$mp3_selected = ' CHECKED ';
					break;
				case 'ogg':
					$ogg_selected = ' CHECKED ';
					break;
				case 'oga':
					$oga_selected = ' CHECKED ';
					break;
			}
		}
	}
	$delivery = (isset($_POST['delivery'])?$_POST['delivery']:'download');
	if ( $delivery == 'download' )
	{
		$delivery_download = ' CHECKED ';
		$delivery_stream = '';
	}
	else
	{
		$delivery_download = '';
		$delivery_stream = ' CHECKED ';
	}
	$repeat = (isset($_POST['repeat'])?$_POST['repeat']:'false');
	if ( $repeat == 'true' )
	{
		$repeat_true = ' CHECKED ';
		$repeat_false = '';
	}
	else
	{
		$repeat_true = '';
		$repeat_false = ' CHECKED ';
	}
	$rand_count = (isset($_POST['rand_count'])?$_POST['rand_count']:'20');
	$jwversion = (isset($_POST['jwversion'])?$_POST['jwversion']:'6');
	if ( $jwversion == '6' )
	{
		$version_6 = ' CHECKED ';
		$version_7 = '';
	}
	else
	{
		$version_6 = '';
		$version_7 = ' CHECKED ';
	}
	$primary_player = (isset($_POST['primary_player'])?$_POST['primary_player']:'html5');
	if ( $primary_player == 'html5' )
	{
		$primary_player_html = ' CHECKED ';
		$primary_player_flash = '';
	}
	else
	{
		$primary_player_html = '';
		$primary_player_flash = ' CHECKED ';
	}
	$mlp_skin = (isset($_POST['skin'])?$_POST['skin']:'true');
	if ( $mlp_skin == 'true' )
	{
		$mlpskin_true = ' CHECKED ';
		$mlpskin_false = '';
	}
	else
	{
		$mlpskin_true = '';
		$mlpskin_false = ' CHECKED ';
	}
	$jwplayer_key = (isset($_POST['jwplayer_key'])?$_POST['jwplayer_key']:null);
	if ( $mode == 'validate' )
	{
		$mode = 'success';
		if ( is_null($root) )
		{
			$mode = null;
			$alert .= "&bull; El directorio de música es requerido.<br>";
		}
		else if ( !file_exists($root) )
		{
			$mode = null;
			$alert .= "&bull; El directorio de música no existe.<br>";
		}
		if ( is_null($types) )
		{
			$mode = null;
			$alert .= "&bull; Selecciona al menos un tipo de archivo de reproducción.<br>";
		}
		if ( $jwversion == '7' && empty($jwplayer_key) )
		{
			$mode = null;
			$alert .= "&bull; Para el JWPlayer Version 7 es necesario tener clave autorizada.<br>";
		}
	}
	if ( $mode == 'success' )
	{
		$config_text = "<?php\r\n";
		$config_text .= "/* Music Library & Player */\r\n/*  configuador automatico - ".date("Y-m-d H:i:s")." */\r\n";
		$config_text .= '$debugging = '.$debugging.';'."\r\n";
		$config_text .= '$root = "'.$root.'";'."\r\n";
		$config_text .= '$url = "'.$url.'";'."\r\n";
		$config_text .= '$group = '.$group.';'."\r\n";
		$config_text .= '$download = '.$download.';'."\r\n";
		$config_text .= '$m3u = '.$m3u.';'."\r\n";
		foreach ($types as $type)
		{
			$config_text .= '$types[] = "'.$type.'";'."\r\n";
		}
		$config_text .= '$delivery = "'.$delivery.'";'."\r\n";
		$config_text .= '$repeat = "repeat: '.$repeat.',";'."\r\n";
		$config_text .= '$rand_count = '.$rand_count.';'."\r\n";
		$config_text .= '$jwversion = '.$jwversion.';'."\r\n";
		if ( $jwversion == '6' )
		{
			$config_text .= '$player = \'primary: "'.$primary_player.'",\';'."\r\n";
			if ( $mlp_skin == true )
			{
				$config_text .= '$skin = \'skin: "jwplayer6/mlp/mlp.xml",\';'."\r\n";
			}
			else
			{
				$config_text .= '$skin = "";'."\r\n";
			}
			$config_text .= '$jwplayer_key = "";'."\r\n";
		}
		else
		{
			$config_text .= '$player = "";'."\r\n";
			if ( $mlp_skin == true )
			{
				$config_text .= '$skin = \'skin: {name: "MLP"},\';'."\r\n";
			}
			else
			{
				$config_text .= '$skin = "";'."\r\n";
			}
			$config_text .= '$jwplayer_key = "'.$jwplayer_key.'";'."\r\n";
		}
		// api de google 
		$apigoogle = (isset($_POST['apigoogle'])?$_POST['apigoogle']:'');
		$config_text .= '$apigoogle = "'.$apigoogle.'";'."\r\n";
		
		// api google search id
		$Search_engine_ID = (isset($_POST['Search_engine_ID'])?$_POST['Search_engine_ID']:'');
		$config_text .= '$Search_engine_ID = "'.$Search_engine_ID.'";'."\r\n";


		$config_text .= '?>';
		
		if ( file_exists('includes/config.php') )
		{
			rename ('includes/config.php', 'includes/config.backup.'.time().'.php');
			?>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="alert alert-warning">
						config.php existente ha sido renombrabrado.
					</div>
				</div>
			</div>
			<?php
		}
		fopen('includes/config.php', 'w');
		
		if ( !is_writable('includes/config.php') )
		{
			$alert = "No se puede escribir sobre config.php. Permiso denegado";
			unset($mode);
		}
		else
		{
			file_put_contents('includes/config.php', $config_text);
			?>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="alert alert-success">
						Configuración completa. Recargando el sitio...
					</div>
				</div>
			</div>
			<script type="text/javascript">
				window.location = 'index.php';
			</script>
			<?php
			exit();
		}
	}
	if ( empty($mode) )
	{
		if ( !empty($alert) )
		{
			?>
			<br>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="alert alert-danger"><?php echo $alert;?></div>
				</div>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well">
					<?php
					if ( file_exists('includes/config.php') )
					{
						?>
						<p>El siguiente formulario reconfigura el <b>Reproductor de música</b>. El actual <b>config.php</b> será renombrado a <b>config.backup.[tiempo].php</b>.</p>
						<?php
					}
					else
					{
						?>
						<p>El siguiente formulario de ayudará a configura el  <b>Reproductor de música</b>. Esto ocurre porque el archivo <b>config.php</b> no existe (<b><?php echo $_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));?>/includes/</b>).</p>
						<?php
					}
					?>
					<p>Si deseas hacerlo de manera manual, copie el archivo <b>config.base.php</b>, y lo guardas como <b>config.php</b>,editando tus preferencias. El archivo se encuentra comentado.</p>
				</div>
			</div>
		</div>
		<form class="form" method="post" action="setup.php">
			<input type="hidden" name="mode" value="validate">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="well">
						<div class="form-group">
							<label>Ver el depurador</label>
							<div class="radio">
								<label>
									<input name="debugging" type="radio" value="true" <?php echo $debugging_true;?>> SI
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="debugging" type="radio" value="false" <?php echo $debugging_false;?>> No
								</label>
							</div>
							<p class="help-block">Puedes habilitarlo via navegador agregando "&debug=log" o "?debug=log" en la ruta del reproductor.</p>
							<p class="help-block">Crear un archivo log.</p>
							<p class="help-block">Permite detectar algun problema acerca del app.</p>
							<hr>
							<label for="root">Ruta de ubicación de la música</label>
							<input id="root" name="root" type="text" class="form-control" value="<?php echo $root;?>" placeholder="Required" required>
							<p class="help-block">Esta es la ruta fisica o relativa de la música para el reproductor.</p>
							<p class="help-block">Ejemplo: <b>../../../musica</b></p>
							<p class="help-block">c:\\musica\ o <b>datos/musica/</b></p>
							<hr>
							<label for="url">Ruta del sitio del app</label>
							<input id="url" name="site_url" type="text" class="form-control" value="<?php echo $url;?>" placeholder="Optional - Only required for m3u playlists">
							<p class="help-block">Si es necesario incluye el puerto.</p>
							<p class="help-block">Ejemplo: <b>//juanff.com/juanff-repro/</b></p>
							<p class="help-block">Ejemplo: <b>//juanff:8080/music</b></p>
							<hr>
							<label>Agrupar el directorio por letra</label>
							<div class="radio">
								<label>
									<input name="group" type="radio" value="true" <?php echo $group_true;?>> Si
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="group" type="radio" value="false" <?php echo $group_false;?>> No
								</label>
							</div>
							<p class="help-block">Habilita esta opción si quieres agrupar tu música por letras (#, A, B, C, etc.)</p>
							<hr>
							<label>Habilitar el enlace para descargar</label>
							<div class="radio">
								<label>
									<input name="download" type="radio" value="true" <?php echo $download_true;?>> Si
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="download" type="radio" value="false" <?php echo $download_false;?>> No
								</label>
							</div>
							<p class="help-block">Permite habilitar el ícono de descargar la canción.</p>
							<hr>
							<label>Habilitar enlace para listas tipo M3U</label>
							<div class="radio">
								<label>
									<input name="m3u" type="radio" value="true" <?php echo $m3u_true;?>> Si
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="m3u" type="radio" value="false" <?php echo $m3u_false;?>> No
								</label>
							</div>
							<p class="help-block">Permite incluiir una lista de reproducción tipo m3u en el app.</p>
							<p class="help-block"><b>Note:</b> Esto funciona si no tienes protección en tu carpeta de música.</p>
							<hr>
							<label>Tipos de audios soportados</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="aac" <?php echo $aac_selected;?>> aac
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="m4a" <?php echo $m4a_selected;?>> m4a
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="f4a" <?php echo $f4a_selected;?>> f4a
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="mp3" <?php echo $mp3_selected;?>> mp3
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="ogg" <?php echo $ogg_selected;?>> ogg
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="oga" <?php echo $oga_selected;?>> oga
								</label>
							</div>
							<p class="help-block">Selecciona los tipos de archivos a reproducir.</p>
							<hr>
							<label>File Delivery Method</label>
							<div class="radio">
								<label>
									<input type="radio" name="delivery" value="download" <?php echo $delivery_download;?>> Download
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="delivery" value="stream" <?php echo $delivery_stream;?>> Stream
								</label>
							</div>
							<p class="help-block">Download permite mostrar la barra de progeso.</p>
							<p class="help-block">Stream muestra "Live Stream" y es más compatible con android / IOS.</p>
							<hr>
							<label>Repetir reproductor</label>
							<div class="radio">
								<label>
									<input type="radio" name="repeat" value="true" <?php echo $repeat_true;?>> Si
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="repeat" value="false" <?php echo $repeat_false;?>> No
								</label>
							</div>
							<p class="help-block">Permite repetir automáticamente la lista de música al finalizar.</p>
							<hr>
							<label for="rand_count">Número de cancion aleatorias.</label>
							<input id="rand_count" name="rand_count" type="text" class="form-control" value="<?php echo $rand_count;?>">
							<p class="help-block">Cantidad de canciones a reproduccir de manera aleatoria.</p>
							<p class="help-block">Si la cantidad es muy poca, el app se ajustará de manera automáticamente.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="well">
						<div class="form-group">
							<h3>Configuraciones del JWPlayer</h3>
							<hr>
							<label>Version JWPlayer </label>
							<div class="radio">
								<label>
									<input type="radio" name="jwversion" value="6" <?php echo $version_6;?>> Version 6
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="jwversion" value="7" <?php echo $version_7;?>> Version 7
								</label>
							</div>
							<p class="help-block">JWPlayer Version 6 no requiere clave de autorización.</p>
							<p class="help-block">JWPlayer Version 7 necesita clave de autorización. Es requirido cuando se usa safari o IOS.</p>
							<p class="help-block"><b>Nota:</b> Ninguna versión en la nube del JWPlayer es soportador.</p>
							<hr>
							<label>Reproductor Principal</label>
							<div class="radio">
								<label>
									<input type="radio" name="primary-player" value="html5" <?php echo $primary_player_html;?>> HTML5
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="primary-player" value="flash" <?php echo $primary_player_flash;?>> Flash
								</label>
							</div>
							<p class="help-block">Si no esta disponible el primario, el app cargará la segunda opción.</p>
							<p class="help-block">JWPlayer 7 ignora esta configuración.</p>
							<hr>
							<label>Gráfica MLP Skin</label>
							<div class="radio">
								<label>
									<input type="radio" name="skin" value="true" <?php echo $mlpskin_true;?>> Si
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="skin" value="false" <?php echo $mlpskin_false;?>> No
								</label>
							</div>
							<p class="help-block">MLP skin permite crear una interfaz más grande cuando se usan dispositivos móviles.</p>
							<hr>
							<label for="jwplayer_key">Clave JWPlayer</label>
							<input type="text" id="jwplayer_key" name="jwplayer_key" class="form-control" value="<?php echo $jwplayer_key;?>">
							<p class="help-block">Si la posees, digitala. En la versión 6 no es necesaria.</p>
							
							<hr>
							<label for="apigoogle">Google API</label>
							<input type="text" id="apigoogle" name="apigoogle" class="form-control" value="<?php echo $apigoogle;?>">
							<p class="help-block">Si la posees, digitala. Es necesaria para acceder al buscador personalizado de google. <a href="https://developers.google.com/" target="_blank">https://developers.google.com/</a>.<br><strong>Recuerda que debes una poseer una cuenta de gmail para acceder a estas opciones.</strong></p>
							<hr>
							<label for="Search_engine_ID">Google Search_engine_ID</label>
							<input type="text" id="Search_engine_ID" name="Search_engine_ID" class="form-control" value="<?php echo $Search_engine_ID;?>">
							<p class="help-block">Si la posees, digitala. Es necesaria para ejecuta el buscador personalizado de google. <a href="https://cse.google.com/" target="_blank">https://cse.google.com/</a>.<br><strong>Recuerda que debes una poseer una cuenta de gmail para acceder a estas opciones</strong>.</p>
														

							<hr>
							<input type="submit" name="submit" value="Guardar Configuración" class="btn btn-default">
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
	?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="//code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>