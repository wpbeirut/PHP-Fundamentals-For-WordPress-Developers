<?php

class Wpbeirut_Dismissible_Admin_Notices {

    public $counter_limit = 5;
    public $counter_reset = false;

    public function init() {
        //register_activation_hook(  plugin_dir_path( __FILE__ ) . 'admin-notices.php', array( $this, 'set_admin_notice_transient' ) );
        //add_action( 'admin_notices', array( &$this, 'display_admin_notice' ) );
        //$this->reset_counter_check();
        //add_action( 'admin_notices', array( $this, 'dismiss_admin_notice' ) );
        //add_action( 'wp_ajax_display_dismissible_admin_notice', array( &$this, 'display_dismissible_admin_notice' ) );
        //register_activation_hook(  plugin_dir_path( __FILE__ ) . 'admin-notices.php', array( $this, 'create_custom_option' ) );
        //add_action( 'admin_notices', array( $this, 'install_plugin_to_dismiss_admin_notice' ) );
    }

    public function install_plugin_to_dismiss_admin_notice() {

        $required_plugins = array(
            'Hello Dolly' => 'hello-dolly/hello.php',
            'Akismet' => 'akismet/akismet.php'
        );

        $requires_activating = array();
        foreach( $required_plugins as $required_plugin_name => $required_plugin_path  ) {
            if( ! is_plugin_active( $required_plugin_path ) ) {
                array_push( $requires_activating, $required_plugin_name );
            }
        }

        if ( ! empty( $requires_activating ) ) :
        ?>
        <div class="notice notice-error">
            <p>Please install and activate the following plugins: <strong><?php echo join( ", ", $requires_activating );?></strong>.</p>
        </div>
        <?php
        endif;
    }

    public function create_custom_option() {
        update_option( 'wpbeirut-dismiss', true );
    }

    public function display_dismissible_admin_notice() {
        update_option( 'wpbeirut-dismiss', false );
		wp_die();
    }
    
    public function dismiss_admin_notice() {

        $whitelist_admin_pages = array( 'settings_page_admin-notices/plugin-options' );
        $admin_page = get_current_screen();
        $display_status = get_option( 'wpbeirut-dismiss' );

        if( in_array( $admin_page->base, $whitelist_admin_pages ) && $display_status  ) :
            ?>
            <div id="an1" class="updated notice is-dismissible">
                <p>Dismiss me, if you can. Ha ha ha!</p>
            </div>
            <?php
        endif;
    }

    public function reset_counter_check() {
        if( !$this->counter_reset ) {
            add_action( 'admin_notices', array( &$this, 'display_admin_notice_counter' ) );
        } else {
            delete_option( 'admin_notice_counter' );
            ?>
            <div class="notice notice-warning">
                <p>Admin notice counter has been reset! Change <code>$counter_reset</code> to <code>false</code> to start the admin notice counter again.</p>
            </div>
            <?php    
        }
    }

    public function display_admin_notice_counter() {

        $counter = get_option( 'admin_notice_counter', 1 );
        if( $counter > $this->counter_limit ) {
            return;
        } else if( $counter == $this->counter_limit ) {
            $extra_message = " It's time to say goodbye now.";
        }
        ?>
        <div class="notice notice-info">
            <p>This admin notice has been displayed <?php echo $counter; ?> time(s).<?php echo $extra_message; ?></p>
        </div>
        <?php
        update_option( 'admin_notice_counter', ++$counter );
    }

	public function set_admin_notice_transient() {
        set_transient( 'admin-notice-transient', true, 5 );
    }

    public function display_admin_notice() {

        $current_user = wp_get_current_user();
        $whitelist_admin_pages = array( 'plugins' );
        $admin_page = get_current_screen();

        if( in_array( $admin_page->base, $whitelist_admin_pages ) && get_transient( 'admin-notice-transient' ) ) :
            ?>
            <div class="updated notice">
                <p>The <strong>Admin Notices</strong> plugin was just activated. Thanks for your support <?php echo $current_user->display_name; ?>!</p>
            </div>
            <?php
            delete_transient( 'admin-notice-transient' );            
        endif;
    }
}

$wpbeirut_dismissible_admin_notices = new wpbeirut_Dismissible_Admin_Notices();
$wpbeirut_dismissible_admin_notices->init();