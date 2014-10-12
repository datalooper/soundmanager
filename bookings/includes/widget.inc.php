<?php
if (get_option('bookings_region') && (!defined('BOOKINGS_LIVE') || get_option('bookings_siteurl'))) {
	add_action( 'widgets_init', 'register_my_widget' );
}

function register_my_widget() {
	register_widget( 'Bookings_Search_Widget' );
}

/**
 * Adds Bookings_Search_Widget widget.
 */
class Bookings_Search_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'bookings_searchwidget', // Base ID
			'Bookings Search', // Name
			array( 'description' => __( 'Bookings search widget for use with template hotel3', 'text_domain' ), ) // Args
		);
		//if ( is_active_widget(false, false, $this->id_base, true) ) {}
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $bookings;
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		$postVars=array();
		$postVars['searchurl']=get_permalink($instance['page_id']);
		$postVars['template']=$instance['template'];
		bookings_output('search',$postVars);
		$output='<div id="bookings" class="bookings">';
		$output.=$bookings['output']['body'];
		$output.='</div>';
		echo $output;
		
		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) $title = $instance[ 'title' ];
		else $title = __( 'Search', 'text_domain' );
		if ( isset( $instance[ 'page_id' ] ) ) $pageId = $instance[ 'page_id' ];
		else $pageId = '';
		if ( isset( $instance[ 'template' ] ) ) $template = $instance[ 'template' ];
		else $template = 'hotel3';
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo $this->get_field_name( 'template' ); ?>"><?php _e( 'Template:' ); ?></label> 
		<select class="widefat" id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>">
		<?php foreach (array('hotel3') as $option) {
			$selected=$option==$template ? 'selected="selected"' : '';
			echo '<option value="'.$option.'" '.$selected.'>'.$option.'</option>';
		}
		?>
		</select>
		</p>
		<p>
		<label for="<?php echo $this->get_field_name( 'page_id' ); ?>"><?php _e( 'Page where search results should be displayed (make sure to include [bookings template=...] on that page):' ); ?></label>
		<?php wp_dropdown_pages(array('selected' => $pageId, 'name' => $this->get_field_name( 'page_id' ))); ?> 
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		print_r($new_instance);
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['page_id'] = ( !empty( $new_instance['page_id'] ) ) ? strip_tags( $new_instance['page_id'] ) : '';
		$instance['template'] = ( !empty( $new_instance['template'] ) ) ? strip_tags( $new_instance['template'] ) : '';
		return $instance;
	}

} // class Bookings_Search_Widget

