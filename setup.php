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
		<h1>Iniciales</h1>
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
			$alert .= "&bull; Music Root Directory is required.<br>";
		}
		else if ( !file_exists($root) )
		{
			$mode = null;
			$alert .= "&bull; Music Root Directory doesn't exist.<br>";
		}
		if ( is_null($types) )
		{
			$mode = null;
			$alert .= "&bull; You must select at least one Supported Audio File Type.<br>";
		}
		if ( $jwversion == '7' && empty($jwplayer_key) )
		{
			$mode = null;
			$alert .= "&bull; JW Player License Key is required for JWPlayer Version 7.<br>";
		}
	}
	if ( $mode == 'success' )
	{
		$config_text = "<?php\r\n";
		$config_text .= "/* Music Library & Player */\r\n/* Automatically generated config - ".date("Y-m-d H:i:s")." */\r\n";
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
		$config_text .= '?>';
		
		if ( file_exists('includes/config.php') )
		{
			rename ('includes/config.php', 'includes/config.backup.'.time().'.php');
			?>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="alert alert-warning">
						Existing config.php file has been renamed.
					</div>
				</div>
			</div>
			<?php
		}
		fopen('includes/config.php', 'w');
		
		if ( !is_writable('includes/config.php') )
		{
			$alert = "Setup can't write the config file. Permission denied.";
			unset($mode);
		}
		else
		{
			file_put_contents('includes/config.php', $config_text);
			?>
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<div class="alert alert-success">
						Configuration is complete. Reloading the site...
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
					<div class="alert alert-danger"><?=$alert;?></div>
				</div>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well">
					<?php
					if ( file_exists('config.php') )
					{
						?>
						<p>The form below will help reconfigure your <b>Music Libary & Player</b> installation. Your existing <b>config.php</b> file will be renamed to <b>config.backup.[timestamp].php</b> when you submit this form.</p>
						<?php
					}
					else
					{
						?>
						<p>The form below will help set up your new <b>Music Library & Player</b> installation. You are most likely seeing this because a <b>config.php</b> file doesn't exist in this directory (<b><?=$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));?>/</b>).</p>
						<?php
					}
					?>
					<p>If you prefer to manually complete the setup, simply copy the included <b>config.default.php</b> file, save it as <b>config.php</b>, and then edit it with your preferred text editor. The file is well commented for your reference.</p>
				</div>
			</div>
		</div>
		<form class="form" method="post" action="setup.php">
			<input type="hidden" name="mode" value="validate">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="well">
						<div class="form-group">
							<label>Allow Debugging</label>
							<div class="radio">
								<label>
									<input name="debugging" type="radio" value="true" <?=$debugging_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="debugging" type="radio" value="false" <?=$debugging_false;?>> No
								</label>
							</div>
							<p class="help-block">Enable this to allow "&debug=log" or "?debug=log" in the URL query string</p>
							<p class="help-block">This creates a verbose log file and slows down performance.</p>
							<p class="help-block">Leave disabled unless actively troubleshooting a problem.</p>
							<hr>
							<label for="root">Music Root Directory</label>
							<input id="root" name="root" type="text" class="form-control" value="<?=$root;?>" placeholder="Required" required>
							<p class="help-block">This is the path to your music files, relative to this directory.</p>
							<p class="help-block">If your music directory is below web root, this may look something like <b>../../../backup/music</b></p>
							<p class="help-block">Otherwise, it may look something like <b>assets/music</b></p>
							<hr>
							<label for="url">This Site URL</label>
							<input id="url" name="site_url" type="text" class="form-control" value="<?=$url;?>" placeholder="Optional - Only required for m3u playlists">
							<p class="help-block">The URL of this installation of Music Library & Player including the port number, if necessary.</p>
							<p class="help-block">Example: <b>//thejamesmachine.com</b></p>
							<p class="help-block">Example: <b>//mynas.dyndns.org:8080/music</b></p>
							<hr>
							<label>Group Root Directory by Letter</label>
							<div class="radio">
								<label>
									<input name="group" type="radio" value="true" <?=$group_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="group" type="radio" value="false" <?=$group_false;?>> No
								</label>
							</div>
							<p class="help-block">Substantial music collections can scroll for days.</p>
							<p class="help-block">Enabling this option creates collapsed groups by first letter (#, A, B, C, etc.)</p>
							<hr>
							<label>Show Download Links</label>
							<div class="radio">
								<label>
									<input name="download" type="radio" value="true" <?=$download_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="download" type="radio" value="false" <?=$download_false;?>> No
								</label>
							</div>
							<p class="help-block">Enabling this option includes a download icon/link next to each music file in the list.</p>
							<hr>
							<label>Show M3U Playlist Links</label>
							<div class="radio">
								<label>
									<input name="m3u" type="radio" value="true" <?=$m3u_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="m3u" type="radio" value="false" <?=$m3u_false;?>> No
								</label>
							</div>
							<p class="help-block">Enabling this option includes an m3u playlist icon/link on the page when music files are in the list.</p>
							<p class="help-block"><b>Note:</b> If you have password protected your music directory, m3u playlists will not work in most external players.</p>
							<hr>
							<label>Supported Audio File Types</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="aac" <?=$aac_selected;?>> aac
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="m4a" <?=$m4a_selected;?>> m4a
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="f4a" <?=$f4a_selected;?>> f4a
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="mp3" <?=$mp3_selected;?>> mp3
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="ogg" <?=$ogg_selected;?>> ogg
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="types[]" value="oga" <?=$oga_selected;?>> oga
								</label>
							</div>
							<p class="help-block">Select the file types you want displayed in the list.</p>
							<hr>
							<label>File Delivery Method</label>
							<div class="radio">
								<label>
									<input type="radio" name="delivery" value="download" <?=$delivery_download;?>> Download
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="delivery" value="stream" <?=$delivery_stream;?>> Stream
								</label>
							</div>
							<p class="help-block">Download is simple and JWPlayer shows progress bar and scrub/shuttle knob.</p>
							<p class="help-block">Stream is more compatible with Android and iOS, but JWPlayer shows "Live Stream" and no progress bar.</p>
							<hr>
							<label>Player Repeat</label>
							<div class="radio">
								<label>
									<input type="radio" name="repeat" value="true" <?=$repeat_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="repeat" value="false" <?=$repeat_false;?>> No
								</label>
							</div>
							<p class="help-block">Enabling this option repeats the playlist automatically when it finishes.</p>
							<hr>
							<label for="rand_count">Random Playlist Track Count</label>
							<input id="rand_count" name="rand_count" type="text" class="form-control" value="<?=$rand_count;?>">
							<p class="help-block">Number of tracks to include in random playlist.</p>
							<p class="help-block">If there are fewer tracks available in the selected directory, this amount will be adjusted automatically.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="well">
						<div class="form-group">
							<h3>JWPlayer Settings</h3>
							<hr>
							<label>JWPlayer Version</label>
							<div class="radio">
								<label>
									<input type="radio" name="jwversion" value="6" <?=$version_6;?>> Version 6
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="jwversion" value="7" <?=$version_7;?>> Version 7
								</label>
							</div>
							<p class="help-block">JWPlayer Version 6 does not require a registered key and is better for this application.</p>
							<p class="help-block">JWPlayer Version 7 requires a key and doesn't have a Previous button on the player. This player version is required for certain iOS/Safari versions to work properly.</p>
							<p class="help-block"><b>Note:</b> Newer cloud hosted JWPlayer versions aren't supported.</p>
							<hr>
							<label>Primary Player</label>
							<div class="radio">
								<label>
									<input type="radio" name="primary-player" value="html5" <?=$primary_player_html;?>> HTML5
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="primary-player" value="flash" <?=$primary_player_flash;?>> Flash
								</label>
							</div>
							<p class="help-block">If primary isn't available, JWPlayer automatically switches back to the secondary.</p>
							<p class="help-block">This setting is ignored if using JWPlayer 7.</p>
							<hr>
							<label>MLP Skin</label>
							<div class="radio">
								<label>
									<input type="radio" name="skin" value="true" <?=$mlpskin_true;?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="skin" value="false" <?=$mlpskin_false;?>> No
								</label>
							</div>
							<p class="help-block">MLP skin is a custom skin created for Music Library & Player that just doubles the size of controls, to make it easier to navigate on small screen devices.</p>
							<hr>
							<label for="jwplayer_key">JWPlayer License Key</label>
							<input type="text" id="jwplayer_key" name="jwplayer_key" class="form-control" value="<?=$jwplayer_key;?>">
							<p class="help-block">If you have a JWPlayer key, enter it here. This isn't required for JWPlayer Version 6.</p>
							<hr>
							<input type="submit" name="submit" value="Save Config" class="btn btn-default">
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