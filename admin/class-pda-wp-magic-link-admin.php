<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.buildwps.com/prevent-direct-access-premium-plugin/?utm_source=user-website&utm_medium=pluginpage&utm_campaign=plugin-author-link
 * @since      1.0.0
 *
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pda_Link_To_Wp_File
 * @subpackage Pda_Link_To_Wp_File/admin
 * @author     buildwps <hello@ymese.com>
 */
class Pda_Link_To_Wp_File_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pda_Link_To_Wp_File_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pda_Link_To_Wp_File_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pda-link-to-wp-file-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pda_Link_To_Wp_File_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pda_Link_To_Wp_File_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pda-link-wp-file-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Show admin notice that reminds user to install prevent direct access gold version
     */
	public function pda_wml_admin_notice() {
        if(!Pda_Link_To_Wp_File_Utils::is_gold_pda_activated()) {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php _e ($this->plugin_name) .  _e (sprintf( __(' requires %sPrevent Direct Access%s. Please download and activate it to continue.' , 'pda-wp-magic-link'), '<a href="https://www.buildwps.com/prevent-direct-access-premium-plugin/" title="Prevent Direct Access" target="_blank" ref="noopener noreferrer">', '</a>' )) ?></p>
            </div>
            <?php
        }
    }

    public function add_link_to_wp_button() {
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
            return;
        } else if( get_user_option('rich_editing') == 'true' ) {
            add_filter( 'mce_external_plugins', array( $this, 'magiclink_mce_plugin') );
            add_filter( 'mce_buttons', array( $this, 'register_magiclink_button') );
        }
    }

    public function magiclink_mce_plugin( $plugin_array ) {
	    $plugin_array['link2wp'] = plugins_url( 'admin/js/', dirname(__FILE__) ) . 'link-wp-file-mce-button.js';
	    return $plugin_array;
    }

    public function register_magiclink_button( $buttons ) {
	    array_push( $buttons, "|", 'link2wp' );
	    echo('<div style="display:none"><input type="hidden" id="link2wp-default"/><input type="hidden" id="link2wp-default"/></div>');
	    return $buttons;
    }

    public function link2wp_add_editor_styles( $mce_css ) {

        if ( !empty( $mce_css ) ) {
            $mce_css .= ',';
        }

        $mce_css .= plugin_dir_url( __FILE__ ) . 'css/link2file-wp-editor.css?version' . $this->version;

        return $mce_css;

    }

    public function link2wp_add_option_to_menu() 
    {
        $labels = array(
            'name' => 'All Files',
            'singular_name' => 'Image Name',
            'all_items' => 'All Files',
            'add_new_item' => 'Add New Image',
      	);
		$args = array(
		'labels' => $labels,
		'public' => true,
		'supports' => array('title','editor','author','comments', 'custom-fields', 'trackbacks'),
		);
		register_post_type('attachment',$args);
    }

    public function register_foo_widget() {
        register_widget( 'Foo_Widget' );
    }
    
}

class Foo_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'foo_widget',
            esc_html__( 'Magic link', 'text_domain' ),
            array( 'description' => esc_html__( 'Add magic link to widget', 'text_domain' ), )
        );
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

            $title_img = explode(';',$instance['title_img']);
            $url = explode(';',$instance['url']);
            for ($i = 0; $i < count($url); $i++) {
                ?>
                <a href="<?php echo $url[$i]; ?>"> <?php echo $title_img[$i]; ?> </a></br>
                <?php
            }

        }
//        $url = array_key_exists('url', $instance) ? $instance['url'] : '';
//        $title_img = array_key_exists('title_img', $instance) ? $instance['title_img'] : '';
    }

    public function form( $instance ) {
        $url = ! empty( $instance['url'] ) ? $instance['url'] : '';
        $title_img = ! empty( $instance['title_img'] ) ? $instance['title_img'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
            <input readonly class="pda-magic-link-widget-title widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="Magic Link">

            <input class="pda-magic-link-widget-url widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="hidden" value="<?php echo esc_attr( $url ); ?>">
            <input class="pda-magic-link-widget-title-img widefat" id="<?php echo esc_attr( $this->get_field_id( 'title_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title_img' ) ); ?>" type="hidden" value="<?php echo esc_attr( $title_img ); ?>">

            <div class="media-widget-preview media_image">
                <div class="attachment-media-view">
                    <?php
                    $title_img = array_key_exists('title_img', $instance) ? $instance['title_img'] : '';
                        if ($title_img == null ) {
                            ?><div class="placeholder">No file selected</div><?php
                        }else {
                            $title_img = explode(';',$instance['title_img']);
                            for ($i = 0; $i < count($title_img); $i++) {
                                ?>
                                <div class="pda-link-to-wp-file-selected placeholder"> Selected file: <?php echo $title_img[$i]; ?> </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </p>
        <p class="media-widget-buttons">
            <button type="button" id="select-pda-magic-link-file-btn" class="button select-pda-magic-link-file not-selected">
                <?php
                if ($title_img == null ) {
                    echo "Add File";
                }else {
                    echo "Replace File";
                }
                ?>
            </button>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
        $instance['title_img'] = ( ! empty( $new_instance['title_img'] ) ) ? strip_tags( $new_instance['title_img'] ) : '';
        return $instance;
    }

}
