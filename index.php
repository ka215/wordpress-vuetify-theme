<?php
/**
 * Base Template
 */
?><!DOCTYPE html>
<html <?php language_attributes() ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <?php wp_head() ?>
  </head>
  <body <?php body_class() ?>>
    <noscript>
      <strong><?php _e( "We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.", 'wpvt' ) ?></strong>
    </noscript>
    <div id="app"></div>
    <?php wp_footer() ?>
  </body>
</html>