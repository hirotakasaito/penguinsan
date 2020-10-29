<div class="search">
  <form action="<?php echo home_url('/'); ?>" method="get" class="form-inline">
    <div class="input-group">
      <input type="text" name="s" placeholder="キーワードを入力" class="form-control" value="<?php the_search_query(); ?>">
      <div class="input-group-append">
        <button class="btn btn-primary" type="submit">検索</button>
      </div>
    </div>
  </form>
</div>