<?php

require_once 'youtube.class.php';
/*
 * Name: Simple Class Info YouTube
 * Description: Get Information of video YouTube
 * Development: Chuecko
 * Site: http://www.zarpele.com.ar
 * License: GNU GENERAL PUBLIC LICENSE (http://www.gnu.org/licenses/gpl.html)
 * Version: 1.0
 */
/*
 * Tambien le pueden pasar como parametro solo el ID de youtube
 */
$urlvideo =$_REQUEST['urlvideo'];

$youtube = new youtubeClass();
$youtube->url($urlvideo);

echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
echo '<body>';

echo '<b>Link:</b> '.$youtube->getUrl().'<br/>';
echo '<b>Titulo:</b> '.$youtube->getTitle().'<br/>';
echo '<b>Publicado:</b> '.$youtube->getPublished().'<br/>';
echo '<b>Descripcion:</b> '.$youtube->getDescription().'<br/>';
echo '<b>Meta Tags:</b> '.$youtube->getMetaTags().'<br/>';
echo '<b>Imagen:</b> '.$youtube->getUrlImage('default').'<br/>';
echo $youtube->getEmbeb(640, 390, 1);
echo '</body></html>';

?>