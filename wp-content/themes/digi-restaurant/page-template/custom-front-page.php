<?php
/**
 * Template Name: Custom Front Page
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-section">
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-lg-4 col-md-4 col-sm-4 pl-md-0">
          <?php if(get_theme_mod('digi_restaurant_image_two') != ''){ ?>
            <img src="<?php echo esc_url(get_theme_mod('digi_restaurant_image_one')); ?>"/>
          <?php }?>
          <?php if(get_theme_mod('digi_restaurant_image_two') != ''){ ?>
            <img src="<?php echo esc_url(get_theme_mod('digi_restaurant_image_two')); ?>"/>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="top-inner">
            <?php if(get_theme_mod('digi_restaurant_top_section_heading') != ''){ ?>
              <h2><?php echo esc_html(get_theme_mod('digi_restaurant_top_section_heading')); ?></h2>
            <?php }?>
            <?php if(get_theme_mod('digi_restaurant_top_section_content') != ''){ ?>
              <p><?php echo esc_html(get_theme_mod('digi_restaurant_top_section_content')); ?></p>
            <?php }?>
            <?php if(get_theme_mod('digi_restaurant_top_section_url') != '' || get_theme_mod('digi_restaurant_top_section_text') != ''){ ?>
              <div class="top-inner-btn my-4"><a href="<?php echo esc_url(get_theme_mod('digi_restaurant_top_section_url')); ?>"><?php echo esc_html(get_theme_mod('digi_restaurant_top_section_text')); ?></a></div>
            <?php }?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 pr-md-0">
          <?php if(get_theme_mod('digi_restaurant_image_three') != ''){ ?>
            <img src="<?php echo esc_url(get_theme_mod('digi_restaurant_image_three')); ?>"/>
          <?php }?>
          <?php if(get_theme_mod('digi_restaurant_image_four') != ''){ ?>
            <img src="<?php echo esc_url(get_theme_mod('digi_restaurant_image_four')); ?>"/>
          <?php }?>
        </div>
      </div>
    </div>
  </section>
  <section id="welcome-section" class="py-5">
    <div class="container">
      <div class="row">
        <?php $digi_restaurant_welcome_page = array();
          $mod = intval( get_theme_mod( 'digi_restaurant_welcome_page' ));
          if ( 'page-none-selected' != $mod ) {
            $digi_restaurant_welcome_page[] = $mod;
          }
          if( !empty($digi_restaurant_welcome_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $digi_restaurant_welcome_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
        ?>
        <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-lg-6 col-md-6 col-sm-6 align-self-center">
            <div class="welcome-box text-center">
              <h2><?php echo esc_html(get_theme_mod('digi_restaurant_welcome_section_heading')); ?></h2>
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p><?php the_excerpt(); ?></p>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 align-self-center">
            <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          </div>
        <?php endwhile; 
        wp_reset_postdata();?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>