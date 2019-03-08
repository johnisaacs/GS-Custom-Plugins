<?php
/* 
Plugin Name: Georgia Southern - Apply Now Ribbon
Plugin URI: http://www.georgiasouthern.edu
Description: Apply Now Ribbon with links to Georgia Southern's Undergraduate and Graduate Admissions websites.
Version: 2.0	
Author: Georgia Southern University Web Team
Author URI: http://www.georgiasouthern.edu
*/

class gsu_applynow extends WP_Widget {
          function __construct() {
                    $widget_ops = array(
                    'classname' => 'gsu_applynow',
                    'description' => 'Add an Apply Now ribbon with links to Undergraduate/Graduate Admissions to your sidebar.'
          );

          parent::__construct(
                    'gsu_applynow',
                    'Apply Now Ribbon',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print <<<EOM
<h6 id="applynow" class="ribbon-right">
				<span>Apply Now</span>
					<span class="studentlevel">
						<a href="http://admissions.georgiasouthern.edu/">Undergraduate</a> &bull; 
						<a href="http://cogs.georgiasouthern.edu/admission/">Graduate</a>
					</span>
				</h6>
<div class="ribbon-right-corner"></div>

EOM;
                    echo $after_widget; // post-widget code from theme
          }
}

/*add_action(
          'widgets_init',
          create_function('','return register_widget("gsu_applynow");')
);*/
add_action('widgets_init', function(){
		return register_widget("gsu_applynow");
});
?>