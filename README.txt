*****************************
* Installation Instructions *
*****************************

To install, do the following: 

1. Unzip the source file. 

2. The directory should have the following contents:
   - jwplayer6 folder
      - standard jwplayer6 files
      - mlp folder (contains custom player skin)
   - jwplayer7 folder
      - standard jwplayer7 files
   - config.default.php
   - file.php
   - functions.php
   - index.php
   - mlp-skin.css
   - playlist.php
   - README.txt
   - setup.php
   - style.css

3. Rename the resulting directory if you like. This will be your Music Library & Player directory.

4. Upload the whole directory to the desired location on your web host or local NAS.

5. Set the configuration options. There is a UI setup page that loads as the default page, or you can manually set config options by doing the following:
   - Copy the config.default.php file and rename it to config.php. 
   - Edit file with your preferred settings. 
   - Take special note of the JWPlayer6 vs 7 settings. If using v7, you must sign up for a free account to get a license key.

6. Visit the Music Library & Player directory in a web browser and enjoy.

7. You can rename the config.php file at a later time to revisit the setup UI.

***********************
* System Requirements * 
***********************

- Web accessible directory
- PHP 4/5/7
- jQuery v2 (MaxCDN links included)
- Bootstrap v3 (MaxCDN Links included)
- JWPlayer v6 or 7 (included)
- Music files arranged in this manner: [ROOT]/[ARTIST]/[ALBUM]/[TRACKS]
   - The [ROOT] directory can be located anywhere on the server, it doesn't need to be web accessible


******************
* Config options *
******************

