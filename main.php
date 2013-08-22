<?php

/* 
Plugin Name: Google Ad's for Ships On Camera
Plugin URI: https://github.com/fabiodev/ad-soc 
Description: widget that shows google ads 
Version: 0.1 
Author: Fábio Silva 
Author URI: https://github.com/fabiodev/ 
License: A "Slug" license name e.g. GPL2 
. 
Any other notes about the plugin go here 
. 
*/  

function widget_adSoc($args=array(), $params=array()) {
  extract($args);
  $widgettitle = get_option('adSoc_widget_title');
  $widgetsource = get_option('adSoc_widget_adSoc');
  $widgetdesc = get_option('adSoc_widget_description');

 echo $before_widget;

  //Affix trial lacks div closure
  //echo '<div class="alert sidebar-widget sidebar-nav" data-spy="affix" >';

  echo $before_title.$widgettitle.$after_title;

  echo stripslashes($widgetdesc);


  echo $after_widget;
}

function adSoc_init(){

wp_register_sidebar_widget(
    'ad_soc_1',        // your unique widget id
    'Ad Soc',          // widget name
    'widget_adSoc',  // callback function
    array(                  // options
        'description' => 'Description of what your widget does'
    )
);

wp_register_widget_control(
	'ad_soc_1',		// id
	'Ad Soc',		// name
	'widget_adSoc_control'	// callback function
);

}

function widget_adSoc_control($args=array(), $params=array()) {
	//the form is submitted, save into database
	if (isset($_POST['submitted'])) {
		update_option('adSoc_widget_title', $_POST['widgettitle']);
		update_option('adSoc_widget_adSource', $_POST['adsource']);
		update_option('adSoc_widget_description', $_POST['description']);
	}

	//load options
	$widgettitle = get_option('adSoc_widget_title');
	$adsource = get_option('adSoc_widget_adSource');
	$description = get_option('adSoc_widget_description');
	?>

	Widget Title:<br />
	<input type="text" style="width:100%" name="widgettitle" value="<?php echo stripslashes($widgettitle); ?>" />
	<br /><br />

	Description about you:<br />
	<textarea style="width:100%" rows="5" name="description"><?php echo stripslashes($description); ?></textarea>
	<br /><br />

	Cookie Value:<br />
	<input type="text" style="width:100%" name="adsource" value="<?php echo stripslashes($adsource); ?>" />
	<br /><br />

	<input type="hidden" name="submitted" value="1" />
	<?php
}

add_action("plugins_loaded", "adSoc_init");

?>
