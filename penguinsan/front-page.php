<?php get_header(); ?>
<!--	メイン-->
<main>
  <div class="menu-box mb-20">
    <div class="container">
      <?php wp_nav_menu(array('menu'=>'navigation','menu_class'=>'menu','container'=> false,)); ?>
    </div>
  </div>
  <div class="container main-text">
    <div class="row">
      <div class="col-lg-8 col-12">
        <div class="row">
          <?php if(have_posts( )) :?>
          <?php while (have_posts() ): the_post(); ?>
          <?php get_template_part('template-parts/loop', 'article'); ?>
          <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages);} ?>
      </div>
      <?php get_sidebar('sidebar'); ?>
    </div>
  </div>
</main>
<?php get_footer(); ?>
