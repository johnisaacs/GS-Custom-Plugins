<?php
/* 
Plugin Name: Admissions Request More Info Button for Bootstrap based themes
Plugin URI: http://www.georgiasouthern.edu
Description: Admissions request information form.
Version: 2.0	
Author: Georgia Southern University Web Team
Author URI: http://www.georgiasouthern.edu
*/

class gs_requestinfo_bootstrap extends WP_Widget {
          function __construct() {
                    $widget_ops = array(
                    'classname' => 'gs_requestinfo_bootstrap',
                    'description' => 'Add a request more information button to your sidebar - bootstrap themes only.'
          );

          parent::__construct(
                    'gs_requestinfo_bootstrap',
                    'Bootstrap Request More Info Button',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print <<<EOM
<button class="btn btn-primary" data-toggle="modal" data-target=".hobsons-modal">Request More Info</button>
	<div class="modal fade hobsons-modal" tabindex="-1" role="dialog" aria-labelledby="Request More Information" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" style="padding-right:5px;"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		 <iframe style="padding: 15px 0 0 15px;" src="//georgiasouthern.askadmissions.net/emtinterestpage.aspx?ip=homepageinfoform" width="275" height="650" scrolling="no">Loading...</iframe>
		</div>
	  </div>
	</div>

EOM;
                    echo $after_widget; // post-widget code from theme
          }
}

/*add_action(
          'widgets_init',
          create_function('','return register_widget("gs_requestinfo_bootstrap");')
);*/
add_action('widgets_init', function(){
		return register_widget("gs_requestinfo_bootstrap");
});
?>