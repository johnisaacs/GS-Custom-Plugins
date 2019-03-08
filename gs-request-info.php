<?php
/* 
Plugin Name: Georgia Southern - Request More Info Button
Plugin URI: http://www.georgiasouthern.edu
Description: Add a Request More Info button to a sidebar widget area.
Version: 2.0	
Author: Georgia Southern University Web Team
Author URI: http://www.georgiasouthern.edu
*/

class gs_requestinfo extends WP_Widget {
	// constructor
	function __construct() {
			$widget_ops = array(
			'classname' => 'gs_requestinfo',
			'description' => 'Add a Request More Info button for prospective students to your sidebar.'
	);

	parent::__construct(
			'gs_requestinfo',
			'Request More Info Button',
			$widget_ops
	);
	}	
	// widget form creation
	function form($instance) {	
		// Check values
		if( $instance) {
			$select = esc_attr($instance['select']);
		} 
		else {	
			$select = '';
		}
		?>			

		<p>Button will link to the Office of Admissions "Request More Information" form for prospective undergraduate and graduate students.</p>
		<p>
			<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Button Color (optional):', 'wp_widget_plugin'); ?></label>
			<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
				<?php
				$options = array('Aqua', 'Navy', 'Gold');
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
		$instance['select'] = strip_tags($new_instance['select']);		
		return $instance;
	}
	
	// widget display
	function widget($args, $instance) { 
		extract( $args );
		// these are the widget options		
		$select = $instance['select'];		
		echo $before_widget;
		// Display the widget
		if ( $select == 'Gold' ) {
			echo '<div class="inforequest bg-gold"><a href="https://georgiasouthern.askadmissions.net/emtinterestpage.aspx?ip=homepageinfoform?lightbox[iframe]=true?lightbox[width]=600&lightbox[height]=400" class="lightbox btn-inforequest">Request More Information</a></div>';
		} 
		else if ( $select == 'Navy' ) {
			echo '<div class="inforequest bg-navy"><a href="https://georgiasouthern.askadmissions.net/emtinterestpage.aspx?ip=homepageinfoform?lightbox[width]=600&lightbox[height]=400" class="lightbox btn-inforequest">Request More Information</a></div>';
		} 
		else {
			echo '<div class="inforequest bg-aqua"><a href="https://georgiasouthern.askadmissions.net/emtinterestpage.aspx?ip=homepageinfoform?lightbox[iframe]=true&lightbox[width]=250&lightbox[height]=650" class="lightbox btn-inforequest">Request More Information</a></div>';
		}	
				
		
		echo $after_widget;
	}
}
//add_action('widgets_init',create_function('','return register_widget("gs_requestinfo");'));
add_action('widgets_init', function(){
		return register_widget("gs_requestinfo");
});
?>