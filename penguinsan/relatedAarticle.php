<?php
$categories = get_the_category($post->ID);
$category_ID = array();
  
foreach($categories as $category){
    array_push($category_ID,$category->cat_ID);
}
  
$posts_number = 8; // 表示したい件数を指定
  
$args = array(
    'post__not_in'=>array($post->ID), // 現在のページの投稿を除外
    'category__in'=>$category_ID, // 現在の投稿のカテゴリーの関連記事を取得
    'order' => 'DESC',
    'orderby' => 'modified',
    'posts_per_page'=>$posts_number, // 表示する件数の指定
);
$wp_query = new WP_Query($args);
  
if($wp_query->have_posts()){ ?>
  <p class="related">関連記事</p>
<div class="row">
<?php
    while($wp_query->have_posts()):$wp_query->the_post();
    ?>
  <div class="col-sm-3"><div class="related-img"><?php the_post_thumbnail('full'); ?></div>
    <div class="related-body">
      <h4 class="related-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    </div>
  </div>
<?php endwhile; ?>
</div>
<?php }
else{
?>
<?php } ?>
