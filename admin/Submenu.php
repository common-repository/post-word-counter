<?php
namespace PostWordCounter\Admin;

trait Submenu {

    public function wp_admin_submenu() {
        add_options_page( 
            esc_html__( 'Post Word Counter', 'pwc' ),
            esc_html__( 'Post Word Counter', 'pwc' ),
            'manage_options', 
            'pwc_settings_page', 
            array( $this, 'word_count' ) );
    }

    /**
     * Callback function for setting page. Display the settings page.
     */
    public function word_count() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e( 'Post Word Counter Settings', 'pwc' ); ?></h1>
            <form action="options.php" method="POST">
                <?php
                    settings_fields('pwc_settings');
                    do_settings_sections( 'pwc_settings_page' );
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }

}