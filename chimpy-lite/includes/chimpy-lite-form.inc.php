<?php
/**
 * Renders signup form
 * 
 * @return void
 */
if (!function_exists('chimpy_lite_form')) {
    function chimpy_lite_form($allowed_forms = array())
    {
        $opt = get_option('chimpy_lite_options', $results);

        // Check if integration is enabled
        if (!$opt || !is_array($opt) || empty($opt) || !isset($opt['chimpy_lite_api_key']) || !$opt['chimpy_lite_api_key']) {
            return;
        }

        // Check if at least one form is defined
        if (!isset($opt['forms']) || empty($opt['forms'])) {
            return;
        }

        $form = ChimpyLite::select_form_by_conditions($opt['forms'], $allowed_forms);

        require_once CHIMPY_LITE_PLUGIN_PATH . '/includes/chimpy-lite-prepare-form.inc.php';

        $html = chimpy_lite_prepare_form($form, $opt, 'shortcode', null, true);

        echo $html;
    }
}

?>