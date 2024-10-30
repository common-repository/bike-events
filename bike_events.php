<?php
/*
Plugin Name: Bike Events Widget
Plugin URI: http://freehub.net/bike-events-widget
Description: Displays a listing of upcoming and nearby bicycle rides, races and events for a given zip code.  
Author: FreeHub
Version: 2.1
Author URI: http://www.freehub.net
*/
 
 
class BikeEventsWidget extends WP_Widget
{
  function BikeEventsWidget()
  {
    $widget_ops = array('classname' => 'BikeEventsWidget', 'description' => 'Displays a list of upcoming cycling related events in your area.  Once activated, you will find me under Appearance -> Widgets.' );
    $this->WP_Widget('BikeEventsWidget', 'Bike Events', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => 'Upcoming Cycling Events', 'zip' => '10001', 'max_display' => '10', 'distance' => '100', 'links' => '' ) );
    $title = $instance['title'];
    $zip = $instance['zip'];
    $max_display = $instance['max_display'];
    $distance = $instance['distance'];
    $links = $instance['links'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('zip'); ?>">Show events near Zip Code: <input id="<?php echo $this->get_field_id('zip'); ?>" size="6" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo attribute_escape($zip); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('distance'); ?>">Maximum distance in miles: <input id="<?php echo $this->get_field_id('distance'); ?>" size="3" name="<?php echo $this->get_field_name('distance'); ?>" type="text" value="<?php echo attribute_escape($distance); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('max_display'); ?>">Maximum number of events: <input id="<?php echo $this->get_field_id('max_display'); ?>" size="3" name="<?php echo $this->get_field_name('max_display'); ?>" type="text" value="<?php echo attribute_escape($max_display); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('links'); ?>">Show links: <input id="<?php echo $this->get_field_id('links'); ?>" name="<?php echo $this->get_field_name('links'); ?>" type="checkbox" value="1" <?php checked( '1', attribute_escape($links) ); ?>  /></label></p>
 
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['zip'] = $new_instance['zip'];
    $instance['max_display'] = $new_instance['max_display'];
    $instance['distance'] = $new_instance['distance'];
    $instance['links'] = $new_instance['links'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
 	
    echo $before_widget;
    
    echo '<div id="bike-events-widget">';
    
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $zip = $instance['zip'];
 	$max_display = $instance['max_display'];
 	$distance = $instance['distance'];
 	$links = $instance['links'];
 	
 	$blog_url = $_SERVER['SERVER_NAME'];
 	$blog_name = get_bloginfo('name');
  	//$blog_name = $blog_details->blogname;
 	
 	echo '<input type="hidden" id="bike-events-zip" value="' . $zip . '"/>';
 	echo '<input type="hidden" id="bike-events-max_display" value="' . $max_display . '"/>';
    echo '<input type="hidden" id="bike-events-distance" value="' . $distance . '"/>';
   	echo '<input type="hidden" id="bike-events-blog_url" value="' . $blog_url . '"/>';
   	echo '<input type="hidden" id="bike-events-links" value="' . $links . '"/>';
	echo '<input type="hidden" id="bike-events-blog_name" value="' . $blog_name . '"/>';
      
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    echo '<div id="freehub-link"><a href="http://freehub.net/events/?zip=' . $zip . '&distance' . $distance . '" title="Bike Rides Races & Results" rel="dofollow">Bike Rides, Races & Results</a></div>';   	
    echo '<span id="bike-events-spinner"><img src="/wp-content/plugins/bike-events/images/spinner.gif"/></span>';
    echo '<ul id="bike-events"></ul>';
    echo '<div id="bike-events-go"></div>';
    
    // this is to comply with plugin submission rules for showing external links...
    // if ($links == '1') {
    //	echo '<div id="widget-promo">';
    //	echo '<p><small><a href="http://freehub.net/bike-events-widget">Get this widget.</a></small></p>'; 
 	//	echo '</div>';
 	//}
 	
 	echo '</div>';
    echo $after_widget;
    
    wp_enqueue_script("jquery");
	wp_enqueue_script( 'bike_events', '/wp-content/plugins/bike-events/js/bike_events.js', array('jquery') ); 
    
  }
 
 
}

add_action( 'widgets_init', create_function('', 'return register_widget("BikeEventsWidget");') );


 
?>