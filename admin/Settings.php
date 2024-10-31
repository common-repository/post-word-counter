<?php
namespace PostWordCounter\Admin;

trait Settings {
    public function wp_admin_settings() {
        add_settings_section( 
            'pwc_general_section', 
            null, 
            null, 
            'pwc_settings_page' 
        );

        // Display location
        add_settings_field( 
            'pwc_location', 
            esc_html__( 'Display Location', 'pwc' ),
            array( $this, 'location_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_location'
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_location', 
            array( 
                'sanitize_callback' => array( $this, 'sanitize_location' ), 
                'default'           => '0'
            ) 
        );

        // Headline
        add_settings_field( 
            'pwc_headline', 
            esc_html__( 'Heading Text', 'pwc' ),
            array( $this, 'text_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_headline',
                'default'   => esc_html__( 'Information', 'pwc' ),
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_headline', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => esc_html__( 'Information', 'pwc' )
            ) 
        );

        // WordCount
        add_settings_field( 
            'pwc_word_count', 
            esc_html__( 'Word Count', 'pwc' ),
            array( $this, 'checkbox_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_word_count',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_word_count', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => '1'
            ) 
        );

        // Filter word
        add_settings_field( 
                'pwc_word_filter', 
                esc_html__( 'Word Filter', 'pwc' ), 
                array( $this, 'word_filter_field_output' ),
                'pwc_settings_page', 
                'pwc_general_section', 
                array(
                    'label_for' => 'pwc_word_filter',
                ) 
        );

        register_setting( 
            'pwc_settings', 
            'pwc_word_filter', 
            array( 
                'sanitize_callback' => 'sanitize_textarea_field', 
                'default'           => ''
            ) 
        );

        // Word counter prefix
        add_settings_field( 
            'pwc_word_counter_prefix', 
            esc_html__( 'Word Counter Prefix', 'pwc' ), 
            array( $this, 'text_field_output' ),
            'pwc_settings_page', 
            'pwc_general_section', 
            array(
                'label_for' => 'pwc_word_counter_prefix',
                'default'   => __( 'Words:', 'pwc' ),
            ) 
        );

        register_setting( 
            'pwc_settings', 
            'pwc_word_counter_prefix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field',
                'default'           => __( 'Words:', 'pwc' ),
            ) 
        );

        // Word counter postfix
        add_settings_field( 
            'pwc_word_counter_postfix', 
            esc_html__( 'Word Counter Postfix', 'pwc' ), 
            array( $this, 'text_field_output' ),
            'pwc_settings_page', 
            'pwc_general_section', 
            array(
                'label_for' => 'pwc_word_counter_postfix',
                'default'   => '',
            ) 
        );

        register_setting( 
            'pwc_settings', 
            'pwc_word_counter_postfix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field',
                'default'           => '',
            ) 
        );

        // Character Count
        add_settings_field( 
            'pwc_character_count', 
            esc_html__( 'Character Count', 'pwc' ),
            array( $this, 'checkbox_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_character_count',
                'default'   => '1',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_character_count', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => '1',
            ) 
        );

