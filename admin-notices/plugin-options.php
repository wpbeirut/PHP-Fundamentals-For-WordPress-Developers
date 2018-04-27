<?php

class Wpbeirut_Plugin_Options {
 
    protected $plugin_options_page;

    /**
    * Register hooks.
    */
    public function init() {
      add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );
      add_action('admin_menu', array( $this, 'create_admin_menu_page' ) );
      add_action('admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
      add_action('admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }

    public function enqueue_styles() {

      wp_enqueue_style(
        'wpbeirut-admin-notice-css',
        plugin_dir_url( __FILE__ ) . 'css/admin-notices.css'
      );
    }

    public function enqueue_scripts($hook) {

      if( $hook != $this->plugin_options_page ) {
        return;
      }

      wp_enqueue_script(
        'wpbeirut-admin-notice-js',
        plugin_dir_url( __FILE__ ) . 'js/admin-notices.js'
      );
    }

    public function create_admin_menu_page() {

        // Create new top-level menu
        $this->plugin_options_page = add_options_page(
          'Admin Notices',
          'Admin Notices',
          'manage_options',
          __FILE__,
          array( $this, 'render_options_page' )
        );
    }

    public function register_plugin_settings() {
        register_setting( 'admin-notices-plugin-settings', 'text-option' );
    }

    public function render_options_page() {
      ?>
      <div class="wrap">
        <h1>Admin Notices Plugin</h1>

        <form method="post" action="options.php">
          <?php settings_fields( 'admin-notices-plugin-settings' ); ?>
          <?php do_settings_sections( 'admin-notices-plugin-settings' ); ?>
          <table class="form-table">
            <tr valign="top">
              <th scope="row">Enter some text</th>
              <td><input type="text" name="text-option" value="<?php echo esc_attr( get_option( 'text-option' ) ); ?>" /></td>
            </tr>
          </table>    
          <?php submit_button(); ?>
        </form>
      </div>
      <?php
    }
}
 
$wpbeirut_plugin_options = new Wpbeirut_Plugin_Options();
$wpbeirut_plugin_options->init();
