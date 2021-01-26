<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <div id="page">

      <header id="masthead" class="site-header" role="banner">

        <div class="site-branding">
          <p class="site-title">
            <a href="<?php echo esc_url( home_url( '/' ) ) ;?>" rel="home">
              <?php bloginfo( 'name' ); ?>
            </a>
          </p>
          <p class="site-description" >
            <?php bloginfo( 'description' ); ?>
          </p>
        </div>


        <!-- Navigation menu -->
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <?php wp_megamenu(array('menu' => '2')); ?>
        </nav>
        
        <!-- Sliding Cover -->
        <?php echo do_shortcode('[smartslider3 slider="2"]'); ?>

      </header>

      <div id="content" class="site-content">