- $debugging - Enable/Disable the ability to add "&debug=log" to the URL, creating verbose log file.
- $root - The relative root where music resides, trailing slash will be removed.
- $url - URL of this Music Library & Player script with port number, if necessary. Only required for m3u playlists. Trailing slash will be removed.
- $group - Group initial directory list by first letter (#, A, B, C...).
- $download - Add download link along side play links.
- $m3u - Add M3U stream link along side play links. Warning: If your web directory is password protected, most devices will not play an m3u.
- $types - Supported audio file types - array of file extensions.
- $delivery - File delivery: Download or Stream. Download is simple and JWPlayer shows progress bar and scrub/shuttle knob. Stream is more compatible with Android and iOS, but JWPlayer shows "Live Stream" and no progress bar.
- $repeat - Player repeat, requires the trailing comma.
- $rand_count - Number of tracks to include in random playlist. If there are fewer tracks available, this amount will be adjusted automatically.
- $jwversion - JWPlayer version. Version 6 can be used without a license key. Version 7 requires you sign up for a free account to get a license key at https://www.jwplayer.com/sign-up/ Choose self-hosted option.
- JWPlayer version specific options:
   - $player - Player default, requires the trailing comma. Don't worry, jwplayer automatically reverts if primary is not possible.
   - $skin - Player skin, requires the trailing comma if using a skin. Leave empty to use default, small player. mlp is a custom skin that doubles the size of the control bar for small screens.
   - $jwplayer_key - Player license key. Only needed for Version 7


*****************************************
* A note about coding standards and use *
*****************************************

The code contained in this script has not been minified. It is written in long form and is well-documented for ease of use and customization. 

Individual tracks are presented with optional download links. Minimal effort has been put into limiting the reach of the player and download links. It is limited, by default, to the six audio file types that are supported by JWPlayer v6. It is advised that you password protect the Music Library & Player directory using htaccess or other method to restrict public access. 

You can optionally create m3u playlists. However, if you password protect the Music Library & Player directory, you may not be able to stream from an m3u playlist. Most players will not attempt to play the files. VLC player in particular will pop up a log in form for each track. To fix this, you would have to exclude file.php from password protection via .htaccess or equivalent. Contents of .htaccess would be the following:

<Files file.php>
    Satisfy Any
    Allow from all
</Files>


*******************
* Release History *
*******************

1.1.3 - 6/2/2018
      - .htaccess file accidentally included in 1.1.2 release.
      - Removed unnecessary global $debug declarations
      - "&" character wasn't being escaped when parsing directory names
      - Random playlists don't work properly when there are fewer subdirectories than playlist count setting
      - setup.php adds a UI to help set initial configuration
      - New "debugging" config option allows you to disable verbose logging from "&debug=log" or "?debug=log" in the URL

1.1.2 - 1/21/2018
      - displayDirectories() was being called when not used in playmode=random
      - Added global variables to keep the same function from being called multiple times
      - Random playlists don't recurse all directories and are very slow
      - Unset() variables to free memory along the way in resource-intensive functions
      - Cleaned up code to avoid PHP notices and warnings

1.1.1 - 11/4/2016
      - Config options accidentally removed from ReadMe.txt
      - Random playlist count is now configurable
      - Adjust random count if fewer tracks are available
      - Random playlist now available from any directory that has files or subdirectories

1.1.0 - 11/3/2016
      - Random Playlist can now be called from any location with more than one subdirectory
      - New function getAllTracks() used to generate random playlist

1.0.9 - 10/22/2016
      - New "File Delivery" option in config.php allows download (old) or stream (new)
      - Refactored separate playlist functions into one
      - Random Playlist icon changed
      - Handle track links with proper bootstrap syntax
      - Playlist missing </ul>
      - &debug=log missing from random playlist link
      - cleanPath() is only needed in GetFiles() method
      - Playlist tracks are not links when downloads enabled
      - Removed gaps between grouped folder headers
      - Removed play and stream buttons from breadcrumbs when play mode is random
      - Added "Random Playlist" text to breadcrumbs when play mode is random
      - Changed shownowplaying() function to handle both <li and <a playlist items

1.0.8 - 10/20/2016
      - New random playlist mode from music player root
      - Active track is not highlighted in playlist
      - When download links are disabled, entire row in playlist becomes link
      - GetList debug log is not nested properly and shows last track repeated
      - Changed config.php to config.default.php to make installing upgrades easier
      - Improved layout of JWPlayer 6 or 7 options in config

1.0.7 - 10/9/2016
      - Switch file download to file streaming (now works on iOS and Android browsers)
      - Option to use JWPlayer version 6 or 7
      - Download link option was ignored (always shown)

1.0.6 - 04/30/2016
      - Replaced use of urlencode() and urldecode() with rawurlencode() and rawurldecode() because the space encoded as + was causing errors

1.0.5 - 02/23/2015
      - Only show player row at the top of the page if something is playing
      - Freeze player row at the top of the page
      - Animated scroll up or down as necessary to show currently playing track

1.0.4 - 02/16/2015
      - Current playing track not highlighted properly in track vs folder playmode

1.0.3 - 12/21/2014
      - Moved debug check up higher in index.php because getWebRoot() was being called before debugging was enabled
      - getWebRoot() was not working correctly.
      - Now playing designation added to playmode=track

1.0.2 - 12/19/2014
      - Gave the mlp skin a facelift
      - Removed extra images from the mlp skin
      - Enabled verbose logging from URL query string (add &debug=log or ?debug=log to the URL query string)

1.0.1 - 12/18/2014 
      - Replaced empty col-md-2 with col-md-offset-2
      - Removed "Now Playing" icon from the playlist
      - Added option to group main list by first letter using Bootstrap collapse element
      - Added optional m3u download (won't work in a password protected directory)
      - Download links are now optional

1.0.0 - 12/16/2014
      - Initial release


***********************
* License Information *
***********************

- jQuery License:    https://jquery.org/license/
- JWPlayer TOS:      http://www.jwplayer.com/tos/
- Bootstrap License: http://getbootstrap.com/getting-started/#license-faqs

Music Library & Player Copyright (c) 2018 James Moats - jhmoats@willowlakestudio.com - www.thejamesmachine.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.