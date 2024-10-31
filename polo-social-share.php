<?php 
/*
 * Plugin Name: Polo Social Share Icons
 * Plugin URI:  http://bplugins.com
 * Description: Integrate Social media shareing icon easily.
 * Version: 1.0
 * Author: bPlugins LLC
 * Author URI: http://hayat.im
 * License: GPLv3
 */
 
 

 
/*Some Set-up*/
define('PSS_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' ); 



/* JS*/
if ( ! function_exists( 'pss_get_script' ) ) :
function pss_get_script(){ 
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'pss-social-js', plugin_dir_url( __FILE__ ) . 'js/jssocials.js','20120207', true );
}
add_action('wp_enqueue_scripts', 'pss_get_script');
endif;

//CSS
if ( ! function_exists( 'pss_get_style' ) ) :
function pss_get_style() {
	wp_enqueue_style( 'pss-social-style', plugin_dir_url( __FILE__ ) . 'css/jssocials.css' );

	wp_enqueue_style( 'pss-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'pss_get_style' );
endif;

//Setting page class
include_once('admin-page-class/class-usage-demo.php'); 


//Redirect setting page

function pss_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'options-general.php?page=options-general.php_social_share_settings' ) ) );
    }
}
add_action( 'activated_plugin', 'pss_activation_redirect' );

// Get setting options value
	function pss_retrive_option($setting,$id,$default){	

	$data=get_option($setting);
	$data=$data[$id];
	if(isset($data)){
	return $data;	
	}
	return $default;
	}

// Locate and Render Social Icons 	
  
 add_filter( 'the_content', 'pss_content_handler' ); 
 function pss_content_handler( $content ) {
	if(pss_retrive_option('options_social_share','for_page','0')=='1'){$post_types_for_social= array("post", "page");	}else{$post_types_for_social='post';}	 
    if (is_singular( $post_types_for_social ) ) {
		if(pss_retrive_option('options_social_share','location','before')=='after'){$content = $content.do_shortcode('[icons]');}else{$content = do_shortcode('[icons]').$content;}
        
		}
    return $content;
}
// Lets register our shortcode
function pss_shortcode_func($atts){
	extract( shortcode_atts( array(
	), $atts ) ); 
		
?>
<?php ob_start(); ?>	
<div>
<style type="text/css">
<?php if(pss_retrive_option('options_social_share','circular','0')=='1'  ){ if (pss_retrive_option('options_social_share','show_label','0')=='1'){}else{echo '.jssocials-share-link{ border-radius: 50% !important; }'; }}?>
<?php if(null !==(pss_retrive_option('options_social_share','icon_size','12'))): echo ' .jssocials{font-size:'.pss_retrive_option('options_social_share','icon_size','12').'px !important;'; endif; ?>}

</style>
<p style="font-size:22px;padding:0;margin:0;"><?php echo pss_retrive_option('options_social_share','share_message','Share This Story !');?></p>
	<div id="share"></div>
</div>	
    <script>
        jQuery("#share").jsSocials({
             shares: [
			 <?php if(pss_retrive_option('options_social_share','facebook','1')=='1'){echo '"facebook",';} ?>
			 <?php if(pss_retrive_option('options_social_share','twitter','1')=='1'){echo '"twitter",';} ?>
			 <?php if(pss_retrive_option('options_social_share','linkedin','1')=='1'){echo '"linkedin",';} ?>
			 <?php if(pss_retrive_option('options_social_share','pinterest','1')=='1'){echo '"pinterest",';} ?>
			 <?php if(pss_retrive_option('options_social_share','stumbleupon','1')=='1'){echo '"stumbleupon",';} ?>
			 <?php if(pss_retrive_option('options_social_share','vkt','1')=='1'){echo '"vkontakte",';} ?>
			 <?php if(pss_retrive_option('options_social_share','messenger','1')=='1'){echo '"messenger",';} ?>
			 <?php if(pss_retrive_option('options_social_share','whatsapp','1')=='1'){echo '"whatsapp",';} ?>
			 <?php if(pss_retrive_option('options_social_share','viber','1')=='1'){echo '"viber",';} ?>
			 <?php if(pss_retrive_option('options_social_share','line','1')=='1'){echo '"line",';} ?>
			 <?php if(pss_retrive_option('options_social_share','telegram','1')=='1'){echo '"telegram",';} ?>
			 <?php if(pss_retrive_option('options_social_share','pocket','1')=='1'){echo '"pocket",';} ?>			 
			 <?php if(pss_retrive_option('options_social_share','email','1')=='1'){echo '"email",';} ?>
			 ],
			 <?php if(pss_retrive_option('options_social_share','show_label','0')=='1'){echo 'showLabel:true,';}else{echo 'showLabel:false,';} ?>
			 <?php if(pss_retrive_option('options_social_share','show_count','1')=='1'){echo 'showCount:true,';}else{echo 'showCount:false,';} ?>
			 <?php if(pss_retrive_option('options_social_share','share_in','1')=='1'){echo 'shareIn:"popup",';} ?>
        });
    </script>
	<?php  // social share theme css 
	function choose_theme($theme){
		$url= plugin_dir_url( __FILE__ ) . 'css/jssocials-theme-'.$theme.'.css';
		wp_enqueue_style( 'pss-social-theme-style', $url );
		
		
	}
	choose_theme(pss_retrive_option('options_social_share','theme','flat'));
	
	?>
<?php $output = ob_get_clean();return $output; ?>
<?php
}
add_shortcode('icons','pss_shortcode_func');

// Review Request as admin notice


function pss_review_request_notice() {
    ?>
    <div class="notice notice-success ">
		<p><?php $url = 'https://wordpress.org/support/plugin/polo-social-share-icons/reviews/?filter=5#new-post';
			$text = sprintf( __( 'If you like <strong>WP Social Share</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. Need some improvement ? We like to listen from you ! <a href="mailto:abuhayat.du@gmail.com">Request for improvement.</a> ', 'pvg-review' ), $url ); echo $text; ?></p>
			
				
    </div>
    <?php
}
add_action( 'admin_notices', 'pss_review_request_notice' );	