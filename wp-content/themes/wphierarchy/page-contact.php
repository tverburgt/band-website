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

      </header>

      <div id="content" class="site-content">


  <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">

      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'page' ); ?>

      <?php endwhile; else : ?>

        <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>

      <p>Template: page.php</p>

    </main>

  </div>

  <?php //get_sidebar( 'page' ); ?>

<?php get_footer(); ?>
