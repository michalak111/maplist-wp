<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 2017-02-02
 * Time: 20:35
 */

function maplist_display_template() {
    ob_start();
    include_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/maplist-public-display.php';
    $output = ob_get_contents();
    ob_end_clean();
    return $output;

}
add_shortcode('maplist', 'maplist_display_template');