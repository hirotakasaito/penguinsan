<?php get_header(); ?>

<main>
  <div class="menu-box mb-20">
    <div class="container">
      <?php wp_nav_menu(array('menu'=>'navigation','menu_class'=>'menu','container'=> false,)); ?>
    </div>
  </div>
  <div class="container main-text">
    <h2 class="title">「<?php the_search_query();?>」サイト内検索結果</h2>
    <div class="row">
      <div class="col-lg-8 col-12">
        <div class="row">
          <?php if(have_posts( )) :?>
          <?php while (have_posts() ): the_post(); ?>
          <?php get_template_part('template-parts/loop', 'article'); ?>
          <?php endwhile; ?>
          <?php else: ?>
          <p>検索結果はありませんでした。</p>
          <?php endif; ?>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>
