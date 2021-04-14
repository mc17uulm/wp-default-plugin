<?php

namespace WPDefault;

use WPDefault\api\APIHandler;
use WPDefault\db\Database;

final class Loader
{

    public function run(string $file) : void {

        if(defined("WP_DEFAULT_DEBUG") && WP_DEFAULT_DEBUG) {
            define( 'WP_DEBUG', true );
            define( 'WP_DEBUG_DISPLAY', true );
            define( 'WP_DEBUG_LOG', true );
        }

        register_activation_hook($file, fn() => Database::initialize());
        register_deactivation_hook($file, fn() => Database::remove());

        load_plugin_textdomain('wp-default-plugin', false, dirname(plugin_basename($file)) . "/languages/");

        add_action('rest_api_init', fn() => APIHandler::run());

    }

    private function register_backend_scripts(string $file) : void {

        $base = defined("WP_DEFAULT_BASE_URL") ? WP_DEFAULT_BASE_URL : "";

            wp_enqueue_script(
                'wp_default_plugin.js',
                "$base/dist/js/wp-default-plugin.js",
                ['wp-i18n'],
                '0.1.0',
                true
            );

            wp_enqueue_style(
                'wp_default_plugin.css',
                "$base/dist/css/wp-default-plugin.css",
                [],
                '0.1.0'
            );

            wp_localize_script(
                'wp_default_plugin.js',
                'wp_default_plugin_definitions',
                [
                    'root' => esc_url_raw(rest_url()),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'slug' => 'wp-default-plugin',
                    'version' => 'v1',
                    'site' => $_GET["page"],
                    'base' => admin_url('admin.php')
                ]
            );

            wp_set_script_translations('wp_default_plugin.js', 'wp-default-plugin', plugin_dir_path($file) . "/languages/");
        }



}