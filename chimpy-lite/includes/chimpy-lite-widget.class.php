<?php

/**
 * Chimpy Lite Plugin Widget
 * 
 * @class ChimpyLite_Widget
 * @package ChimpyLite
 * @author RightPress
 */
if (!class_exists('ChimpyLite_Widget')) {
    class ChimpyLite_Widget extends WP_Widget
    {
        /**
         * Widget constructor (registering widget with WP)
         * 
         * @access public
         * @return void
         */
        public function __construct() {
            parent::__construct(
                'chimpy_lite_form',
                __('MailChimp Signup (Chimpy Lite)', 'chimpy-lite'),
                array(
                    'description' => __('Widget displays a signup form, if enabled under MailChimp settings.', 'chimpy-lite'),
                )
            );

            $this->opt = $this->plugin_settings();
        }

        /**
         * Load plugin settings
         * 
         * @access public
         * @return array
         */
        public function plugin_settings()
        {
            $this->settings = chimpy_lite_plugin_settings();

            $results = array();

            // Iterate over settings array and extract values
            foreach ($this->settings as $page => $page_value) {
                foreach ($page_value['children'] as $subpage => $subpage_value) {
                    foreach ($subpage_value['children'] as $section => $section_value) {
                        foreach ($section_value['children'] as $field => $field_value) {
                            if (isset($field_value['default'])) {
                                $results['chimpy_lite_' . $field] = $field_value['default'];
                            }
                        }
                    }
                }
            }

            return array_merge(
                $results,
                get_option('chimpy_lite_options', $results)
            );
        }

        /**
         * Frontend display of widget
         * 
         * @access public
         * @param array $args
         * @param array $instance
         * @return void
         */
        public function widget($args, $instance)
        {
            // Check if integration is enabled
            if (!$this->opt['chimpy_lite_api_key'] || !isset($this->opt['forms']) || empty($this->opt['forms'])) {
                return;
            }

            // Get allowed forms
            $allowed_forms = isset($instance['allowed_forms']) && is_array($instance['allowed_forms']) && !empty($instance['allowed_forms']) ? $instance['allowed_forms'] : array();

            // Select form that match the conditions best
            $form = ChimpyLite::select_form_by_conditions($this->opt['forms'], $allowed_forms);

            if (!$form) {
                return;
            }

            require_once CHIMPY_LITE_PLUGIN_PATH . '/includes/chimpy-lite-prepare-form.inc.php';

            $form_html = chimpy_lite_prepare_form($form, $this->opt, 'widget', $args);

            echo $form_html;
        }

        /**
         * Backend configuration form
         * 
         * @access public
         * @param array $instance
         * @return void
         */
        public function form($instance)
        {
            // Get allowed forms
            $allowed_forms = isset($instance['allowed_forms']) && is_array($instance['allowed_forms']) && !empty($instance['allowed_forms']) ? join(',', $instance['allowed_forms']) : '';

            ?>

            <p>
                <?php printf(__('This widget renders a MailChimp signup form.<br />You can edit your signup form <a href="%s">here</a>.', 'chimpy-lite'), site_url('/wp-admin/admin.php?page=chimpy_lite&tab=forms')); ?>
            </p>

            <?php
        }

        /**
         * Sanitize form values
         * 
         * @access public
         * @param array $new_instance
         * @param array $old_instance
         * @return void
         */
        public function update($new_instance, $old_instance)
        {
            return $old_instance;
        }

    }
}

?>
