  <style>
    footer {
      background: <?= get_theme_mod('footer_bg_color'); ?>
    }

  </style>

    </div>
    <?php wp_footer(); ?>
    <footer>
      <?php
        wp_nav_menu(['theme_location' => 'footer_menu']);
      ?>
    </footer>
  </body>
</html>
