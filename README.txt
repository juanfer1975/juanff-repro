# JUANFF REPRODUCTOR DE MUSICA
*****************************
# Basado en Music Library & Player (c) 2018 James Moats - jhmoats@willowlakestudio.com - www.thejamesmachine.com
*****************************

Caracteristicas

Responsive Design
HTML5, Flash, archivos lista m3u.
Ideal para reproducir la música en el sitio web o como reproductor local. Para eso necesitas tener instalado un servidor web local.
Configuracion por medio de un SETUP.
Usa PHP, JWPlayer, jQuery, Bootstrap y google seach engine
No Es necesario tener base de datos. Los directorios son organizados como artista/album/canciones
Al usar el icono search puede traer los resultados mas relevantes de la canción desde el google seach engine. Para eso es necesario poseer api y el Search_engine_ID
Licencia Open Source MIT

*****************************
* Intrucciones *
*****************************

1. Descomprimir la fuente

2. Contenidos encontrados:
   - jwplayer6
      - Archivos estandar
      - carpeta mlp (parametrizar el reproductor)
   - jwplayer7
      - Archivos estandares
   - includes/config.php
   - includes/div.php
   - includes/head.php
   - includes/process.php
   - includes/validate.php
   - includes/functions.php
   - css/mlp-skin.css
   - css/style.css
   - vendor
	- composer (archivos composer estandar)
	- mashape (sistema unirest para cargar de servicios REST)
   - playlist.php
   - README.txt
   - setup.php - Se activa al no encontrar el include/config.php
   - file.php
   - index.php

3. Cambie el nombre del directorio por el que deseas

4. Debe tener un servidor local tipo XAMPP, APPSERV y ubique la carpeta donde se pueda ejecutar aplicaciones web

5. Configure el archivo includes/config.php

6. Ejecute en un navegador web

7. Renombre el config.php si desea cargar el setup.php



*******************
* Historia *
*******************

1.0.0 - 12/05/2018
      - Se agrega el buscador del google asociada a cada cancion
      - Se revisa el setup para agregar las caracrteristica del google search 
      - Se agrega el cargador pace	



***********************
* Informacion de licencia *
***********************

- jQuery License:    https://jquery.org/license/
- JWPlayer TOS:      http://www.jwplayer.com/tos/
- Bootstrap License: http://getbootstrap.com/getting-started/#license-faqs
- Google Search Engine API: https://developers.google.com/
- Google API: https://cse.google.com/
- PACE: https://github.hubspot.com/pace/docs/welcome/

***********************

Cargar el README_base.txt para ver mas informacion
