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
        <time class="postday single-postday" datetime="<?php the_time('Y-m-d'); ?>"><i class="fas fa-pen"></i> <?php the_time('Y年m月d日'); ?>
          <?php if(get_the_modified_date('Y/n/j') != get_the_time('Y/n/j')) : ?>
          <i class="fas fa-edit"></i> 更新日：<?php the_modified_date('Y年m月d日') ?>
          <?php endif; ?>
        </time>
        <div class="single-img"><?php the_post_thumbnail('full'); ?></div>
        <?php get_template_part('sns'); ?>
        <div class="single-text">
          <?php the_content(); ?>
        </div>
        <?php get_template_part('sns'); ?>

      </div>
      <?php get_sidebar('sidebar'); ?>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php get_template_part('relatedAarticle'); ?>
  </div>
</main>
<!--	フッター-->
<?php get_footer(); ?>
