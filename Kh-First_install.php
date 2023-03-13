<?php

/**
 * Plugin Name: KH-custom-bootstrap
 * Plugin URI: https://example.com
 * Description: A custom plugin for adding  Bootstrap to your WordPress site.
 * Version: 1.0.0
 * Author: John Doe
 * Author URI: https://KHalid.com
 */



 class KH_Custom_Plugin {
    public function __construct() {
      register_activation_hook( __FILE__, array( $this, 'activate' ) );
    
        add_action( 'admin_menu', array( $this, 'my_plugin_menu' ) );
        add_action('wp_enqueue_scripts', array( $this,'my_plugin_scripts'));
        add_action('admin_init', array( $this,'my_plugin_settings'));


     
    }
  
    public function activate() {
      // code here
    }
  


  //Enqueue 
  function my_plugin_scripts() {
    if (get_option('bootstrap_css')) {
        wp_enqueue_style('bootstrap4',plugin_dir_url(__FILE__). 'assets/bootstrap/bootstrap.min.css');
    }
    if (get_option('bootstrap_js')) {
        wp_enqueue_script('boot1', plugin_dir_url(__FILE__). 'assets/bootstrap/bootstrap.min.js');
        // ...
    }
}

function my_plugin_menu() {
    add_options_page('Bootstrap', 'My Plugin', 'manage_options', 'my-plugin', array( $this,'my_plugin_options'));
}

function my_plugin_options() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>
    <div class="wrap">
        <h2>Choose which Bootstrap files to include</h2>
        <form method="post" action="options.php">
            <?php settings_fields('my-plugin-settings-group'); ?>
            <?php do_settings_sections('my-plugin-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Bootstrap files to enqueue:</th>
                    <td>
                        <input type="checkbox" name="bootstrap_css" value="1" <?php checked(get_option('bootstrap_css'), 1); ?> /> CSS<br />
                        <input type="checkbox" name="bootstrap_js" value="1" <?php checked(get_option('bootstrap_js'), 1); ?> /> JS<br />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function my_plugin_settings() {
    register_setting('my-plugin-settings-group', 'bootstrap_css');
    register_setting('my-plugin-settings-group', 'bootstrap_js');
}

 }
$cllass = new KH_Custom_Plugin();
