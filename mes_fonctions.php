<?php
  
  $GLOBALS['quota_cache'] = 25;
  /*define('_DUREE_CACHE_DEFAUT', 24*3600); */
  
  function info($urlvideo) {
  
    if (substr_count($urlvideo, 'youtube') && !substr_count($urlvideo, 'www.youtube.com/p/')) {
    
      require_once 'youtube.class.php';
      $youtube = new youtubeClass();
      $youtube->url(obtenerLink($urlvideo));
      $info = '<p><strong>Publicado:</strong> '.$youtube->getPublished().'</p>'
             .'<p><strong>MetaTags :</strong> '.$youtube->getMetaTags().'</p>'
             .'<p>'.$youtube->getDescription().'</p>';
      return $info;
    }
    return '';
  }

  
  function titulo($urlvideo) {
  
    if (substr_count($urlvideo, 'youtube') && !substr_count($urlvideo, 'www.youtube.com/p/')) {
    
      require_once 'youtube.class.php';
      $youtube = new youtubeClass();
      $youtube->url(obtenerLink($urlvideo));
      return $youtube->getTitle();
    }
    return $url_watch;
  }

  function descripcion($urlvideo) {
  
    if (substr_count($urlvideo, 'youtube') && !substr_count($urlvideo, 'www.youtube.com/p/')) {
    
      require_once 'youtube.class.php';
      $youtube = new youtubeClass();
      $youtube->url(obtenerLink($urlvideo));
      return $youtube->getDescription();
    }
    return $url_watch;
  }

  function urlImagen($urlvideo, $opcion='grande') {
  
	if (substr_count($urlvideo, 'youtu.be')) {
		$urlvideo = str_replace("http://youtu.be/","http://www.youtube.com/watch?v=",$urlvideo);
	} 
    if (substr_count($urlvideo, 'youtube') && !substr_count($urlvideo, 'www.youtube.com/p/')) {
      require_once 'youtube.class.php';
      $youtube = new youtubeClass();
      $youtube->url(obtenerLink($urlvideo));
      return $youtube->getUrlImage($opcion);
    }
    return "No se encuentra imagen default";
  }

  function embebido($urlvideo, $width='640', $height='390', $autoplay=1) {

	if (substr_count($urlvideo, 'youtu.be')) {
		$urlvideo = str_replace("http://youtu.be/","http://www.youtube.com/watch?v=",$urlvideo);
	} 
  
    /* Videos de Youtube, excluyo playlists y utilizo clase para generar embebido */
    if (substr_count($urlvideo, 'youtube') && !substr_count($urlvideo, 'www.youtube.com/p/')) {
      require_once 'youtube.class.php';
      $youtube = new youtubeClass();
      $youtube->url(obtenerLink($urlvideo));
      return $youtube->getEmbeb($width, $height, $autoplay);

    } 
	else if (substr_count($urlvideo, 'fusiontables')) {
    return '<iframe src="'.$urlvideo.'" frameborder="no" width="'.$width.'" height="'.$height.'"></iframe>';
  } 
	else if (substr_count($urlvideo, 'cdn.livestream.com')) {
    return '<iframe src="'.$urlvideo.'&autoplay=true" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
	} else if (substr_count($urlvideo, 'bambuser')) {
    return '<iframe src="'.$urlvideo.'" frameborder="no" width="'.$width.'" height="'.$height.'"></iframe>';
	} else if (substr_count($urlvideo, 'www.google.com/maps/embed')) {
    return '<iframe src="'.$urlvideo.'" frameborder="no" width="'.$width.'" height="'.$height.'"></iframe>';
  } else if (substr_count($urlvideo, 'dailymotion')) {
	  if($autoplay==1) {
		$urlvideo = str_replace("autoPlay=0","autoPlay=1",$urlvideo);
        return '<iframe src="'.$urlvideo.'&autoplay=1" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
	  }
	  else {
        return '<iframe src="'.$urlvideo.'&autoplay=0" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
	  }
    } else if (substr_count($urlvideo, 'player.vimeo.com')) {
      if($autoplay==1) {
      return '<iframe src="'.$urlvideo.'?autoplay=1" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
      }
      else {
      return '<iframe src="'.$urlvideo.'?autoplay=0" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';
      }
    } else if (substr_count($urlvideo, 'overstream')) {
      return '<iframe src="'.$urlvideo.'" frameborder="0" width="'.$width.'" height="'.$height.'"></iframe>';

    } else if (substr_count($urlvideo, 'blip.tv')) {
      return '<iframe src="'.$urlvideo.'" frameborder="0" width="'.$width.'" height="'.$height.' allowfullscreen"></iframe>';
	  
    } else if (substr_count($urlvideo, 'ustream.tv')) {
				$urlvideo = str_replace("www.ustream.tv/channel","www.ustream.tv/embed",$urlvideo);
      return '<iframe src="'.$urlvideo.'" frameborder="0" width="'.$width.'" height="'.$height.' style="border: 0px none transparent;"></iframe>';

    } else if (substr_count($urlvideo, 'player.theplatform.com')) {
      return '<iframe src="'.$urlvideo.'" frameborder="0" width="'.$width.'" height="'.$height.' seamless="seamless" allowfullscreen>Tu navegados no soporta iframes.</iframe>';

    /* Reproductor de audio Fuente: http://ticsidro.wordpress.com/2007/05/20/reproductor-audio-player */
    } else if (substr_count($urlvideo, 'mp3')) {
      if($autoplay==1) {
        return '<object type="application/x-shockwave-flash" data="http://www.tvpts.tv/squelettes/audio-player/player.swf?m=1305201982g" width="'.$width.'" height="'.$height.'" id="audioplayer1">
                <param name="movie" value="http://www.tvpts.tv/squelettes/audio-player/player.swf?m=1305201982g" />
                <param name="FlashVars" value="&amp;bg=0xf8f8f8&amp;leftbg=0xeeeeee&amp;lefticon=0x666666&amp;rightbg=0xcccccc&amp;rightbghover=0x999999&amp;righticon=0x666666&amp;righticonhover=0xffffff&amp;text=0x666666&amp;slider=0x666666&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0x9FFFB8&amp;soundFile='.$urlvideo.'&amp;autostart=yes&amp;titles=Audio" />
          <param name="quality" value="high" /><param name="menu" value="false" /><param name="bgcolor" value="#FFFFFF" /><param name="wmode" value="opaque" />
                </object><br><br><a href="'.$urlvideo.'">Link para descargar audio</a><br><br>';
      }
      else {
        return '<object type="application/x-shockwave-flash" data="http://www.tvpts.tv/squelettes/audio-player/player.swf?m=1305201982g" width="'.$width.'" height="'.$height.'" id="audioplayer1">
                <param name="movie" value="http://www.tvpts.tv/squelettes/audio-player/player.swf?m=1305201982g" />
                <param name="FlashVars" value="&amp;bg=0xf8f8f8&amp;leftbg=0xeeeeee&amp;lefticon=0x666666&amp;rightbg=0xcccccc&amp;rightbghover=0x999999&amp;righticon=0x666666&amp;righticonhover=0xffffff&amp;text=0x666666&amp;slider=0x666666&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0x9FFFB8&amp;soundFile='.$urlvideo.'&amp;autostart=no&amp;titles=Audio" />
          <param name="quality" value="high" /><param name="menu" value="false" /><param name="bgcolor" value="#FFFFFF" /><param name="wmode" value="opaque" />
                </object><br><br><a href="'.$urlvideo.'">Link para descargar audio</a><br><br>';
      }
      /* Para megavideos y playlists de youtube */
    } else if (substr_count($urlvideo, 'megavideo.com') || 
               substr_count($urlvideo, 'youtube') && substr_count($urlvideo, 'www.youtube.com/p/')) {

      return '<object wid th="'.$width.'" height="'.$height.'">
              <param name="movie" value="'.$urlvideo.'?autoplay=1"></param>
              <param name="allowFullScreen" value="true"></param>
              <embed src="'.$urlvideo.'?autoplay=1" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" allowfullscreen="true"></embed>
              </object>';
    
	// Facebook
    } else if (substr_count($urlvideo, 'facebook')) {	  
	
      $urlvideo = obtenerLink($urlvideo);
	
	  return '<iframe src="'.$urlvideo.'" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';	  
	
	} else {  /* Caso contrario uso el player propio */
    
      return '<object width="'.$width.'" height="'.$height.'" id="player1" name="<param name="movie" value="/player/player.swf">
      <param name="movie" value="'.$urlvideo.'"></param>
      <param name="allowFullScreen" value="true">
      <param name="allowscriptaccess" value="always">
      <param name="flashvars" value="file='.$urlvideo.'&autostart=true">
      <embed id="player1" name="player1" src="/player/player.swf" 
      width="'.$width.'" height="'.$height.'" allowscriptaccess="always" allowfullscreen="true"
      flashvars="file='.$urlvideo.'&autostart=true"/></object>';
    }
  }

  
  function limpiarURL($url) {
  
    if (substr_count($url, 'youtube')) {
      $url = parametre_url($url,'fs','');
      $url = parametre_url($url,'hl','');
      $url = parametre_url($url,'rel','');
      $url = parametre_url($url,'autoplay','');
      $url = parametre_url($url,'color1','');
      $url = parametre_url($url,'color2','');
      $url = parametre_url($url,'version','');
      $url = parametre_url($url,'feature','');
    }
	
	if (substr_count($url, 'facebook')) {
      $url = parametre_url($url,'set','');
      $url = parametre_url($url,'type','');
      $url = parametre_url($url,'theater','');     
    }
	
    return $url;
  }
  
  
  function obtenerLink($url) {
  
    $url = limpiarURL($url);
    if (substr_count($url, 'youtube.com/v')) 
      return 'http://www.youtube.com/watch?v='.substr($url,25,15);
    else if (substr_count($url, 'facebook.com'))
	  return 'https://www.facebook.com/video/embed/?video_id='.substr($url,37,55);
	else
      return $url;
  }

  
  function fuente($urlvideo) {

    if (substr_count($urlvideo, 'youtube')) {
      return 'YouTube';
    } else if (substr_count($urlvideo, 'livestream')) {
      return 'LiveStream';
    } else if (substr_count($urlvideo, 'dailymotion')) {
      return 'Dailymotion';
    } else if (substr_count($urlvideo, 'player.vimeo.com')) {
      return 'Vimeo';
    } else if (substr_count($urlvideo, 'overstream')) {
      return 'Overtream';
    } else if (substr_count($urlvideo, 'megavideo.com')) {
      return 'Megavideo';
	} else if (substr_count($urlvideo, 'facebook.com')) {
      return 'Facebook';
    }
    return '';
  }
 

  function climat() {
    
    require_once 'clima.php';
	  $aClima = clima();
	  //Temperatura y descripcion de estado
	  $temp = $aClima[0];
	  $clima = $aClima[1];
	  $img = $aClima[2];
	  $climaR = $img . "<p><strong>" . $temp . "</strong><br><span>" . $clima ."</span></p>";
	  return $climaR;
  }
  
  function clima_movil() {
    
    require_once 'clima_movil.php';
	  $aClima = clima();
	  //Temperatura y descripcion de estado
	  $temp = $aClima[0];
	  $clima = $aClima[1];
	  $img = $aClima[2];
	  $climaR = "<strong>" . $temp . "</strong> <span class='Tx'>". $clima. " </span> <span class='Graph'>" . $img ."  </span>";
	  return $climaR;
  }

  function fecha_sin_hora() {
  
    require_once 'fecha.php';
    $fecha = '<p><strong>'. fecha_hoy() .'</strong></p>';	
    return $fecha;
  }  
  
  function fecha_hora() {
  
    require_once 'fecha.php';
    $fecha = '<p><strong>'. fecha_hoy() .'</strong><br>'. date("H:i") . ' hs.</p>';	
    return $fecha;
  }  
  
  function fecha() {
  
    require_once 'fecha.php';
    $fecha = '<p><strong>'. fecha_hoy() .'</strong><br>actualizado '. date("H:i") . ' hs.</p>';	
    return $fecha;
  }  
  
  function fecha_mx() {
  
    require_once 'fecha.php';
    $fechaHora = time();
    $horas = -2;
    $fechaHora += ($horas * 60 * 60);
    $fechaHora = date("H:i", $fechaHora );
    $fecha = '<p><strong>'. fecha_hoy() .'</strong><br>actualizado '. $fechaHora . ' hs.</p>';	
    return $fecha;
  }  
  
  function fecha_movil() {
  
    require_once 'fecha.php';
    $fecha = '<p><strong>'. fecha_breve() .'</strong> - actualizado '. date("H:i") . ' hs.</p>';	
    return $fecha;
  }  
  
?>
