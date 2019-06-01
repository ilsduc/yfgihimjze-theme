<!DOCTYPE html>
<html>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php wp_head(); ?>
    <title><?php bloginfo('title'); ?></title>
  </head>

  <style media="screen">
    #logo {
      width: 40px;
      height: 40px;
      background-image:url(<?= get_theme_mod('img_logo') ?>);
      border-radius: <?= get_theme_mod('logo_form') === 'squared' ? '0px':'100px' ?>;
    }

    #nav {
      background: <?= get_theme_mod('navbar_color'); ?>;
      box-shadow: <?= get_theme_mod('show_shadow')  ?'0 3px 7px 0 rgba(0,0,0,.2)':'none'; ?>;
    }
    #nav ul li a {
      text-decoration: none;
      color: <?= get_theme_mod('link_color'); ?>;
    }
    #nav ul li a:hover {
      background: rgba(255, 255, 255, 0.1);
    }
  </style>

  <body>
    <header id="header">
      <nav id="nav">
        <div id="logo"></div>
        <?php
           wp_nav_menu([
             'theme_location' => 'main_menu',
             'container' => 'div',
             'container_id' => 'nav-right',
           ]);
         ?>
     </nav>

    </header>

    <div class="container">
