<?php

/*
 * Returns configuration for this plugin
 * 
 * @return array
 */
if (!function_exists('chimpy_lite_plugin_settings')) {
    function chimpy_lite_plugin_settings()
    {
        $settings = array(
            'chimpy_lite' => array(
                'title' => __('MailChimp', 'chimpy-lite'),
                'page_title' => __('MailChimp', 'chimpy-lite'),
                'capability' => 'manage_options',
                'slug' => 'chimpy_lite',
                'children' => array(
                    'settings' => array(
                        'title' => __('Settings', 'chimpy-lite'),
                        'icon' => '<i class="fa fa-cogs" style="font-size: 0.8em;"></i>',
                        'children' => array(
                            'integration' => array(
                                'title' => __('Integration', 'chimpy-lite'),
                                'children' => array(
                                    'api_key' => array(
                                        'title' => __('MailChimp API key', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => '',
                                        'validation' => array(
                                            'rule' => 'function',
                                            'empty' => true,
                                        ),
                                        'hint' => __('<p>API key is required for this plugin to communicate with MailChimp servers.</p> <p>To get an API key, login to your MailChimp account and navigate to Account Settings > Extras > API keys.</p>', 'chimpy-lite'),
                                    ),
                                ),
                            ),
                            'general_settings' => array(
                                'title' => __('General Settings', 'chimpy-lite'),
                                'children' => array(
                                    'double_optin' => array(
                                        'title' => __('Require double opt-in', 'chimpy-lite'),
                                        'type' => 'checkbox',
                                        'default' => 1,
                                        'validation' => array(
                                            'rule' => 'bool',
                                            'empty' => false
                                        ),
                                        'hint' => __('<p>Controls whether a double opt-in confirmation message is sent before user is actually subscribed.</p>', 'chimpy-lite'),
                                    ),
                                    'send_welcome' => array(
                                        'title' => __('Send welcome email', 'chimpy-lite'),
                                        'type' => 'checkbox',
                                        'default' => 1,
                                        'validation' => array(
                                            'rule' => 'bool',
                                            'empty' => false
                                        ),
                                        'hint' => __('<p>If double opt-in is disabled and this setting is enabled, MailChimp will send your lists Welcome Email on user subscription. This has no effect if double opt-in is enabled.</p>', 'chimpy-lite'),
                                    ),
                                    'update_existing' => array(
                                        'title' => __('Update existing subscribers', 'chimpy-lite'),
                                        'type' => 'checkbox',
                                        'default' => 1,
                                        'validation' => array(
                                            'rule' => 'bool',
                                            'empty' => false
                                        ),
                                        'hint' => __('<p>Control whether existing subscribers are updated when they fill out the signup form again or error is displayed. This has no effect for Sync functionality.</p>', 'chimpy-lite'),
                                    ),
                                ),
                            ),
                            'settings_styling' => array(
                                'title' => __('Form Styling', 'chimpy-lite'),
                                'children' => array(
                                    'labels_inline' => array(
                                        'title' => __('Display field labels inline', 'chimpy-lite'),
                                        'type' => 'checkbox',
                                        'default' => 1,
                                        'validation' => array(
                                            'rule' => 'bool',
                                            'empty' => false
                                        ),
                                        'hint' => __('<p>Controls whether signup form field labels are displayed inside fields as value placeholders (inline) or above fields.</p>', 'chimpy-lite'),
                                    ),
                                    'width_limit' => array(
                                        'title' => __('Max form width in pixels', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => '',
                                        'validation' => array(
                                            'rule' => 'number',
                                            'empty' => true,
                                        ),
                                        'hint' => __('<p>If your website features a wide layout, you may wish to set the max width for the form to look better.</p>', 'chimpy-lite'),
                                    ),
                                    'css_override' => array(
                                        'title' => __('Override CSS', 'chimpy-lite'),
                                        'type' => 'textarea',
                                        'default' => '.chimpy_lite_custom_css {}',
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                        'hint' => __('<p>You can further customize the appearance of your signup forms by adding custom CSS to this field. To make changes to the style, simply use CSS class chimpy_lite_custom_css as a basis.</p>', 'chimpy-lite'),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'forms' => array(
                        'title' => __('Forms', 'chimpy-lite'),
                        'icon' => '<i class="fa fa-edit" style="font-size: 0.8em;"></i>',
                        'children' => array(
                            'forms' => array(
                                'title' => __('Manage Signup Forms', 'chimpy-lite'),
                                'children' => array(
                                ),
                            ),
                        ),
                    ),
                    'checkboxes' => array(
                        'title' => __('Checkbox', 'chimpy-lite'),
                        'icon' => '<i class="fa fa-check-square-o" style="font-size: 0.8em;"></i>',
                        'children' => array(
                            'checkboxes_settings' => array(
                                'title' => __('Display Checkbox Below Forms', 'chimpy-lite'),
                                'children' => array(
                                    'checkbox_add_to' => array(
                                        'title' => __('Add signup checkbox to', 'chimpy-lite'),
                                        'type' => 'checkbox_set',
                                        'default' => array(),
                                        'validation' => array(
                                            'rule' => 'multiple_any',
                                            'empty' => true
                                        ),
                                        'values' => array(
                                            '1' => __('Registration Form', 'chimpy-lite'),
                                            '2' => __('Comments Form', 'chimpy-lite'),
                                        ),
                                        'hint' => __('<p>Select WordPress forms where you would like mailing list opt-in checkbox to appear.</p>', 'chimpy-lite'),
                                    ),
                                    'checkbox_label' => array(
                                        'title' => __('Checkbox label', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Subscribe to our newsletter', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                        'hint' => __('<p>Label to display next to the checkbox.</p>', 'chimpy-lite'),
                                    ),
                                    'checkbox_state' => array(
                                        'title' => __('Default state', 'chimpy-lite'),
                                        'type' => 'dropdown',
                                        'default' => 0,
                                        'validation' => array(
                                            'rule' => 'option',
                                            'empty' => false
                                        ),
                                        'values' => array(
                                            '0' => __('Not Checked', 'chimpy-lite'),
                                            '1' => __('Checked', 'chimpy-lite'),
                                        ),
                                        'hint' => __('<p>Default checkbox state.</p>', 'chimpy-lite'),
                                    ),
                                    'checkbox_list' => array(
                                        'title' => __('Mailing list', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => '',
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                        'hint' => __('<p>Select one of your MailChimp mailing lists to subscribe visitors to.</p> <p>To save additional fields, create merge tags FNAME, LNAME, ROLE and USERNAME under your list settings in MailChimp.</p>', 'chimpy-lite'),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'localization' => array(
                        'title' => __('Localization', 'chimpy-lite'),
                        'icon' => '<i class="fa fa-font" style="font-size: 0.8em;"></i>',
                        'children' => array(
                            'localization' => array(
                                'title' => __('Date Format', 'chimpy-lite'),
                                'children' => array(
                                    'date_format' => array(
                                        'title' => __('Date field format', 'chimpy-lite'),
                                        'type' => 'dropdown',
                                        'default' => 0,
                                        'validation' => array(
                                            'rule' => 'option',
                                            'empty' => false
                                        ),
                                        'values' => array(
                                            '0' => __('dd/mm/yyyy', 'chimpy-lite'),
                                            '1' => __('dd-mm-yyyy', 'chimpy-lite'),
                                            '2' => __('dd.mm.yyyy', 'chimpy-lite'),
                                            '3' => __('mm/dd/yyyy', 'chimpy-lite'),
                                            '4' => __('mm-dd-yyyy', 'chimpy-lite'),
                                            '5' => __('mm.dd.yyyy', 'chimpy-lite'),
                                            '6' => __('yyyy/mm/dd', 'chimpy-lite'),
                                            '7' => __('yyyy-mm-dd', 'chimpy-lite'),
                                            '8' => __('yyyy.mm.dd', 'chimpy-lite'),
                                            '9' => __('dd/mm/yy', 'chimpy-lite'),
                                            '10' => __('dd-mm-yy', 'chimpy-lite'),
                                            '11' => __('dd.mm.yy', 'chimpy-lite'),
                                            '12' => __('mm/dd/yy', 'chimpy-lite'),
                                            '13' => __('mm-dd-yy', 'chimpy-lite'),
                                            '14' => __('mm.dd.yy', 'chimpy-lite'),
                                            '15' => __('yy/mm/dd', 'chimpy-lite'),
                                            '16' => __('yy-mm-dd', 'chimpy-lite'),
                                            '17' => __('yy.mm.dd', 'chimpy-lite'),
                                        ),
                                    ),
                                    'birthday_format' => array(
                                        'title' => __('Birthday field format', 'chimpy-lite'),
                                        'type' => 'dropdown',
                                        'default' => 0,
                                        'validation' => array(
                                            'rule' => 'option',
                                            'empty' => false
                                        ),
                                        'values' => array(
                                            '0' => __('dd/mm', 'chimpy-lite'),
                                            '1' => __('dd-mm', 'chimpy-lite'),
                                            '2' => __('dd.mm', 'chimpy-lite'),
                                            '3' => __('mm/dd', 'chimpy-lite'),
                                            '4' => __('mm-dd', 'chimpy-lite'),
                                            '5' => __('mm.dd', 'chimpy-lite'),
                                        ),
                                    ),
                                ),
                            ),
                            'labels_settings' => array(
                                'title' => __('Labels', 'chimpy-lite'),
                                'children' => array(
                                    'label_success' => array(
                                        'title' => __('Subscribed successfully', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Thank you for signing up!', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                    'label_empty_field' => array(
                                        'title' => __('(Error) Required field empty', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Please enter a value', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                    'label_invalid_format' => array(
                                        'title' => __('(Error) Invalid format', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Invalid format', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                    'label_not_number' => array(
                                        'title' => __('(Error) Value not a number', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Please enter a valid number', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                    'label_already_subscribed' => array(
                                        'title' => __('(Error) Already subscribed', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('You are already subscribed to this list', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                    'label_error' => array(
                                        'title' => __('(Error) Unknown error', 'chimpy-lite'),
                                        'type' => 'text',
                                        'default' => __('Unknown error. Please try again later.', 'chimpy-lite'),
                                        'validation' => array(
                                            'rule' => 'string',
                                            'empty' => true
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'pro' => array(
                        'title' => '<i class="fa fa-star" style="font-size: 0.8em;"></i> GET PRO <i class="fa fa-star" style="font-size: 0.8em;"></i>',
                        'icon' => '',
                        'children' => array(
                            'pro_display' => array(
                                'title' => __('Displaying Forms', 'chimpy-lite'),
                                'children' => array(
                                ),
                            ),
                            'pro_contact' => array(
                                'title' => __('Get In Touch', 'chimpy-lite'),
                                'children' => array(
                                ),
                            ),
                        ),
                    ),
                    'help' => array(
                        'title' => '',
                        'icon' => '<i class="fa fa-question" style="font-size: 1em;"></i>',
                        'children' => array(
                            'help_display' => array(
                                'title' => __('Displaying Forms', 'chimpy-lite'),
                                'children' => array(
                                ),
                            ),
                            'help_pro' => array(
                                'title' => __('Get Pro', 'chimpy-lite'),
                                'children' => array(
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );

        return $settings;
    }
}

?>