<?php

add_theme_support( 'title-tag' );

define( 'DIST_DIR_PATH', get_template_directory() . '/dist' );
define( 'DIST_DIR_URL', get_template_directory_uri() . '/dist' );

function get_assets( $search_path, $extension = null ) {
    $assets = [];
    if ( ! empty( $search_path ) && is_dir( $search_path ) ) {
        if ( $dh = opendir( $search_path ) ) {
            while ( ( $file = readdir( $dh ) ) !== false ) {
                if ( filetype( $search_path .'/'. $file ) !== 'dir' ) {
                    $finfo = new \SplFileInfo( $search_path .'/'. $file );
                    $_ext = $finfo->getExtension();
                    if ( empty( $extension ) || $_ext === strtolower( $extension ) ) {
                        $assets[] = [ 'filename' => $finfo->getFilename(), 'extension' => $_ext ];
                    }
                }
            }
            closedir( $dh );
        }
    }
    return $assets;
}

add_action( 'wp_enqueue_scripts', function() {
    // Enqueue Styles
    wp_enqueue_style( 'font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900', [], null );
    wp_enqueue_style( 'md-icons', 'https://cdn.jsdelivr.net/npm/@mdi/font@latest/css/materialdesignicons.min.css', [], null );
    if ( ! empty( $css_files = get_assets( DIST_DIR_PATH . '/css', 'css' ) ) ) {
        $handle_name = 'chunk-vendors';
        foreach( preg_grep( "@{$handle_name}@", array_column( $css_files, 'filename' ) ) as $_filename ) {
            wp_enqueue_style( $handle_name, DIST_DIR_URL .'/css/'. $_filename, [], null );
        }
    }
    
    // Enqueue Scrips
    if ( ! empty( $js_files = get_assets( DIST_DIR_PATH . '/js', 'js' ) ) ) {
        $handle_name = 'chunk-vendors';
        foreach( preg_grep( "@(chunk-vendors|app)@", array_column( $js_files, 'filename' ) ) as $_filename ) {
            $handle_name = substr( $_filename, 0, strpos( $_filename, '.', 0 ) );
            $depend = $handle_name === 'app' ? [ 'chunk-vendors' ] : [];
            wp_enqueue_script( $handle_name, DIST_DIR_URL .'/js/'. $_filename, $depend, null, true );
        }
    }

});