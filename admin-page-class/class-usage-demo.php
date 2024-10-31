<?php


  //include the main class file
  require_once("admin-page-class.php");
  
  
  /**
   * configure your admin page
   */
  $config = array(    
    'menu'           => 'settings',             //sub page to settings page
    'page_title'     => __('Social Share Settings','pss'),       //The name of this page 
    'capability'     => 'edit_themes',         // The capability needed to view the page 
    'option_group'   => 'options_social_share',       //the name of the option to create in the database
    'id'             => 'admin_page',            // meta box id, unique per page
    'fields'         => array(),            // list of fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => false          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );  
  
  /**
   * instantiate your admin page
   */
  $options_panel = new BF_Admin_Page_Class($config);
  $options_panel->OpenTabs_container('');
  
  /**
   * define your admin page tabs listing
   */
  $options_panel->TabsListing(array(
    'links' => array(
      'options_1' =>  __('General Setting','pss'),
      'options_2' =>  __('Social Icons','pss'),
    )
  ));
  
  /**
   * Open admin page first tab
   */
  $options_panel->OpenTab('options_1');

  /**
   * Add fields to your admin page first tab
   * 
   * Simple options:
   * input text, checbox, select, radio 
   * textarea
   */
  //title
  $options_panel->Title(__("General Settings","apc"));
  //An optionl descrption paragraph
  $options_panel->addParagraph(__("If you like <strong>Polo Social Share Plugin</strong> please leave us a <a href='https://wordpress.org/support/plugin/polo-social-share/reviews/?filter=5#new-post' target='_blank'>&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. Need some improvement ? We like to listen from you ! <a href='mailto:abuhayat.du@gmail.com'>Request for improvement.</a>","apc"));
/*   $options_panel->addParagraph(__("<strong>ShortCode: </strong> By default Social share icons are enabled in Post Content Only. Use this shortcode in  page, widget or other areas to show the share icons in respective areas. <input onClick='this.select();' value='[share_icons]'> ","apc")); */
  
  //radio field
  $options_panel->addRadio('location',array('before'=>'Before the Post Content','after'=>'After the Post content'),array('name'=> __('Share Button location','pss'), 'std'=> array('before'), 'desc' => __('Select the location of the share icons.','pss')));
  
  
  //radio field
  $options_panel->addRadio('icon_size',array('8'=>'Small','12'=>'Medium','18'=>'Large','24'=>'Extra Large'),array('name'=> __('Icon Size','pss'), 'std'=> array('12'), 'desc' => __('Select the Icon size','pss')));
  //checkbox field
  $options_panel->addCheckbox('for_page',array('name'=> __('Share Button In Page','pss'), 'std' => false, 'desc' => __('Enable showing the share button in single page content. By default Social share icons are enabled in Post Content Only.','pss')));  
  //checkbox field
  $options_panel->addCheckbox('show_count',array('name'=> __('Show share count ','pss'), 'std' => true, 'desc' => __('Enable showing the share count.','pss')));
   //checkbox field
  $options_panel->addCheckbox('show_label',array('name'=> __('Show Label','pss'), 'std' => false, ));  
   //checkbox field
  $options_panel->addCheckbox('share_in',array('name'=> __('Share In PopUp','pss'), 'std' => true, ));    
  //select field
  $options_panel->addSelect('theme',array('flat'=>'Flat','classic'=>'Classic','minima'=>'Minima','plain'=>'Plain'),array('name'=> __('Select Theme ','pss'), 'std'=> array('flat'), 'desc' => __('Select the social icon theme.','pss'))); 
    //checkbox field
  $options_panel->addCheckbox('circular',array('name'=> __('Round Icons','pss'), 'std' => false, 'desc' => __('Turn on to make share buttons round. Work only when the Show Label option is off.','pss') ));    
  $options_panel->addTextarea('share_message',array('name'=> __('Share request text','pss'), 'std'=> 'Share This Story !'));



  /**
   * Close first tab
   */   
  $options_panel->CloseTab();


  /**
   * Open admin page Second tab
   */
  $options_panel->OpenTab('options_2');
  /**
   * Add fields to your admin page 2nd tab
   * 
   * Fancy options:
   *  typography field
   *  image uploader
   *  Pluploader
   *  date picker
   *  time picker
   *  color picker
   */
  //title
  $options_panel->Title(__('Social icons setting','pss'));
   
   $options_panel->addCheckbox('facebook',array('name'=> __('Facebook share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('twitter',array('name'=> __('Twitter share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('linkedin',array('name'=> __('Linkedin share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('pinterest',array('name'=> __('Pinterest share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('stumbleupon',array('name'=> __('Stumbleupon share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('vkt',array('name'=> __('Vkontakte share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('messenger',array('name'=> __('Messenger share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('whatsapp',array('name'=> __('Whatsapp share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('viber',array('name'=> __('Viber share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('line',array('name'=> __('Line share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('telegram',array('name'=> __('Telegram share icon','pss'), 'std' => true, ));  
   $options_panel->addCheckbox('pocket',array('name'=> __('Pocket share icon','pss'), 'std' => true, ));   
   $options_panel->addCheckbox('email',array('name'=> __('Email share icon','pss'), 'std' => true, ));  
	
  
  /**
   * Close second tab
   */ 
  $options_panel->CloseTab();