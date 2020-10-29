<!--ヘッダー-->
<?php get_header(); ?>
<!--	メイン-->
<main>
  <div class="menu-box mb-20">
    <div class="container">
      <?php wp_nav_menu(array('menu'=>'navigation','menu_class'=>'menu','container'=> false,)); ?>
    </div>
  </div>
  <div class="breadcrumb"><?php breadcrumb(); ?></div>
  <div class="container whole">
  <?php if ( have_posts() ): ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="row">
      <div class="col-lg-8 col-12 article">
        <h1 class="article-heading"><?php the_title(); ?></h1>
        <time class="postday" datetime="<?php the_time('Y-m-d'); ?>"><i class="fas fa-pencil-alt"></i> <?php the_time('Y年m月d日'); ?>(更新日：<?php the_modified_date('Y/m/d') ?>)</time>
        <div class="single-img"><?php the_post_thumbnail('full'); ?></div>
        <div class="contents">
        </div>
        <?php the_content(); ?>
      </div>
      <?php get_sidebar('sidebar'); ?>
    <?php endwhile; ?>
    <?php endif; ?>
    </div>
  </div>
</main>
<!--	フッター-->
  <?php get_footer(); ?>
