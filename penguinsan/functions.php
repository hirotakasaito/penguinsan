<?php 

//ウィジット
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');

if(function_exists('register_sidebar')){
  register_sidebar(array(
	 'name' => 'サイドバー',
	 'id' => 'sidebar' ,
	 'before_widget' => '<div class="side-box">',
	 'after_widget' => '</div>',
	 'before_title' => '<p class="box-title">',
	 'after_title' => '</p>'
  ));
}


if(function_exists('register_sidebar')){
  register_sidebar(array(
	 'name' => 'フッター上部',
	 'id' => 'footer' ,
	 'before_widget' => '<div class="footer-box">',
	 'after_widget' => '</div>',
	 'before_title' => '<p class="footer-title">',
	 'after_title' => '</p>'
  ));
}

if(function_exists('register_sidebar')){
  register_sidebar(array(
	 'name' => 'フッター下部',
	 'id' => 'footer-bottom' ,
	 'before_widget' => '<div class="footer-box">',
	 'after_widget' => '</div>',
	 'before_title' => '<p class="footer-title">',
	 'after_title' => '</p>'
  ));
}

if(function_exists('register_sidebar')){
  register_sidebar(array(
	 'name' => 'ヘッダー下部',
	 'id' => 'header-bottom' ,
	 'before_widget' => '',
	 'after_widget' => '',
	 'before_title' => '',
	 'after_title' => ''
  ));
}
function add_files() {
	// WordPress本体のjquery.jsを読み込まない
	wp_deregister_script('jquery');
}

add_action( 'wp_enqueue_scripts', 'add_files' );
//予約投稿の際のバク対策
function get_mtime($format) {
	$mtime = get_the_modified_time('Ymd');
	 $ptime = get_the_time('Ymd');
	if ($ptime > $mtime) {
		return get_the_time($format);
	} elseif ($ptime === $mtime) {
		return null;
	} else {
		return get_the_modified_time($format);
	}
}

//exceptの文字数
function twpp_change_excerpt_length( $length ) {
  return 50; 
}
add_filter( 'excerpt_length', 'twpp_change_excerpt_length', 999 );


function twpp_change_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'twpp_change_excerpt_more' );

//パンくずリスト

function breadcrumb() {
    $home = '<li><a href="'.get_bloginfo('url').'" >HOME</a></li>';
  
    echo '<ul>';
    if ( is_front_page() ) {
        // トップページの場合
    }
    else if ( is_category() ) {
        // カテゴリページの場合
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        echo $home;
        foreach($cat_list as $value){
            echo $value;
        }
        the_archive_title('<li>', '</li>');
    }
    else if ( is_archive() ) {
    // 月別アーカイブ・タグページの場合
    echo $home;
    the_archive_title('<li>', '</li>');
    }
    else if ( is_single() ) {
    // 投稿ページの場合
    $cat = get_the_category();
        if( isset($cat[0]->cat_ID) ) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        foreach($cat_list as $value){
            echo $value;
        }
        the_title('<li>', '</li>');
    }
    else if( is_page() ) {
    // 固定ページの場合
    echo $home;
    the_title('<li>', '</li>');
    }
    else if( is_search() ) {
    // 検索ページの場合
    echo $home;
    echo '<li>「'.get_search_query().'」の検索結果</li>';
    }
    else if( is_404() ) {
    // 404ページの場合
    echo $home;
    echo '<li>ページが見つかりません</li>';
    }
    echo "</ul>";
}
 
// アーカイブの余計なタイトルを削除
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_month() ) {
        $title = single_month_title( '', false );
    }
    return $title;
});

function pagination($pages = '', $range = 1)
{
     $showitems = ($range * 2)+1;  
  
     global $paged;
     if(empty($paged)) $paged = 1;
  
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
  
     if(1 != $pages)
     {
         echo "
<div class=\"container03\">
<ul class=\"pager01\">";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
  
         for ($i=1; $i <= $pages; $i++) { if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "
<li class=\"current\"><a>".$i."</a></li>
 
":"
<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>
 
";
             }
         }
  
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</ul>
</div>
 
\n";
     }
}

//目次