        // Character counter prefix
        add_settings_field( 
            'pwc_character_counter_prefix', 
            esc_html__( 'Character counter prefix', 'pwc' ),
            array( $this, 'text_field_output' ), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_character_counter_prefix',
                'default'   => __( 'Characters:', 'pwc' ),
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_character_counter_prefix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => __( 'Characters:', 'pwc' ),
            ) 
        );

        // Character counter postfix
        add_settings_field( 
            'pwc_character_counter_postfix', 
            esc_html__( 'Character counter postfix', 'pwc' ),
            array( $this, 'text_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_character_counter_postfix',
                'default'   => '',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_character_counter_postfix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => '',
            ) 
        );

        // Read Time
        add_settings_field( 
            'pwc_read_time', 
            esc_html__( 'Read Time', 'pwc' ), 
            array( $this, 'checkbox_field_output' ), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_read_time',
                'default'   => '1',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_read_time', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => '1',
            ) 
        );

        // Read time per minute
        add_settings_field( 
            'pwc_read_time_per_minute', 
            esc_html__( 'Read time per minute', 'pwc' ), 
            array( $this, 'read_time_per_minute_field_output' ), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_read_time_per_minute',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_read_time_per_minute', 
            array( 
                'sanitize_callback' => array( $this, 'sanitize_read_time_per_minute_field' ), 
                'default'           => '225'
            ) 
        );

        // Reading time prefix
        add_settings_field( 
            'pwc_read_time_prefix', 
            esc_html__( 'Reading time prefix', 'pwc' ),
            array( $this, 'text_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_read_time_prefix',
                'default'   => __( 'Reading time:', 'pwc' ),
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_read_time_prefix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => __( 'Reading time:', 'pwc' ),
            ) 
        );

        // Reading time prefix
        add_settings_field( 
            'pwc_read_time_postfix', 
            esc_html__( 'Reading time prefix', 'pwc' ),
            array( $this, 'text_field_output'), 
            'pwc_settings_page', 
            'pwc_general_section',
            array(
                'label_for' => 'pwc_read_time_postfix',
                'default'   => '',
            )
        );

        register_setting( 
            'pwc_settings', 
            'pwc_read_time_postfix', 
            array( 
                'sanitize_callback' => 'sanitize_text_field', 
                'default'           => '',
            ) 
        );
    }

    /**
     * Location field's output in setting page
     * @param array $args
     */
    public function location_field_output( $args ) { ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" name="<?php echo esc_attr( $args['label_for'] ); ?>">
            <option value="0" <?php selected( get_option( 'pwc_location' ), '0' ); ?>><?php esc_html_e( 'Beginning of post', 'pwc' ); ?></option>
            <option value="1" <?php selected( get_option( 'pwc_location' ), '1' ); ?>><?php esc_html_e( 'End of post', 'pwc' ); ?></option>
        </select>
    <?php }

    /**
     * Sanitize location select field. Throw error if location value change outside the select field.
     * @param string $input
     */
    public function sanitize_location( $input ) {
        if ( '0' !== $input AND '1' !== $input ) {
          add_settings_error( 'pwc_location', 'pwc_location_error', esc_html__( 'Display Location value must me Beginning the post or End of post', 'pwc' ) );
          return get_option( 'pwc_location' );
        }
        return $input;
    }


    /*
    * Checkbox field's output in setting page
    * @param array $args
    */
    public function checkbox_field_output( $args ) { ?>
        <input type="checkbox" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="1" <?php checked( get_option( $args['label_for'] ), '1' ); ?> />
    <?php }

    /*
    * Word filter field's output in setting page
    * @param array $args
    */
    public function word_filter_field_output( $args ) { ?>
        <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" class="large-text" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo esc_attr( get_option( 'pwc_word_filter', '' ) ); ?>"><?php echo esc_html( get_option( 'pwc_word_filter', '' ) ); ?></textarea>
        <p><?php esc_html_e( 'These words statistics will not include in word counter statistics. Use line break for multiple word.', 'pwc' ); ?></p>
    <?php }

    /**
     * Read Time field's output in setting page
     * @param array $args
     */
    public function read_time_per_minute_field_output( $args ) { ?>
        <input type="number" step="1" min="1" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="small-text" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo esc_attr( get_option( 'pwc_read_time_per_minute', '225' ) ); ?>" />
    <?php }

    /**
     * Sanitize read time per minute number field. Throw error if read time per minute has no input value.
     * @param string $input
     */
    public function sanitize_read_time_per_minute_field( $input ) {
        if ( ! is_numeric( $input ) ) {
            add_settings_error( 'pwc_read_time_per_minute', 'pwc_read_time_per_minute_error', esc_html__( 'Per minute reading time must be 1 or more.', 'pwc' ) );
          return get_option( 'pwc_read_time_per_minute' );
        }
        return $input;
    }

    /**
     * Text input field_output
     * @param array $args
     */
    public function text_field_output( $args ) { ?>
        <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="regular-text" name="<?php echo esc_attr( $args['label_for'] ); ?>" value="<?php echo esc_html( get_option( $args['label_for'] ), $args['default'] ); ?>" />
    <?php }
}