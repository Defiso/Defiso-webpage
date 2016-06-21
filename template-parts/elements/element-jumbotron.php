<div class="jumbotron" <?php if ( get_field('jumbotron_background') ): ?> style="background-image: url('<?php echo get_field('jumbotron_background') ?>')" <?php endif; ?>>
  <div class="inner">
    <div class="content">
      <?php
        the_title('<h1 class="entry-title">','</h1>');
        if ( get_field('jumbotron_description') ) {
          echo '<p>' . get_field('jumbotron_description') . '</p>';
        }
      ?>
    </div>
  </div>
</div>
