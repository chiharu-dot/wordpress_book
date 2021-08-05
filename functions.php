<?php
add_theme_support('title-tag');
add_filter('document_title_parts','my_document_title_parts');
function my_document_title_parts($title){
  if(is_home()) {
    unset($title['tagline']);
    $title['title']='BISTRO CALMEは、カジュアルなワインバーよりなビストロです。';
  }
  return $title;
}
add_theme_support('post-thumbnails');

/**
 * カスタムメニュー機能を有効にする。（メニューの項目を設定するため）
 */
add_theme_support('menus');

add_filter('comment_form_default_fields','my_comment_form_default_fields');
function my_comment_form_default_fields($args){
 $args['author']=''; //名前を削除
 $args['email']='';  //メールアドレスを削除
 $args['url']='';  //サイトを削除
  return $args;
}

add_action('wp','my_wpautop');
function my_wpautop(){
  if(is_page('contact')){
    remove_filter('the_content','wpautop');
  }
}

add_action('pre_get_posts','my_pre_get_posts');
function my_pre_get_posts($query){
  if(is_admin() || ! $query->is_main_query()){
    return;    //admin(管理画面)とメインクエリ以外にはpre_get_postsが
               //働かないようにしている
  }

  if($query->is_home()){
    $query->set('posts_per_page',3);
    return;//トップページの場合だったら投稿数が３つになるように
  }
}
?>
