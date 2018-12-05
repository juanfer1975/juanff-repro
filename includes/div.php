<?php 
/*
capa que ejecuta el reproductor
*/
?>
<?php
// Process the current directory from query string
$dir = (isset($_GET['dir'])?rawurldecode($_GET['dir']):null);
if ( empty($dir) )
{
	$dir = $root;
}
// Remove the trailing slash if necessary
$dir = getDirectory($dir);
?>
<div id='container' class='<?php echo $container_class;?>'>
	<?php
	// Remove black player bar at top of the page if nothing to play
	if ( !empty($playMode) )
	{
		?>
		<div id='playerrow' class='row playerrow navbar-fixed-top'>
			<div id='playerCell' class='col-md-8 col-md-offset-2'>
				<div id='myElement'></div> <!--This is the player container-->
			</div>
		</div>
		<?php
	}
	?>
	<div class='row'>
		<br>
		<div class='col-md-8 col-md-offset-2'>
			<?php
			echo getRandomPlaylistLink($dir);
			echo getBreadcrumbs($dir);
			?>
		</div>
	</div>
	<?php
	if ( $playMode!='random')
	{
		$directories = displayDirectories($dir);
		if ( !empty($directories) )
		{
			?>
			<div class='row'>
				<div class='col-md-8 col-md-offset-2' id='main'>
					<br>
					<?php echo $directories;?>
				</div>
			</div>
			<?php
		}
	}
	else
	{
		echo '<br>';
	}
	if ( ($playMode == 'track' || $playMode == 'folder' || empty($playMode) ) && !empty($dir) )
	{
		$tracks = getTracksPlaylist($dir);
	}
	elseif ( $playMode == 'random' && !empty($dir) )
	{
		$random = getRandomPlaylist($dir);
		$tracks = $random['tracks'];
	}
	if ( !empty($tracks) )
	{
		?>
		<div class='row'>
			<div class='col-md-8 col-md-offset-2'>
				<?php echo $tracks;?>
			</div>
		</div>
		<?php
	}
	else
	{
		echo '<br>';
	}
	?>
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span> Resultados para <span id="data-txt"></span></h4>
        </div>
        <div class="modal-body" id="mensaje">

        </div>
        <div class="modal-footer">
        	<span id="data-load"></span>
          <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
        </div>
      </div>
    </div>
  </div> 
</div>