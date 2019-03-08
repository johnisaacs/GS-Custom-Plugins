<?php
/* 
Plugin Name: GSU SAEM Graphic Announcements
Plugin URI: http://www.georgiasouthern.edu
Description: Student Affairs & Enrollment Management Graphic Announcements
Version: 2.0	
Author: Georgia Southern University Web Team
Author URI: http://www.georgiasouthern.edu
*/

class gsu_saem_graphics extends WP_Widget {
          function __construct() {
                    $widget_ops = array(
                    'classname' => 'gsu_saem_graphics',
                    'description' => 'Student Affairs & Enrollment Management Graphic Announcements'
          );

          parent::__construct(
                    'gsu_saem_graphics',
                    'GSU SAEM Graphic Announcements',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print <<<EOM
<h6>DIVISION ANNOUNCEMENTS</h6>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="277" height="184" id="ssidx"><param name="movie" value="http://www.smugmug.com/ria/ShizamSlides-2012031404.swf" /><param name="flashVars" value="AlbumID=27156399&dontpost=true&AlbumKey=tNg8gf&newWindow=false&width=400&height=400&transparent=true&splash=&showLogo=false&captions=false&clickUrl=http%3A%2F%2Fwww.smugmug.com&showThumbs=false&showButtons=false&pageStyle=white&autoStart=true&showSpeed=false&VersionNos=2012031404&splashDelay=0&crossFadeSpeed=350&clickToImage=true&showStartButton=false&randomStart=false&randomize=true&mainHost=cdn.smugmug.com" /><param name="wmode" value="transparent" /><param name="allowNetworking" value="all" /><param name="allowScriptAccess" value="always" /><embed src="http://www.smugmug.com/ria/ShizamSlides-2012031404.swf" flashVars="AlbumID=27156399&dontpost=true&AlbumKey=tNg8gf&newWindow=false&width=400&height=400&transparent=true&splash=&showLogo=false&captions=false&clickUrl=http%3A%2F%2Fwww.smugmug.com&showThumbs=false&showButtons=false&pageStyle=white&autoStart=true&showSpeed=false&VersionNos=2012031404&splashDelay=0&crossFadeSpeed=350&clickToImage=true&showStartButton=false&randomStart=false&randomize=true&mainHost=cdn.smugmug.com" width="277" height="184" wmode="transparent" type="application/x-shockwave-flash" allowScriptAccess="always" allowNetworking="all" ></embed></object>

EOM;
                    echo $after_widget; // post-widget code from theme
          }
}

/*add_action(
          'widgets_init',
          create_function('','return register_widget("gsu_saem_graphics");')
);*/
add_action('widgets_init', function(){
		return register_widget("gsu_saem_graphics");
});
?>