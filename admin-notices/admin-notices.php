<?php
/*
Plugin Name: Wpbeirut Admin Notices
Description: Display your own custom admin notices. From Wordpress Beirut Community With Love.
Version: 0.1
Author: WPBeirut
Author URI: https://github.com/wpbeirut
*/

require_once(dirname(__FILE__) . '/plugin-options.php' );
require_once(dirname(__FILE__) . '/dismissible-admin-notices.php' );

class Wpbeirut_Admin_Notices {

    /**
    * Register hooks.
    */
    public function init() {
        //add_action( 'admin_notices', array( $this, 'test_notice' ) );
        //add_action( 'admin_notices', array( $this, 'specific_admin_page' ) );
        //add_action( 'admin_notices', array( $this, 'plugin_admin_notice' ) );
        //add_action( 'admin_notices', array( $this, 'conditional_plugin_admin_notice' ) );
        add_action( 'admin_notices', array( $this, 'custom_admin_notices' ) );
    }

   /**
    * Output custom admin notices.
    */
    public function custom_admin_notices() {
        ?>
		<div class="notice notice-big-error"><p>In 1982, Israel began an invasion across its northern border, seeking to root out elements of the Palestine Liberation Organization. The Israeli military wreaked destruction all the way up to Beirut and forced the P.L.O. out of Lebanon. It also defeated the Syrian Army and, particularly, the Air Force wherever it engaged them.</p></div>
		<div class="notice notice-admin-user-award"><p>I love the Middle East. My earliest childhood memories are of Jerusalem. I love the colors and smells and cadence of Arabic spoken in the streets of Cairo or Beirut. I also love the modernity and verve of Tel Aviv.</p></div>
		<div class="notice notice-light-bulb"><p>A phoenix, Beirut seems to always pull itself out its ashes, reinvents itself, has been conquered numerous times in its 7,000-year history, yet it survives by both becoming whatever its conquerors wished it to be and retaining its idiosyncratic persona..</p></div>
		<div class="notice notice-social-media"><p>Beirut is where I was born and raised.</p></div>
		<div class="notice notice-neo"><p>Beirut turned into a war zone in a matter of hours. We were stuck at home, the roads were blocked.</p></div>
		<?php
    }

    /**
    * Output an admin notice on the plugin options page when settings have been saved.
    */
    public function conditional_plugin_admin_notice() {
        
        $whitelist_admin_pages = array( 'settings_page_admin-notices/plugin-options' );
        $admin_page = get_current_screen();
        $current_user = wp_get_current_user();

        echo "<style>#setting-error-settings_updated { display: none; }</style>";

        if( in_array( $admin_page->base, $whitelist_admin_pages ) && isset($_GET['settings-updated']) &&  $_GET['settings-updated']):
        ?>
        <div class="notice notice-success is-dismissible"><p>Plugin options just saved. <strong><?php echo $current_user->display_name; ?></strong>, you're just so awesome!</p></div>
        <?php
        endif;
    }

    /**
    * Output an admin notice on the plugin options page.
    */
    public function plugin_admin_notice() {

        $whitelist_admin_pages = array( 'settings_page_admin-notices/plugin-options' );
        $admin_page = get_current_screen();

        if( in_array( $admin_page->base, $whitelist_admin_pages ) ) :
        ?>
        <div class="notice notice-info is-dismissible"><p>Welcome to Wordpress Beirut Admin Notices plugin page!</p></div>
        <?php
        endif;
    }

    /**
    * Output an admin notice on a specific admin screen.
    */
    public function specific_admin_page() {

        $whitelist_admin_pages = array( 'settings_page_admin-notices/plugin-options', 'dashboard', 'upload', 'edit-comments' );
        $admin_page = get_current_screen();

        if( in_array( $admin_page->base, $whitelist_admin_pages ) ) :
        ?>
        <div class="notice notice-info is-dismissible"><p>We made it! This is the '<?php echo $admin_page->base; ?>' admin page.</p></div>
        <?php
        else :
        ?>
        <div class="notice notice-error"><p>Not on your nelly! This '<?php echo $admin_page->base; ?>' page isn't on my list.</p></div>
        <?php
        endif;
    }

    /**
    * Output a test admin notice.
    */
    public function test_notice() {
        ?>
		<div class="notice notice-error"><p>When I look back on my childhood, I think of that short time in Beirut. I know that seeing the city collapse around me forced me to grasp something many people miss: the fragility of peace.</p></div>
		<div class="notice notice-warning"><p>Lebanon was at one time known as a nation that rose above sectarian hatred; Beirut was known as the Paris of the Middle East. All of that was blown apart by senseless religious wars, financed and exploited in part by those who sought power and wealth. If women had been in charge, would they have been more sensible? It's a theory.</p></div>
		<div class="notice notice-success"><p>I come from a specific area in Beirut where it's multicultural, and it's a culture that blends with multiple cultures - it's unbelievable lifestyle.</p></div>
		<div class="notice notice-info"><p>Growing up in Beirut, I used to go to the souks with my mother to buy fabrics... I understood fashion at an early age, and my first designs were when I was five.</p></div>
		<div class="notice notice-success is-dismissible"><p>I was actually lost in Beirut on the way home.</p></div>
		<?php
    }
}
 
$wpbeirut_admin_notices = new Wpbeirut_Admin_Notices();
$wpbeirut_admin_notices->init();