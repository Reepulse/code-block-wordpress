<?php
/**
 * Plugin Name:       Wordpress code block
 * Description:       This plugin is used add a block in editor to format code with highlighting and add line numbers
 * Author:            Reepulse
 * Text Domain:       reepulse-code-snippet
 */
if (!defined('ABSPATH')) {
    exit;
}

define('REEPULSE_VERSION', '1.0.0');
define('REEPULSE_SLUG', 'reepulse-code-snippet');
define('REEPULSE_FULL_NAME', 'Wordpress Code Formatter');
define('REEPULSE_PLUGIN_FILE', __FILE__);
define('REEPULSE_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('REEPULSE_PLUGIN_DIR', plugin_dir_path(__FILE__));

function reepulse_column_block_extend_assets() {
    wp_enqueue_script(
            'reepulse_code_snippet_block_js', plugins_url('blocks/code-snippet/block.js', __FILE__), array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-edit-post'), time(), true);

}

add_action('enqueue_block_assets', 'reepulse_column_block_extend_assets');

function reepulse_code_snippet_scripts() {

    wp_register_script('prism-js', plugins_url('blocks/code-snippet/assets/js/prism.js', __FILE__), array(), true);

    wp_register_style('prism-css', plugins_url('blocks/code-snippet/assets/css/prism.css', __FILE__));

    wp_register_style('prism-line-numbers-css', plugins_url('blocks/code-snippet/assets/css/line-numbers.css', __FILE__));

    wp_register_script('prism-line-numbers', plugins_url('blocks/code-snippet/assets/js/line-numbers.js', __FILE__), array(), true);

    if (!is_admin()) {
        wp_enqueue_script('prism-js');
        wp_enqueue_style('prism-css');
        wp_enqueue_style('prism-line-numbers-css');
        wp_enqueue_script('prism-line-numbers');
    }

}

add_action('enqueue_block_assets', 'reepulse_code_snippet_scripts');

function reepulse_backend_scripts() {
    wp_register_style('reepulse-admin-style', plugins_url('assets/css/admin-style.css', __FILE__));

    wp_enqueue_style('reepulse-admin-style');
}

add_action('enqueue_block_editor_assets', 'reepulse_backend_scripts');

require plugin_dir_path(__FILE__) . 'blocks/code-snippet/render.php';

