<?php

// Ajouter styles et scripts
add_action( 'wp_enqueue_scripts', 'enqueue_css' );

// die(get_template_directory().'/script.js');

function enqueue_css() {
  wp_enqueue_style('style', get_stylesheet_uri());
  wp_enqueue_style( 'Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_style( 'FontAwesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  $jquery = '<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>';
  wp_enqueue_script('BootstrapBundle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js');
  wp_enqueue_script('Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
  wp_enqueue_script('JQuery', $jquery);
  wp_enqueue_script('script', get_template_directory().'/script.js');
}

// ajouter des zones de menu
add_action('after_setup_theme', 'add_menu_zones');
function add_menu_zones() {
  register_nav_menus([
    'main_menu' => __('Menu header', 'ilsductheme'),
    'footer_menu' => __('Menu footer', 'ilsductheme'),
  ]);
}

// add sidebars and widgets
add_action('widgets_init', 'sideBars');
function sideBars() {
  register_sidebar([
    'name' => __('Ma sidebar', 'ilsductheme'),
    'id' => 'ilsduc-sidebar',
    'description' => __('Ma bar latéral', 'ilsductheme'),
  ]);
}

// adding custom menu
add_action('customize_register', 'customized_register');
function customized_register($wp_customize) {
  /*
    ** adding sections
  */
  $wp_customize->add_section('cd_colors', [
    'title' => __('Couleurs', 'ilsductheme'),
    'priority' => 1,
  ]);
  // changement for background color
  $wp_customize->add_setting('bg_color', [
    'default' => '#FFF',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bg_color', [
    'label' => __('Couleur de fond', 'ilsductheme'),
    'section' => 'cd_colors',
    'settings' => 'bg_color'
  ]));
  // changement for color
  $wp_customize->add_setting('color', [
    'default' => '#000',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color', [
    'label' => __('Couleur de texte', 'ilsductheme'),
    'section' => 'cd_colors',
    'settings' => 'color'
  ]));
  // Create the Banniere section
  create_banniere_section($wp_customize);
  // Create the Navigation section
  create_nav_section($wp_customize);
  // Create the Navigation section
  create_footer_section($wp_customize);
  // Create the Navigation section
  article_page_custom($wp_customize);
}

// Apply modifications for custom options style
add_action('wp_head', 'style_options_customize');
function style_options_customize() {
  echo '<style>body {background: '.get_theme_mod('bg_color', '#fff').'}</style>';
  echo '<style>body {color: '.get_theme_mod('color', '#000').'}</style>';
}

//----------------------------------
// adding custom post types
//----------------------------------
add_action('init', 'cours_post_types');
function cours_post_types() {
  register_post_type('cours', [
    'label' => __('Cours', 'ilsductheme'),
    'description' => __('Ajouter des cours', 'ilsductheme'),
    'public' => true,
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => [
      'title',
      'thumbnail',
      'editor',
    ],
    'menu_position' => 4,
    'menu_icon' => 'dashicons-awards',
  ]);
}

add_theme_support('post_thumbails');

/* Function is responsible to  */
function create_banniere_section($wp_customize) {
  // Adding the section
  $wp_customize->add_section('img_banniere', [
    'title' => __('Bannières', 'ilsductheme'),
    'priority' => 2,
  ]);
  // Adding setting and control for image uploader
  $wp_customize->add_setting('img_banniere', [
    'default' => '',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control(
  	new WP_Customize_Image_Control(
  	$wp_customize,
  	'img_banniere',[
  		'label'      => __( 'Image du header', 'mytheme' ),
  		'section'    => 'img_banniere',
  		'settings'   => 'img_banniere',
  	])
  );
  // adding setting and ontrol for image attachment
  $wp_customize->add_setting('img_banniere_attachement', [
    'default' => 'fixed',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control( 'img_banniere_attachement', [
    'type' => 'select',
    'section' => 'img_banniere',
    'label' => __( 'Background Attachement' ),
    'choices' => [
      'fixed' => 'Fixed',
      'local' => 'Local',
      'scroll' => 'Scroll',
      'inherit' => 'Inherit',
    ],
  ]);
  // adding setting and control for image position
  $wp_customize->add_setting('img_banniere_position', [
    'default' => 'center',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control( 'img_banniere_position', [
    'type' => 'select',
    'section' => 'img_banniere',
    'label' => __( 'Background Position' ),
    'choices' => [
      'left' => 'Left',
      'center' => 'Center',
      'right' => 'Right',
      'bottom' => 'Bottom',
      'top' => 'Top',
    ],
  ]);
}

function create_nav_section($wp_customize) {
  // Adding the section
  $wp_customize->add_section('navigation', [
    'title' => __('Navigation', 'ilsductheme'),
    'priority' => 3,
  ]);
  // Adding setting and control for image uploader
  $wp_customize->add_setting('img_logo', [
    'default' => '',
    'transport' => 'refresh',
  ]);
  //
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
    $wp_customize,
    'img_logo',[
      'label'      => __( 'Image du header', 'mytheme' ),
      'section'    => 'navigation',
      'settings'   => 'img_logo',
    ])
  );
  // adding setting and ontrol for image attachment
  $wp_customize->add_setting('logo_form', [
    'default' => 'squared',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control( 'logo_form', [
    'type' => 'select',
    'section' => 'navigation',
    'label' => __( 'Forme du logo' ),
    'choices' => [
      'squared' => 'Carré',
      'rounded' => 'Rond',
    ],
  ]);
  // changement for color
  $wp_customize->add_setting('navbar_color', [
    'default' => '#e4e4e4',
    'transport' => 'refresh',
  ]);
  /*
  color picker for navbar background
  */
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'navbar_color', [
    'label' => __('Couleur de fond', 'ilsductheme'),
    'section' => 'navigation',
    'settings' => 'navbar_color'
  ]));

/*
  Chebox for
*/
  $wp_customize->add_setting( 'show_shadow', [
     'default'    => false,
     'transport' => 'refresh',
  ]);

 // Add control and output for select field
 $wp_customize->add_control( 'show_shadow', array(
     'label'      => __( 'Voir l\'ombrage' ),
     'section'    => 'navigation',
     'settings'   => 'show_shadow',
     'type'       => 'checkbox',
 ));

 // changement for color
 $wp_customize->add_setting('link_color', [
   'default' => '#e4e4e4',
   'transport' => 'refresh',
 ]);
 /*
 color picker for navbar background
 */
 $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', [
   'label' => __('Couleur des liens', 'ilsductheme'),
   'section' => 'navigation',
   'settings' => 'link_color'
 ]));

}

function create_footer_section($wp_customize) {
  // Adding the section
  $wp_customize->add_section('footer', [
    'title' => __('Footer', 'ilsductheme'),
    'priority' => 4,
  ]);
  // changement for color
  $wp_customize->add_setting('footer_bg_color', [
    'default' => '#e4e4e4',
    'transport' => 'refresh',
  ]);
  /*
  color picker for navbar background
  */
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', [
    'label' => __('Couleur de fond', 'ilsductheme'),
    'section' => 'footer',
    'settings' => 'footer_bg_color'
  ]));

}


