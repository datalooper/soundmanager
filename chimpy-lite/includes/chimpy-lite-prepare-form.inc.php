<?php
/**
 * Returns generated form to be displayed
 * 
 * @param array $form
 * @param array $opt
 * @param string $context
 * @param mixed $widget_args
 * @return string
 */
if (!function_exists('chimpy_lite_prepare_form')) {
    function chimpy_lite_prepare_form($form, $opt, $context, $widget_args = null, $is_function = false)
    {
        $chimpy_lite = ChimpyLite::get_instance();

        // Enqueue JS/CSS files
        // if (!$is_function) {
        //     ChimpyLite::enqueue_frontend_scripts_and_styles();
        // }
        // else {
        //     add_action('wp_footer', array('ChimpyLite', 'print_frontend_scripts_and_styles'));
        // }
        //add_action('wp_enqueue_scripts', array('ChimpyLite', 'enqueue_frontend_scripts_and_styles'));

        $global_form_id = $chimpy_lite->get_next_rendered_form_id();

        // Extract form id and form settings
        reset($form);
        $form_key = key($form);
        $form = array_pop($form);

        // Title
        $title = ($context == 'widget') ? apply_filters('widget_title', $form['title']) : $form['title'];

        // Color scheme class and css override class
        $custom_classes = ($form['color_scheme'] != 'cyan' ? 'sky-form-' . $form['color_scheme'] . ' ' : '') . 'chimpy_lite_custom_css';

        /***********************************************************************
         * VALIDATION RULES & MESSAGES
         */
        $validation_rules = array();
        $validation_messages = array();

        foreach ($form['fields'] as $field) {

            $field_rules = array(
                'required'  => (isset($field['req']) && $field['req'] ? true : false),
                'maxlength' => 200,
            );

            $field_messages = array();

            if (isset($field['req']) && $field['req']) {
                $field_messages['required'] = $opt['chimpy_lite_label_empty_field'];
            }

            // Add type-specific validation rules
            switch ($field['type']) {

                // Email
                case 'email':
                    $field_rules['email'] = true;
                    $field_messages['email'] = $opt['chimpy_lite_label_invalid_format'];
                    break;

                // Text
                case 'text':
                    
                    break;

                // Number
                case 'number':
                    $field_rules['number'] = true;
                    $field_messages['number'] = $opt['chimpy_lite_label_not_number'];
                    break;

                // Radio
                case 'radio':
                    $field_rules['digits'] = true;
                    $field_rules['minlength'] = 1;
                    $field_rules['maxlength'] = 3;
                    break;

                // Dropdown
                case 'dropdown':
                    $field_rules['digits'] = true;
                    $field_rules['minlength'] = 1;
                    $field_rules['maxlength'] = 3;
                    break;

                // Date
                case 'date':
                    $field_rules['pattern'] = ChimpyLite::get_date_pattern('date', $opt['chimpy_lite_date_format'], 'pattern');
                    $field_messages['pattern'] = $opt['chimpy_lite_label_invalid_format'];
                    break;

                // Birthday
                case 'birthday':
                    $field_rules['pattern'] = ChimpyLite::get_date_pattern('birthday', $opt['chimpy_lite_birthday_format'], 'pattern');
                    $field_messages['pattern'] = $opt['chimpy_lite_label_invalid_format'];
                    break;

                // ZIP
                case 'zip':
                    $field_rules['digits'] = true;
                    $field_rules['minlength'] = 4;
                    $field_rules['maxlength'] = 5;
                    $field_messages['digits'] = $opt['chimpy_lite_label_invalid_format'];
                    $field_messages['minlength'] = $opt['chimpy_lite_label_invalid_format'];
                    $field_messages['maxlength'] = $opt['chimpy_lite_label_invalid_format'];
                    break;

                // Phone
                case 'phone':

                    // Check if it's US format
                    if (isset($field['us_phone']) && $field['us_phone']) {
                        $field_rules['phoneUS'] = true;
                        $field_messages['phoneUS'] = $opt['chimpy_lite_label_invalid_format'];
                    }

                    break;

                // URL
                case 'url':
                    $field_rules['url'] = true;
                    break;

                default:
                    break;
            }

            $validation_rules['chimpy_lite_' . $context . '_subscribe[custom][' . $field['tag'] . ']'] = $field_rules;
            $validation_messages['chimpy_lite_' . $context . '_subscribe[custom][' . $field['tag'] . ']'] = $field_messages;
        }

        /***********************************************************************
         * INPUT MASKS
         */
        $masks = array();

        foreach ($form['fields'] as $field) {
            if ($field['type'] == 'date') {
                $masks[] = array(
                    'selector'      => 'chimpy_lite_' . $context . '_field_' . $field['tag'],
                    'template'      => ChimpyLite::get_date_pattern('date', $opt['chimpy_lite_date_format'], 'mask'),
                    'placeholder'   => ChimpyLite::get_date_pattern('date', $opt['chimpy_lite_date_format'], 'placeholder'),
                );
            }
            else if ($field['type'] == 'birthday') {
                $masks[] = array(
                    'selector'      => 'chimpy_lite_' . $context . '_field_' . $field['tag'],
                    'template'      => Chimpy::get_date_pattern('birthday', $opt['chimpy_lite_birthday_format'], 'mask'),
                    'placeholder'   => Chimpy::get_date_pattern('birthday', $opt['chimpy_lite_birthday_format'], 'placeholder'),
                );
            }
            else if ($field['type'] == 'phone' && isset($field['us_phone']) && $field['us_phone']) {
                $masks[] = array(
                    'selector'      => 'chimpy_lite_' . $context . '_field_' . $field['tag'],
                    'template'      => '999-999-9999',
                    'placeholder'   => 'X',
                );
            }
        }

        /***********************************************************************
         * START BUILDING FORM
         */
        $html = '';

        // Ajax URL
        $html .= '<script>'
               . 'var chimpy_lite_ajaxurl = "' . admin_url('admin-ajax.php') . '";'
               . 'var chimpy_lite_max_form_width = ' . (isset($opt['chimpy_lite_width_limit']) && !empty($opt['chimpy_lite_width_limit']) ? (int)$opt['chimpy_lite_width_limit'] : 400) . ';'
               . '</script>';

        // Override CSS
        $html .= '<style>' . $opt['chimpy_lite_css_override'] . '</style>';

        // Container
        $html .= '<div class="chimpy-lite-reset chimpy_lite_' . $context . '_content" style="' . (in_array($context, array('shortcode')) && $opt['chimpy_lite_width_limit'] > 0 ? 'max-width:' . $opt['chimpy_lite_width_limit'] . 'px;' : '') . '">';

        // Before widget (if it's widget)
        if (isset($widget_args['before_widget'])) {
            $html .= $widget_args['before_widget'];
        }

        // Start form
        $html .= '<form id="chimpy_lite_' . $context . '_' . $global_form_id . '" class="chimpy_lite_signup_form sky-form ' . $custom_classes . '">';

        // Form ID
        $html .= '<input type="hidden" name="chimpy_lite_' . $context . '_subscribe[form]" value="' . $form_key . '">';

        // Context
        $html .= '<input type="hidden" id="chimpy_lite_form_context" name="chimpy_lite_' . $context . '_subscribe[context]" value="' . $context . '">';

        // Title
        if (!empty($title)) {
            $html .= '<header>' . $title . '<a href="#" class="exitForm">x</a></header>';
        }

        // White background
        $html .= '<div class="chimpy_lite_status_underlay">';

        // Start fieldset
        $html .= '<fieldset>';

        // Text above form
        if (isset($form['above']) && $form['above'] != '') {
            $html .= '<div class="description">' . $form['above'] . '</div>';
        }

        // Fields
        foreach ($form['fields'] as $field) {
            $html .= '<section>';

            // Radio
            if ($field['type'] == 'radio') {

                $html .= '<label class="label">' . $field['name'] . '</label>';

                foreach ($field['choices'] as $choice_key => $choice) {

                    $html .= '<label class="radio">';

                    $html .= '<input type="radio" '
                           . 'id="chimpy_lite_' . $context . '_field_' . $field['tag'] . '_' . $choice_key . '" '
                           . 'name="chimpy_lite_' . $context . '_subscribe[custom][' . $field['tag'] . ']" '
                           . 'value="' . $choice_key . '" >';

                    $html .= '<i></i>' . $choice . '</label>';

                }

            }

            // Dropdown
            else if ($field['type'] == 'dropdown') {

                $html .= '<label class="label">' . $field['name'] . '</label>';

                $html .= '<label class="select">';

                $html .= '<select '
                       . 'id="chimpy_lite_' . $context . '_field_' . $field['tag'] . '" '
                       . 'name="chimpy_lite_' . $context . '_subscribe[custom][' . $field['tag'] . ']" '
                       . '>';

                // Populate with options
                foreach ($field['choices'] as $choice_key => $choice) {
                    $html .= '<option value="' . $choice_key . '">' . $choice . '</option>';
                }

                $html .= '</select><i></i></label>';

            }

            // Any other field (basic text input)
            else {

                if (!$opt['chimpy_lite_labels_inline']) {
                    $html .= '<label class="label">' . $field['name'] . '</label>';
                }

                $html .= '<label class="input">';

                if (isset($field['icon']) && $field['icon']) {
                    $html .= '<i class="icon-append ' . $field['icon'] . '"></i>';
                }

                $html .= '<input type="text" '
                       . 'id="chimpy_lite_' . $context . '_field_' . $field['tag'] . '" '
                       . 'name="chimpy_lite_' . $context . '_subscribe[custom][' . $field['tag'] . ']" '
                       . ($opt['chimpy_lite_labels_inline'] ? 'placeholder="' . $field['name'] . '"' : '')
                       . '></input>';

                $html .= '</label>';

            }

            $html .= '</section>';
        }

        // Text below form
        if (isset($form['below']) && $form['below'] != '') {
            $html .= '<div class="description">' . $form['below'] . '</div>';
        }

        // End fieldset
        $html .= '</fieldset>';

        // Processing placeholder
        $html .= '<div id="chimpy_lite_signup_' . $context . '_processing" class="chimpy_lite_signup_processing" style="display: none;"></div>';

        // Something went wrong...
        $html .= '<div id="chimpy_lite_signup_' . $context . '_error" class="chimpy_lite_signup_error" style="display: none;"><div></div></div>';

        // Success
        $html .= '<div id="chimpy_lite_signup_' . $context . '_success" class="chimpy_lite_signup_success" style="display: none;"><div></div></div>';

        $html .= '</div>';

        // Start footer
        $html .= '<footer>';

        // Submit button
        $html .= '<button type="button" id="chimpy_lite_' . $context . '_submit" class="button">' . $form['button'] . '</button>';

        // End footer
        $html .= '</footer>';

        // End form
        $html .= '</form>';

        // Form validation rules
        $html .= '<script type="text/javascript">'
               . 'jQuery(function() {'
               . 'jQuery("#chimpy_lite_' . $context . '_' . $global_form_id . '").validate({'
               . 'rules: ' . json_encode($validation_rules) . ','
               . 'messages: ' . json_encode($validation_messages) . ','
               . 'errorPlacement: function(error, element) { error.insertAfter(element.parent()); }'
               . '});';

        if (isset($masks) && !empty($masks)) {
            foreach ($masks as $mask) {
                $html .= 'jQuery("#' . $mask['selector'] . '").mask("' . $mask['template'] . '", {placeholder:"' . $mask['placeholder'] . '"});';
            }
        }

        $html .= '});'
               . '</script>';

        // After widget (if it's widget)
        if (isset($widget_args['after_widget'])) {
            $html .= $widget_args['after_widget'];
        }

        // End container
        $html .= '</div>';

        return $html;
    }
}

?>