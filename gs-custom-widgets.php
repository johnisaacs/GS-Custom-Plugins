<?php
/* 
Plugin Name: Georgia Southern - Custom Widgets
Plugin URI: http://wordpress.georgiasouthern.edu
Description: Custom widgets for Georgia Southern University websites - donation and request more info buttons and a testimonial widget.
Version: 3.0	
Author: Georgia Southern University Web Team
Author URI: http://wordpress.georgiasouthern.edu
*/
//Custom Donate Button
class gs_donate extends WP_Widget {
	// constructor
	function __construct() {
			$widget_ops = array(
			'classname' => 'gs_donate',
			'description' => 'Add a &#34;Make a Gift&#34; button to your sidebar.'
	);

	parent::__construct(
			'gs_donate',
			'Donation Button',
			$widget_ops
	);
	}	
	// widget form creation
	function form($instance) {	
		// Check values
		if( $instance) {			 
			 $text = esc_attr($instance['text']);
			 $donationurl = esc_attr($instance['donationurl']);
			 $select = esc_attr($instance['select']);
		} else {
			 $text = '';
			 $donationurl = '';
			 $select = '';
		}
		?>
		
		<p>By default, the "Make a Gift" button will link to the University's main online donation page. You have the option to change the text and link to your custom donation page instead. </p>
		<p><strong>Button Options</strong></p>
		<p>
		<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Button Text (optional):', 'gs_donate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
		</p>
	
		<p>
		<label for="<?php echo $this->get_field_id('donationurl'); ?>"><?php _e('Donation page URL (optional):', 'gs_donate'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('donationurl'); ?>" name="<?php echo $this->get_field_name('donationurl'); ?>" type="text" value="<?php echo $donationurl; ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Button Color (optional):', 'gs_donate'); ?></label>
		<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
			<?php
			$options = array('Aqua', 'GS Blue', 'Gold');
			foreach ($options as $option) {
			echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			}
			?>
		</select>
		</p>
		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['donationurl'] = strip_tags($new_instance['donationurl']);
		$instance['select'] = strip_tags($new_instance['select']);
		return $instance;
	}
	
	// widget display
	function widget($args, $instance) { 
		extract( $args );
		// these are the widget options		
		$text = $instance['text'];
		$donationurl = $instance['donationurl'];
		$select = $instance['select'];
		echo $before_widget;
		// Display the widget
		
		if ( $select == 'Gold' ) {
			echo '<a class="btn btn-gold give" ';
		}
		else if ( $select == 'GS Blue' ) {
			echo '<a class="btn btn-blue give" ';
		}
		else {
			echo '<a class="btn btn-aqua give" ';
		}
		// Check if text is set
		if( $donationurl ) {
		  echo 'href="'.$donationurl.'">';
		}
		elseif( empty ($donationurl) ) {
		  echo 'href="http://www.georgiasouthern.edu/donate">';
		}
		if( $text ) {
		  echo ''.$text.'</a>';
		}
		elseif( empty ($text) ) {
		  echo 'Make a Gift</a>';
		}
		
		else {
			 echo '<a class="btn btn-aqua give" href="http://www.georgiasouthern.edu/donate">Make a Gift</a>';
		}		
		
		echo $after_widget;
	}
}
//add_action('widgets_init',create_function('','return register_widget("gs_donate");'));
add_action('widgets_init', function(){
		return register_widget("gs_donate");
	});
// Testimonial Widget
class gs_testimonial extends WP_Widget {
	// constructor
	function __construct() {
			$widget_ops = array(
			'classname' => 'gs_testimonial',
			'description' => 'Add a testimonial to your sidebar.'
	);

	parent::__construct(
			'gs_testimonial',
			'Testimonial',
			$widget_ops
	);
	}	
	// widget form creation
	function form($instance) {	
		// Check values
		if( $instance) {
			
			 $text = esc_attr($instance['text']);
			 $textarea = esc_textarea($instance['textarea']);			 
		} else {			
			 $text = '';
			 $textarea = '';			 
		}
		?>			
		
		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Testimonial:', 'gs_testimonial'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Attribution:', 'gs_testimonial'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
		</p>		
		
		<?php
	}

	// widget update
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields		
		$instance['text'] = strip_tags($new_instance['text']);
		if ( current_user_can('unfiltered_html') )
			$instance['textarea'] =  $new_instance['textarea'];
		else
			$instance['textarea'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['textarea']) ) );
		return $instance;
	}
	
	// widget display
	function widget($args, $instance) { 
		extract( $args );
		// these are the widget options
		
		$text = $instance['text'];
		$textarea = apply_filters( 'widget_textarea', empty( $instance['textarea'] ) ? '' : $instance['textarea'], $instance );
		echo $before_widget;
		// Display the widget		
		echo '<div class="widget-text testimonial sm aqua">';		
		
		// Check if textarea is set
		if( $textarea ) { echo wpautop($textarea); }
		
		// Check if text is set
		if( $text ) {
		  echo '<p class="author">'.$text.'</p>';
		}
		
		echo '</div>';
		echo $after_widget;
	}
}
//add_action('widgets_init',create_function('','return register_widget("gs_testimonial");'));
add_action('widgets_init', function(){
		return register_widget("gs_testimonial");
	});
// Request More Information Widget
class gsbootstrap_requestinfo extends WP_Widget {
          function __construct() {
                    $widget_ops = array(
                    'classname' => 'gsbootstrap_requestinfo',
                    'description' => 'Add a request more information button to your sidebar - bootstrap themes only.'
          );

          parent::__construct(
                    'gsbootstrap_requestinfo',
                    'Bootstrap Request More Info Button',
                    $widget_ops
          );
}

          function widget($args, $instance) { // widget sidebar output
                    extract($args, EXTR_SKIP);
                    echo $before_widget; // pre-widget code from theme
print <<<EOM
<button class="btn btn-lg btn-aqua request-info" data-toggle="modal" data-target=".hobsons-modal">Request More Information</button>
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
          create_function('','return register_widget("gsbootstrap_requestinfo");')
);*/
add_action('widgets_init', function(){
		return register_widget("gsbootstrap_requestinfo");
	});

?>