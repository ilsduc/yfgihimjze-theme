<?php

// doesnt have any effect ...

if (have_posts()) {
  while (have_posts()) {
    the_post();

    if (has_post_thumbnail()) {
      the_post_thumbnail();
    }

    //
    the_title();
    the_content();
  }
}
