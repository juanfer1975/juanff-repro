<?php
// carga del motor js 
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='//code.jquery.com/jquery-3.1.1.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<?php
if ( $playMode == 'track' && !empty($track) )
{
	$playlist = getTrackPlaylist($dir,$track);
}
elseif ( $playMode == 'folder' && !empty($dir) )
{
	// Deliver a multiple track playlist to the player
	$playlist = getFolderPlaylist($dir);
}
elseif ( $playMode == 'random' )
{
	// Get the playlist returned from getRandomPlaylist
	$playlist = $random['playlist'];
}
// Only bother with the player if there is something to play
if ( !empty($playMode) )
{
	?>
	<script type='text/javascript'>
		// Set the width of the player to match the list
		var playerWidth = getPlayerWidth();
		// Instantiate the player
		jwplayer('myElement').setup({
			height: 60,
			width: playerWidth,
			autostart: "viewable",
			controls: true,
			displaytitle: true,
			<?php echo $skin;?>
			<?php
			if ( isset($primary) )
			{
				echo $primary;
			}
			?>
			<?php echo $repeat;?>
			<?php echo $playlist;?>
		});
		// Force the player width once it gets going
		// Version 6
		if ( <?php echo $jwversion;?>==6 )
		{
			jwplayer().onPlay(function(){
				setPlayerWidth();
			});
		}
		else
		{
			jwplayer().on('play',function(){
				setPlayerWidth();
			});
		}
		
		if ( <?php echo $jwversion;?>==6 )
		{
			jwplayer().onPlaylistItem(function(e){
				showNowPlaying(e);
			});
		}
		else
		{
			jwplayer().on('playlistItem',function(e){
				showNowPlaying(e);
			});
		}
		
		// Fill the width of the container with the player
		setPlayerWidth();
		// Get the width of the folder/track list
		function getPlayerWidth()
		{
			var playerWidth = $('.list-group').width();
			// Set a minimum width for the player
			if ( playerWidth < 430 )
			{
				playerWidth = 430;
			}
			return playerWidth;
		}
		function setPlayerWidth()
		{
			var playerWidth = getPlayerWidth();
			jwplayer().resize(playerWidth,40);
			scrollToTrack(jwplayer().getPlaylistIndex());
		}
		function showNowPlaying(e) 
		{
			// Show the play button icon on the current track
			var text = $('#'+e.index).html();
			// Loop through all <li> elements and remove the blue background
			$('.list-group-item').each(function(){
				// Remove the blue background from the last played item
				if ( $(this).hasClass('active') )
				{
					var thistext = $(this).html();
					$(this).removeClass('active');
				}
			});
			<?php
			// Add the blue background to the currently playing item
			if ( $playMode == 'track' )
			{
				?>
				var trackno = <?php echo $trackno;?>;
				$('#'+trackno).addClass('active');
				<?php
			}
			elseif ( $playMode == 'folder' || $playMode == 'random' )
			{
				?>
				var trackno = e.index;
				$('#'+e.index).addClass('active');
				<?php
			}
			?>
			scrollToTrack(trackno);
		}
		// Get position of the player, current playing track, and window
		function scrollToTrack(trackno)
		{
			var trackRow = document.getElementById(trackno);
			var trackPos = trackRow.getBoundingClientRect();
			var playerHeight = $('#playerrow').height();
			var windowHeight = $(window).height();
			// Scroll up to show currently playing track
			if (trackPos.top<playerHeight)
			{
				var scrollBy = playerHeight-trackPos.top+10;
				$('html, body').animate({scrollTop: '-='+scrollBy},500);
			}
			// Scroll down to show currently playing track
			else if (trackPos.bottom>windowHeight)
			{
				var scrollBy = trackPos.bottom-windowHeight;
				$('html, body').animate({scrollTop: '+='+scrollBy},500);
			}
		}
	</script>
	<?php
}
?>

<script type="text/javascript">
	function buscar(data) {
		var param=$("#"+data).attr("data-track");
		parametros={
			"param" : param
		};
		$("#myModal").modal();
		$("#data-txt").html(param);
		$("#data-load").html("Buscando...");
        $("#mensaje").html("");

        $.ajax({
        data : parametros,
        url: "googlesearch.php",
        type: "post",
        beforesend : function () {
            $("#mensaje").html("<span class='btn btn-warning'>Cargando información...</span>");
			$("#data-load").html("Buscando...");

        },
        success : function (response) {
        	$("#data-load").html("");
            data=JSON.parse((response));
            txt="<ul class='list-group'>";
            for (x in data) {
				datatxt="";
				if (data[x].title!="") datatxt+="<h4>"+data[x].title+"</h4>";
				if (data[x].formattedUrl!="") datatxt+="<a href='"+data[x].formattedUrl+"' target='_blank'>"+data[x].formattedUrl+"</a>";
				if (data[x].snippet!="") datatxt+="<p>"+data[x].snippet+"</p>";



            txt += "<li class='list-group-item track'>"+datatxt+ "</li>";
        	}
        	txt+="</ul>";
            $("#mensaje").html(txt);
        },
        error : function (jqXHR,textStatus,errorThrown) {
          $("#mensaje").html("<span class='btn btn-danger'>Se ha presentado un error: "+errorThrown+" : "+textStatus+"</span>");
			$("#data-load").html("Error...");

        } 

        });


	}

</script>