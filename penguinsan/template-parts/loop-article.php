<div class="col-12">
  <div class="article-box">
    <div><?php the_category(); ?></div>
    <div class="article-img"><?php the_post_thumbnail('full'); ?></div>
    <div class="article-body">
      <h4 class="article-title"><?php the_title(); ?></h4>
      <time class="postday" datetime="<?php the_time('Y-m-d'); ?>"><i class="fas fa-pen"></i> <?php the_time('Y年m月d日'); ?>
        <?php if(get_the_modified_date('Y/n/j') != get_the_time('Y/n/j')) : ?>
        <i class="fas fa-edit"></i> 更新日：<?php the_modified_date('Y年m月d日') ?>
        <?php endif; ?>
      </time>
      <?php the_excerpt(); ?>
        <div><a href="<?php the_permalink(); ?>" class="article-btn">続きを読む</a></div>
    </div>
  </div>
</div>