function article_page_custom($wp_customize) {
  // Adding the section
  $wp_customize->add_section('articles', [
    'title' => __('Articles', 'ilsductheme'),
    'priority' => 4,
  ]);
  // changement for color
  $wp_customize->add_setting('articles_nb_column_sm', [
    'default' => 'col-sm-12',
    'transport' => 'refresh',
  ]);
  /*
  Number of column
  */
  $wp_customize->add_control( 'articles_nb_column_sm', [
    'type' => 'select',
    'section' => 'articles',
    'label' => __( 'Nombre de colonnes sur petit ecran' ),
    'choices' => [
      'col-sm-12' => '1',
      'col-sm-6' => '2',
      'col-sm-4' => '3',
      'col-md-3' => '4',
      'col-md-2' => '6',
    ],
  ]);
  /*
    Chebox for
  */
    $wp_customize->add_setting( 'prevent_articles_nb_column_sm', [
       'default'    => true,
       'transport' => 'refresh',
    ]);
   // Add control and output for select field
   $wp_customize->add_control( 'prevent_articles_nb_column_sm', array(
       'label'      => __( 'Ne pas appliquer' ),
       'section'    => 'articles',
       'settings'   => 'prevent_articles_nb_column_sm',
       'type'       => 'checkbox',
   ));


  // changement for color
  $wp_customize->add_setting('articles_nb_column_md', [
    'default' => 'col-md-12',
    'transport' => 'refresh',
  ]);
  /*
  Number of column
  */
  $wp_customize->add_control( 'articles_nb_column_md', [
    'type' => 'select',
    'section' => 'articles',
    'label' => __( 'Nombre de colonnes sur ecran moyen' ),
    'choices' => [
      'col-md-12' => '1',
      'col-md-6' => '2',
      'col-md-4' => '3',
      'col-md-3' => '4',
      'col-md-2' => '6',
    ],
  ]);
  /*
    Chebox for
  */
    $wp_customize->add_setting( 'prevent_articles_nb_column_md', [
       'default'    => true,
       'transport' => 'refresh',
    ]);

   // Add control and output for select field
   $wp_customize->add_control( 'prevent_articles_nb_column_md', array(
       'label'      => __( 'Ne pas appliquer' ),
       'section'    => 'articles',
       'settings'   => 'prevent_articles_nb_column_md',
       'type'       => 'checkbox',
   ));


  // changement for color
  $wp_customize->add_setting('articles_nb_column_lg', [
    'default' => 'col-lg-12',
    'transport' => 'refresh',
  ]);
  /*
  Number of column
  */
  $wp_customize->add_control( 'articles_nb_column_lg', [
    'type' => 'select',
    'section' => 'articles',
    'label' => __( 'Nombre de colonnes sur ecran moyen' ),
    'choices' => [
      'col-lg-12' => '1',
      'col-lg-6' => '2',
      'col-lg-4' => '3',
      'col-lg-3' => '4',
      'col-lg-2' => '6',
    ],
  ]);
  /*
    Chebox for
  */
    $wp_customize->add_setting( 'prevent_articles_nb_column_lg', [
       'default'    => true,
       'transport' => 'refresh',
    ]);

   // Add control and output for select field
   $wp_customize->add_control( 'prevent_articles_nb_column_lg', array(
       'label'      => __( 'Ne pas appliquer' ),
       'section'    => 'articles',
       'settings'   => 'prevent_articles_nb_column_lg',
       'type'       => 'checkbox',
   ));

}
