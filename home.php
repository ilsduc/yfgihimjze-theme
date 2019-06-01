<?php
/*
  ** include header
*/
get_header();

$columns = !get_theme_mod('prevent_articles_nb_column_sm')?get_theme_mod('articles_nb_column_sm').' ':'';
$columns .= !get_theme_mod('prevent_articles_nb_column_md')?get_theme_mod('articles_nb_column_md').' ':'';
$columns .= !get_theme_mod('prevent_articles_nb_column_md')?get_theme_mod('articles_nb_column_lg').' ':'';

$class = $columns;

?>

<div class="row">

<?php

/*
  ** displays posts
*/
if (have_posts()) {
  while (have_posts()) {
    ?>

    <div class="<?= $class ?> mt-5">
      <div class="card">
    <?php
    ?>
    <div>
    <?php
    the_post();
    ?>
    </div>
    <?php

    ?>
    <div class="py-2 px-2">
      <?php
      if (has_post_thumbnail()) {
        the_post_thumbnail();
      }
      the_title();
    ?>
    </div>
    <?php
    //
    the_content();
    ?>
      </div>

    </div>

    <?php
  }
}

?>

</div>

<?php
/*
  ** Implementation des custom types
*/
$args = [
  'post_type' => 'cours',
  'posts_per_page' => 10,
];

$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
  the_title();
  echo '<div class="entry-content">';
    the_content();
  echo '</div>';
endwhile;
/*
  ** include sidebar wich is defined in functions.php
*/
dynamic_sidebar('ilsduc-sidebar');
/*
  ** include footer
*/
get_footer();