function fit_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
// radio/select
function fit_sanitize_select( $input, $setting ) {
 $input = sanitize_key( $input );
    $choices = $setting->manager->get_control($setting->id)->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
// number limit
function fit_sanitize_number_range( $number, $setting ) {
    $number = absint( $number );
    $atts = $setting->manager->get_control( $setting->id )->input_attrs;
    $min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
    $max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
    $step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
    return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
 
 
  
//////////////////////////////////////////////////
//投稿ページ各種設定画面
//////////////////////////////////////////////////
function fit_post_cutomizer( $wp_customize ) {
// セクション
 $wp_customize->add_section( 'fit_post_section', array(
 'title'     => '目次の設定',
 'priority'  => 1,
 ));
  
 
 
 
 // 目次の表示/非表示 セッティング
 $wp_customize->add_setting( 'fit_post_outline', array(
 'default'   => 'value1',
 'type' => 'option',
 'sanitize_callback' => 'fit_sanitize_select',
 ));
 // 目次の表示/非表示 コントロール
 $wp_customize->add_control( 'fit_post_outline', array(
 'section'   => 'fit_post_section',
 'settings'  => 'fit_post_outline',
 'label'     => '■目次の表示/非表示',
 'description' => '投稿ページに目次を表示するか選択<br>
 (記事内の最初のhタグの手前に自動で挿入されます。※[outline]ショートコードで好きな位置に表示可能)',
 'type'      => 'select',
 'choices'   => array(
 'value1' => '表示する(default)',
 'value2' => '表示しない',
 ),
 ));
 
 // 目次を表示するための最小見出し数 セッティング
 $wp_customize->add_setting( 'fit_post_outline_number', array(
 'default'   => '1',
 'type' => 'option',
 'sanitize_callback' => 'fit_sanitize_number_range',
 ));
 // 目次を表示するための最小見出し数 コントロール
 $wp_customize->add_control( 'fit_post_outline_number', array(
 'section'   => 'fit_post_section',
 'settings'  => 'fit_post_outline_number',
 'description' => '目次を表示するための最小見出し数を指定',
 'type'      => 'number',
 'input_attrs' => array(
         'step'     => '1',
         'min'      => '1',
         'max'      => '50',
     ),
 ));
 
 
}
add_action( 'customize_register', 'fit_post_cutomizer' );
 
 
//////////////////////////////////////////////////
//目次の表示/非表示、個別選択設定
//////////////////////////////////////////////////
if ( get_option('fit_post_outline') != 'value2') {
 function add_outline_fields() {
 //add_meta_box(表示される入力ボックスのHTMLのID, ラベル, 表示する内容を作成する関数名, 投稿タイプ, 表示方法)
 add_meta_box( 'outline_setting', '目次の個別非表示設定', 'insert_outline_fields', 'post', 'normal');
 }
 add_action('admin_menu', 'add_outline_fields');
 
 
 // カスタムフィールドの入力エリア
 function insert_outline_fields() {
 global $post;
 
 if( get_post_meta($post->ID,'outline_none',true) == "1" ) {
 $outline_none_check = "checked";
 }else {
 $outline_none_check = "";
 }
 
 echo '
 <div style="margin:20px 0; overflow: hidden; line-height:2;">
    <div style="float:left;width:120px;">目次の表示設定</div>
    <div style="float:right;width:calc(100% - 140px);">
      <input type="checkbox" name="outline_none" value="1" '.$outline_none_check.' >:この投稿では目次を非表示にしますか？
    </div>
    <div style="clear:both;"></div>
 </div>
 ';
 
 }
 
 // カスタムフィールドの値を保存
 function save_outline_fields( $post_id ) {
 if(!empty($_POST['outline_none'])){
 update_post_meta($post_id, 'outline_none', $_POST['outline_none'] );
 }else{
 delete_post_meta($post_id, 'outline_none');
 }
 
 }
 add_action('save_post', 'save_outline_fields');
}
 
//オリジナル目次を作成
function get_outline_info($content) {
 // 目次のHTMLを入れる変数を定義します。
 $outline = '';
 // h1?h6タグの個数を入れる変数を定義します。
 $counter = 0;
    // 記事内のh1?h6タグを検索します。(idやclass属性も含むように改良)
    if (preg_match_all('/<h([1-4])[^>]*>(.*?)<\/h\1>/', $content, $matches,  PREG_SET_ORDER)) {
        // 記事内で使われているh1?h6タグの中の、1?6の中の一番小さな数字を取得します。
        // ※以降ソースの中にある、levelという単語は1?6のことを表します。
        $min_level = min(array_map(function($m) { return $m[1]; }, $matches));
        // スタート時のlevelを決定します。
        // ※このレベルが上がる毎に、<ul></li>タグが追加されていきます。
        $current_level = $min_level - 1;
        // 各レベルの出現数を格納する配列を定義します。
        $sub_levels = array('1' => 0, '2' => 0, '3' => 0, '4' => 0);
        // 記事内で見つかった、hタグの数だけループします。
        foreach ($matches as $m) {
            $level = $m[1];  // 見つかったhタグのlevelを取得します。
            $text = $m[2];  // 見つかったhタグの、タグの中身を取得します。
            // li, ulタグを閉じる処理です。2ループ目以降に中に入る可能性があります。
            // 例えば、前回処理したのがh3タグで、今回出現したのがh2タグの場合、
            // h3タグ用のulを閉じて、h2タグに備えます。
            while ($current_level > $level) {
                $current_level--;
                $outline .= '</li></ul>';
            }
            // 同じlevelの場合、liタグを閉じ、新しく開きます。
            if ($current_level == $level) {
                $outline .= '</li><li class="outline__item">';
            } else {
                // 同じlevelでない場合は、ul, liタグを追加していきます。
                // 例えば、前回処理したのがh2タグで、今回出現したのがh3タグの場合、
                // h3タグのためにulを追加します。
                while ($current_level < $level) {
                    $current_level++;
                    $outline .= sprintf('<ul class="outline__list outline__list-%s"><li class="outline__item">', $current_level);
                }
                // 見出しのレベルが変わった場合は、現在のレベル以下の出現回数をリセットします。
                for ($idx = $current_level + 0; $idx < count($sub_levels); $idx++) {
                    $sub_levels[$idx] = 0;
                }
            }
            // 各レベルの出現数を格納する配列を更新します。
            $sub_levels[$current_level]++;
            // 現在処理中のhタグの、パスを入れる配列を定義します。
            // 例えば、h2 -> h3 -> h3タグと進んでいる場合は、
            // level_fullpathはarray(1, 2)のようになります。
            // ※level_fullpath[0]の1は、1番目のh2タグの直下に入っていることを表します。
            // ※level_fullpath[1]の2は、2番目のh3を表します。
            $level_fullpath = array();
            for ($idx = $min_level; $idx <= $level; $idx++) {
                $level_fullpath[] = $sub_levels[$idx];
            }
            $target_anchor = 'outline__' . implode('_', $level_fullpath);
 
            // 目次に、<a href="#outline_1_2">1.2 見出し</a>のような形式で見出しを追加します。
            $outline .= sprintf('<a class="outline__link" href="#%s"><span class="outline__number" style="display:none;">%s.</span> %s</a>', $target_anchor, implode('.', $level_fullpath), strip_tags($text));
            // 本文中の見出し本体を、<h3>見出し</h3>を<h3 id="outline_1_2">見出し</h3>
            // のような形式で置き換えます。
            $hid = preg_replace('/<h([1-6])/', '<h\1 id="' .$target_anchor . '"', $m[0]);
            $content = str_replace($m[0], $hid, $content);
 
        }
        // hタグのループが終了後、閉じられていないulタグを閉じていきます。
        while ($current_level >= $min_level) {
            $outline .= '</li></ul>';
            $current_level--;
        }
        // h1?h6タグの個数
        $counter = count($matches);
    }
    return array('content' => $content, 'outline' => $outline, 'count' => $counter);
}
 
//目次を作成します。
function add_outline($content) {
 
    // 目次を表示するために必要な見出しの数
 if(get_option('fit_post_outline_number')){
 $number = get_option('fit_post_outline_number');
 }else{
 $number = 1;
 }
    // 目次関連の情報を取得します。
    $outline_info = get_outline_info($content);
    $content = $outline_info['content'];
    $outline = $outline_info['outline'];
    $count = $outline_info['count'];
 if (get_option('fit_post_outline_close') ) {
 $close = "";
 }else{
 $close = "checked";
 }
    if ($outline != '' && $count >= $number) {
        // 目次を装飾します。
        $decorated_outline = sprintf('
 <div class="outline">
   <span class="outline__title">目次</span>

   %s
 </div>', $outline);
        // カスタマイザーで目次を非表示にする以外が選択された時＆個別非表示が1以外の時に目次を追加します。
 if ( get_option('fit_post_outline') != 'value2' && get_post_meta(get_the_ID(), 'outline_none', true) != '1' && is_single() ) {
         $shortcode_outline = '[outline]';
         if (strpos($content, $shortcode_outline) !== false) {
             // 記事内にショートコードがある場合、ショートコードを目次で置換します。
             $content = str_replace($shortcode_outline, $decorated_outline, $content);
         } else if (preg_match('/<h[1-6].*>/', $content, $matches, PREG_OFFSET_CAPTURE)) {
             // 最初のhタグの前に目次を追加します。
             $pos = $matches[0][1];
             $content = substr($content, 0, $pos) . $decorated_outline . substr($content, $pos);
         }
 }
    }
 return $content;
}
add_filter('the_content', 'add_outline');
 
function override_mce_options( $init_array ) {
    global $allowedposttags;
 
    $init_array['valid_elements']          = '*[*]';
    $init_array['extended_valid_elements'] = '*[*]';
    $init_array['valid_children']          = '+a[' . implode( '|', array_keys( $allowedposttags ) ) . ']';
    $init_array['indent']                  = true;
    $init_array['wpautop']                 = false;
 
    return $init_array;
}
 
add_filter( 'tiny_mce_before_init', 'override_mce_options' );
?>
