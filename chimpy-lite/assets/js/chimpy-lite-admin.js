/**
 * Chimpy Lite Plugin Admin JavaScript
 */
jQuery(document).ready(function() {

    /**
     * Admin hints
     */
    jQuery('form').each(function(){
        jQuery(this).find(':input').each(function(){
            if (typeof chimpy_lite_hints !== 'undefined' && typeof chimpy_lite_hints[jQuery(this).prop('id')] !== 'undefined') {
                jQuery(this).parent().parent().find('th').append('<div class="chimpy_lite_tip" title="' + chimpy_lite_hints[jQuery(this).prop('id')] + '"><i class="fa fa-question"></div>');
            }
        });
        jQuery(this).find(':checkbox').each(function(){
            if (jQuery(this).prop('id').indexOf('_1') !== -1 || jQuery(this).prop('id').indexOf('_administrator') !== -1) {
                if (jQuery(this).prop('id').indexOf('_1') !== -1) {
                    var this_tip_key = jQuery(this).prop('id').replace('_1', '');
                }
                else {
                    var this_tip_key = jQuery(this).prop('id').replace('_administrator', '');
                }

                if (typeof chimpy_lite_hints !== 'undefined' && typeof chimpy_lite_hints[this_tip_key] !== 'undefined') {
                    jQuery(this).parent().parent().parent().parent().find('th').append('<div class="chimpy_lite_tip" title="' + chimpy_lite_hints[this_tip_key] + '"><i class="fa fa-question"></div>');
                }
            }
        });
    });
    jQuery.widget('ui.tooltip', jQuery.ui.tooltip, {
        options: {
            content: function() {
                return jQuery(this).prop('title');
            }
        }
    });
    jQuery('.chimpy_lite_tip').tooltip();

    /**
     * Load service status
     */
    jQuery('#chimpy_lite_api_key').each(function() {
        jQuery(this).parent().parent().after('<tr valign="top"><th scope="row">' + chimpy_lite_label_integration_status + '</th><td><p id="chimpy-lite-status" class="chimpy_lite_loading"><span class="chimpy_lite_loading_icon"></span>' + chimpy_lite_label_connecting_to_mailchimp + '</p></td></tr>');
    });

    jQuery('#chimpy-lite-status').each(function() {
        jQuery.post(
                ajaxurl,
                {
                    'action': 'chimpy_lite_mailchimp_status'
                },
        function(response) {

            try {
                var result = jQuery.parseJSON(response);
            }
            catch (err) {
                jQuery('#chimpy-lite-status').html(chimpy_lite_label_bad_ajax_response);
            }

            if (result) {
                jQuery('#chimpy-lite-status').html(result['message']);
            }
        }
        );
    });

    /**
     * Set up accordion (form management)
     */
    jQuery('#chimpy_lite_forms_list').accordion({
        header: '> div > h4',
        heightStyle: 'content'
    });

    /**
     * Dynamicaly change form title on the accordion handle
     */
    jQuery('.chimpy_lite_forms_title_field').each(function() {
        jQuery(this).keyup(function() {
            jQuery(this).parent().parent().parent().parent().parent().parent().find('.chimpy_lite_forms_title_name').html('- ' + jQuery(this).val());
        });
        jQuery(this).change(function() {
            jQuery(this).parent().parent().parent().parent().parent().parent().find('.chimpy_lite_forms_title_name').html('- ' + jQuery(this).val());
        });
    });

    /**
     * Forms page - lists and groups
     */
    if (jQuery('#chimpy_lite_forms_list').length) {

        // Disable submit button until lists are loaded
        jQuery('#submit').prop('disabled', true);
        jQuery('#submit').prop('title', chimpy_lite_label_still_connecting_to_mailchimp);

        jQuery.post(
                ajaxurl,
                {
                    'action': 'chimpy_lite_get_lists_with_multiple_groups_and_fields',
                    'data': chimpy_lite_selected_lists
                },
        function(response) {

            try {
                var result = jQuery.parseJSON(response);
            }
            catch (err) {
                jQuery('.chimpy_lite_forms_field_list_groups').html(chimpy_lite_label_bad_ajax_response);
                jQuery('.chimpy_lite_forms_field_fields').html(chimpy_lite_label_bad_ajax_response);
            }

            if (result && typeof result['message'] === 'object') {

                /**
                 * Render lists and groups selection
                 */
                var current_field_id = 0;

                jQuery('.chimpy_lite_forms_field_list_groups').each(function() {

                    current_field_id++;

                    var current_selected_list = (typeof chimpy_lite_selected_lists[current_field_id] !== 'undefined' && typeof chimpy_lite_selected_lists[current_field_id]['list'] !== 'undefined' ? chimpy_lite_selected_lists[current_field_id]['list'] : null);

                    // List selection
                    if (typeof result['message']['lists'] === 'object') {
                        var fields = '';

                        for (var prop in result['message']['lists']) {
                            fields += '<option value="' + prop + '" ' + (current_selected_list !== null && current_selected_list === prop ? 'selected="selected"' : '') + '>' + result['message']['lists'][prop] + '</option>';
                        }

                        var field_field = '<select id="chimpy_lite_forms_list_field_' + current_field_id + '" name="chimpy_lite_options[forms][' + current_field_id + '][list_field]" class="chimpy-lite-field chimpy_lite_forms_mailing_list">' + fields + '</select>';
                        var field_html = '<table class="form-table" style="margin-bottom: 0px;"><tbody><tr valign="top"><th scope="row">' + chimpy_lite_label_mailing_list + '</th><td>' + field_field + '</td></tr></tbody></table>';

                        jQuery(this).replaceWith(field_html);

                        // Make it chosen!
                        jQuery('#chimpy_lite_forms_list_field_' + current_field_id).chosen({
                            no_results_text: chimpy_lite_label_no_results_match_list,
                            placeholder_text_single: chimpy_lite_label_select_mailing_list,
                            width: '400px'
                        }).change(function(evt, params) {
                            var current_field_id = jQuery(this).prop('id').replace('chimpy_lite_forms_list_field_', '');
                            chimpy_lite_update_groups_and_tags(current_field_id, params['selected']);
                        });
                    }

                    chimpy_lite_forms_page_hints();

                });

                /**
                 * Render merge fiels selection
                 */
                var current_field_id = 0;

                if (typeof result['message']['merge'] === 'object') {

                    jQuery('.chimpy_lite_forms_field_fields').each(function() {

                        current_field_id++;

                        var current_selected_list = (typeof chimpy_lite_selected_lists[current_field_id] !== 'undefined' && typeof chimpy_lite_selected_lists[current_field_id]['list'] !== 'undefined' ? chimpy_lite_selected_lists[current_field_id]['list'] : null);
                        var current_selected_merge = (typeof chimpy_lite_selected_lists[current_field_id] !== 'undefined' && typeof chimpy_lite_selected_lists[current_field_id]['merge'] !== 'undefined' ? chimpy_lite_selected_lists[current_field_id]['merge'] : null);

                        render_forms_merge_fields_table(current_field_id, current_selected_list, current_selected_merge, result['message']['merge']);
                    });

                }

                /**
                 * Update accordion height
                 */
                jQuery('#chimpy_lite_forms_list').accordion('refresh');

                /**
                 * Enable submit button
                 */
                jQuery('#submit').prop('disabled', false);
                jQuery('#submit').prop('title', '');

            }

        });
    }

    /**
     * Render merge fields table
     */
    function render_forms_merge_fields_table(current_field_id, current_selected_list, current_selected_merge, merge_fields) {

        if (current_selected_list !== null) {
            merge_fields = merge_fields[current_selected_list];
        }
        else {
            merge_fields = [];
        }

        // Generate options
        var field_options = '<option value></option>';

        if (typeof merge_fields === 'object') {
            for (var prop in merge_fields) {
                if (merge_fields.hasOwnProperty(prop)) {
                    field_options += '<option value="' + prop + '">' + merge_fields[prop]['name'] + ' (' + prop + ', ' + merge_fields[prop]['type'] + (merge_fields[prop]['req'] ? ', ' + 'req' : '') + ')</option>';
                }
            }
        }

        // Set up name field depending on page type
        var input_field = '<input type="text" class="chimpy_lite_name_input" name="chimpy_lite_options[forms][' + current_field_id + '][fields][%%%id%%%][name]" id="chimpy_lite_forms_fields_name_' + current_field_id + '_%%%id%%%" value="%%%value%%%" />';

        // Set up list of Font Awesome icons
        var font_awesome_list = '<option value=""></option>';

        if (typeof chimpy_lite_font_awesome_icons === 'object') {
            for (var prop in chimpy_lite_font_awesome_icons) {
                font_awesome_list += '<option value="' + prop + '">' + chimpy_lite_font_awesome_icons[prop] + '</option>';
            }
        }

        // Begin table
        var fields_table = '<table id="chimpy_lite_fields_table_' + current_field_id + '" class="chimpy_lite_fields_table"><thead><tr><th>' + chimpy_lite_label_fields_name + '</th><th>' + chimpy_lite_label_fields_tag + '</th><th>' + chimpy_lite_label_fields_icon + '</th><th></th></tr></thead><tbody>';

        // Table content with preselected options
        if (typeof current_selected_merge === 'object' && current_selected_merge !== null && Object.keys(current_selected_merge).length > 0) {
            for (var prop in current_selected_merge) {
                if (current_selected_merge.hasOwnProperty(prop) && typeof merge_fields[current_selected_merge[prop]['tag']] === 'object') {
                    var this_field = input_field.replace('%%%id%%%', prop);
                    this_field = this_field.replace('%%%id%%%', prop);
                    this_field = this_field.replace('%%%value%%%', current_selected_merge[prop]['name']);
                    fields_table += '<tr class="chimpy_lite_field_row" id="chimpy_lite_field_' + current_field_id + '_' + prop + '"><td>' + this_field + '</td><td><select class="chimpy_lite_tag_select" name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][tag]" id="chimpy_lite_field_tag_' + current_field_id + '_' + prop + '">' + field_options + '</select></td><td><select name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][icon]" id="chimpy_lite_field_icon_' + current_field_id + '_' + prop + '" class="chimpy_lite_fields_icon">' + font_awesome_list + '</select></td><td><button type="button" class="chimpy_lite_remove_field"><i class="fa fa-times"></i></button></td><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][type]" id="chimpy_lite_forms_fields_type_' + current_field_id + '_' + prop + '" value="' + (typeof merge_fields[current_selected_merge[prop]['tag']]['type'] !== 'undefined' ? merge_fields[current_selected_merge[prop]['tag']]['type'] : '') + '" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][req]" id="chimpy_lite_forms_fields_req_' + current_field_id + '_' + prop + '" value="' + (typeof merge_fields[current_selected_merge[prop]['tag']]['req'] !== 'undefined' ? merge_fields[current_selected_merge[prop]['tag']]['req'] : '') + '" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][us_phone]" id="chimpy_lite_forms_fields_us_phone_' + current_field_id + '_' + prop + '" value="' + (typeof merge_fields[current_selected_merge[prop]['tag']]['us_phone'] !== 'undefined' ? merge_fields[current_selected_merge[prop]['tag']]['us_phone'] : '') + '" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][' + prop + '][choices]" id="chimpy_lite_forms_fields_choices_' + current_field_id + '_' + prop + '" value="' + (typeof merge_fields[current_selected_merge[prop]['tag']]['choices'] !== 'undefined' ? merge_fields[current_selected_merge[prop]['tag']]['choices'] : '') + '" /></tr>';
                }
            }
        }

        // Table content with no preselected options
        else {
            var this_field = input_field.replace('%%%id%%%', '1');
            this_field = this_field.replace('%%%id%%%', '1');
            this_field = this_field.replace('%%%value%%%', '');
            fields_table += '<tr class="chimpy_lite_field_row" id="chimpy_lite_field_' + current_field_id + '_1"><td>' + this_field + '</td><td><select class="chimpy_lite_tag_select" name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][tag]" id="chimpy_lite_field_tag_' + current_field_id + '_1">' + field_options + '</select></td><td><select name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][icon]" id="chimpy_lite_field_icon_' + current_field_id + '_1" class="chimpy_lite_fields_icon">' + font_awesome_list + '</select></td><td><button type="button" class="chimpy_lite_remove_field"><i class="fa fa-times"></i></button></td><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][type]" id="chimpy_lite_forms_fields_type_' + current_field_id + '_1" value="" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][req]" id="chimpy_lite_forms_fields_req_' + current_field_id + '_1" value="" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][us_phone]" id="chimpy_lite_forms_fields_us_phone_' + current_field_id + '_1" value="" /><input type="hidden" name="chimpy_lite_options[forms][' + current_field_id + '][fields][1][choices]" id="chimpy_lite_forms_fields_choices_' + current_field_id + '_1" value="" /></tr>';
        }

        // End table
        fields_table += '</tbody><tfoot><tr><td><button type="button" name="chimpy_lite_add_field" id="chimpy_lite_add_field" class="button button-primary" value="' + chimpy_lite_label_add_new + '"><i class="fa fa-plus">&nbsp;&nbsp;' + chimpy_lite_label_add_new + '</i></button></td><td></td><td></td></tr></tfoot></table></div>';

        // Output table
        jQuery('#chimpy_lite_fields_table_' + current_field_id).replaceWith(fields_table);

        // Select preselected options
        if (typeof current_selected_merge === 'object' && current_selected_merge !== null && Object.keys(current_selected_merge).length > 0) {
            for (var prop in current_selected_merge) {
                if (current_selected_merge.hasOwnProperty(prop)) {
                    jQuery('#chimpy_lite_field_tag_' + current_field_id + '_' + prop).find('option[value="' + current_selected_merge[prop]['tag'] + '"]').prop('selected', true);
                    jQuery('#chimpy_lite_field_icon_' + current_field_id + '_' + prop).find('option[value="' + current_selected_merge[prop]['icon'] + '"]').prop('selected', true);
                }
            }
        }

        // Make all select fields chosen
        jQuery('#chimpy_lite_fields_table_' + current_field_id).find('.chimpy_lite_tag_select').each(function() {
            jQuery(this).chosen({
                no_results_text: chimpy_lite_label_no_results_match_tags,
                placeholder_text_single: chimpy_lite_label_select_tag,
                width: '346px'
            }).change(function(evt, params) {

                // Regenerate chosen field
                regenerate_tag_chosen(current_field_id);

                // Pass values to hidden fields
                var full_field_key = jQuery(this).prop('id').replace('chimpy_lite_field_tag', '');
                jQuery('#chimpy_lite_forms_fields_type' + full_field_key).val(merge_fields[params.selected]['type']);
                jQuery('#chimpy_lite_forms_fields_req' + full_field_key).val(merge_fields[params.selected]['req']);
                jQuery('#chimpy_lite_forms_fields_us_phone' + full_field_key).val(merge_fields[params.selected]['us_phone']);
                jQuery('#chimpy_lite_forms_fields_choices' + full_field_key).val(merge_fields[params.selected]['choices']);
            });
        });

        // Regenerate fields (so we make selected fields disabled on other fields)
        regenerate_tag_chosen(current_field_id);

        /**
         * Handle new fields
         */
        jQuery('#chimpy_lite_forms_list_' + current_field_id).find('#chimpy_lite_add_field').each(function() {
            jQuery(this).click(function() {

                var $table = jQuery(this).parent().parent().parent().parent();

                // Get set id and last field id
                var table_last_tr_id = jQuery($table).find('tbody>tr:last').attr('id');
                table_last_tr_id = table_last_tr_id.replace('chimpy_lite_field_', '');
                table_last_tr_id = table_last_tr_id.split('_');

                var current_field_id = table_last_tr_id[0];
                var current_id = table_last_tr_id[1];

                // Remove chosen from last element
                jQuery($table).find('#chimpy_lite_field_tag_' + current_field_id + '_' + current_id).chosen('destroy');

                // Remove chosen from checkout field name
                jQuery($table).find('#chimpy_lite_field_name_' + current_field_id + '_' + current_id).chosen('destroy');

                // Clone row and insert after the last one
                var new_fields_row = jQuery($table).find('tbody>tr:last').clone(true);
                jQuery($table).find('tbody>tr:last').after(new_fields_row);

                jQuery($table).find('tbody>tr:last').each(function() {

                    // Change ids
                    var next_id = parseInt(current_id, 10) + 1;
                    jQuery(this).attr('id', 'chimpy_lite_field_' + current_field_id + '_' + next_id);
                    jQuery(this).find(':input').each(function() {
                        if (jQuery(this).is('input') && jQuery(this).hasClass('chimpy_lite_name_input')) {
                            jQuery(this).attr('id', 'chimpy_lite_forms_fields_name_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][name]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).is('select') && jQuery(this).hasClass('chimpy_lite_tag_select')) {
                            jQuery(this).attr('id', 'chimpy_lite_field_tag_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][tag]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).is('select') && jQuery(this).hasClass('chimpy_lite_fields_icon')) {
                            jQuery(this).attr('id', 'chimpy_lite_field_icon_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][icon]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).prop('id') === 'chimpy_lite_forms_fields_type_' + current_field_id + '_' + current_id) {
                            jQuery(this).attr('id', 'chimpy_lite_forms_fields_type_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][type]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).prop('id') === 'chimpy_lite_forms_fields_req_' + current_field_id + '_' + current_id) {
                            jQuery(this).attr('id', 'chimpy_lite_forms_fields_req_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][req]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).prop('id') === 'chimpy_lite_forms_fields_us_phone_' + current_field_id + '_' + current_id) {
                            jQuery(this).attr('id', 'chimpy_lite_forms_fields_us_phone_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][us_phone]');
                            jQuery(this).val('');
                        }
                        else if (jQuery(this).prop('id') === 'chimpy_lite_forms_fields_choices_' + current_field_id + '_' + current_id) {
                            jQuery(this).attr('id', 'chimpy_lite_forms_fields_choices_' + current_field_id + '_' + next_id);
                            jQuery(this).attr('name', 'chimpy_lite_options[forms][' + current_field_id + '][fields][' + next_id + '][choices]');
                            jQuery(this).val('');
                        }
                    });

                    // Make both tag fields chosen
                    jQuery('#chimpy_lite_field_tag_' + current_field_id + '_' + current_id).chosen({
                        no_results_text: chimpy_lite_label_no_results_match_tags,
                        placeholder_text_single: chimpy_lite_label_select_tag,
                        width: '346px'
                    });
                    jQuery('#chimpy_lite_field_tag_' + current_field_id + '_' + next_id).chosen({
                        no_results_text: chimpy_lite_label_no_results_match_tags,
                        placeholder_text_single: chimpy_lite_label_select_tag,
                        width: '346px'
                    });

                });

                regenerate_tag_chosen(current_field_id);

                return false;

            });
        });

        /**
         * Handle field removal
         */
        jQuery('.chimpy_lite_remove_field').each(function() {
            jQuery(this).click(function() {
                // Do not remove the last set - reset field values instead
                if (jQuery(this).parent().parent().parent().children().length === 1) {
                    jQuery(this).parent().parent().find(':input').each(function() {
                        jQuery(this).val('');
                    });
                }
                else {
                    jQuery(this).parent().parent().remove();
                }


                jQuery('.chimpy_lite_name_select').each(function() {
                    jQuery(this).trigger('chosen:updated');
                });

                regenerate_tag_chosen(current_field_id);
            });
        });

    }

    /**
     * Checkout - regenerate all chosen fields
     */
    function regenerate_tag_chosen(current_field_id) {
        var all_selected = {};

        // Get all selected fields
        jQuery('#chimpy_lite_forms_list_' + current_field_id).find('.chimpy_lite_tag_select').each(function() {
            if (jQuery(this).find(':selected').length > 0 && jQuery(this).find(':selected').val() !== '') {
                all_selected[jQuery(this).prop('id')] = jQuery(this).find(':selected').val();
            }
        });

        // Regenerate chosen fields
        jQuery('#chimpy_lite_forms_list_' + current_field_id).find('.chimpy_lite_tag_select').each(function() {

            if (Object.keys(all_selected).length !== 0) {

                for (var prop in all_selected) {

                    if (prop !== jQuery(this).prop('id')) {

                        // Disable
                        jQuery(this).find('option[value="' + all_selected[prop] + '"]').prop('disabled', true);
                    }

                    // Enable previously disabled values if they are available now
                    jQuery(this).find(':disabled').each(function() {

                        // Check if such disabled property exists within selected properties
                        var option_value = jQuery(this).val();
                        var exists = false;

                        for (var proper in all_selected) {
                            if (all_selected[proper] === option_value) {
                                exists = true;
                                break;
                            }
                        }

                        // Remove if it does not exist
                        if (!exists) {
                            jQuery(this).removeAttr('disabled');
                        }

                    });

                }
            }
            else {
                // Enable all properties on all fields if there's only one left
                jQuery(this).find(':disabled').each(function() {
                    jQuery(this).removeAttr('disabled');
                });
            }

            jQuery(this).trigger('chosen:updated');
        });
    }

    /**
     * Checkout - handle list change
     */
    function chimpy_lite_update_groups_and_tags(current_field_id, list_id) {

        // Replace groups field with loading animation
        var preloader = '<p id="chimpy_lite_forms_groups_' + current_field_id + '" class="chimpy_lite_loading"><span class="chimpy_lite_loading_icon"></span>' + chimpy_lite_label_connecting_to_mailchimp + '</p>';
        jQuery('#chimpy_lite_forms_groups_' + current_field_id).parent().html(preloader);

        // Replace fields section with loading animation
        var preloader = '<div class="chimpy-lite-status" id="chimpy_lite_fields_table_' + current_field_id + '"><p class="chimpy_lite_loading"><span class="chimpy_lite_loading_icon"></span>' + chimpy_lite_label_connecting_to_mailchimp + '</p></div>';
        jQuery('#chimpy_lite_fields_table_' + current_field_id).replaceWith(preloader);

        // Disable submit button until groups and fields are updated
        jQuery('#submit').prop('disabled', true);
        jQuery('#submit').prop('title', chimpy_lite_label_still_connecting_to_mailchimp);

        // Get data
        jQuery.post(
                ajaxurl,
                {
                    'action': 'chimpy_lite_update_groups_and_tags',
                    'data': {'list': list_id}
                },
        function(response) {

            try {
                var result = jQuery.parseJSON(response);
            }
            catch (err) {
                jQuery('.chimpy_lite_loading').html(chimpy_lite_label_bad_ajax_response);
            }

            if (result && typeof result['message'] === 'object') {

                // Render merge fields table
                render_forms_merge_fields_table(current_field_id, list_id, null, result['message']['merge'])

                /**
                 * Enable submit button
                 */
                jQuery('#submit').prop('disabled', false);
                jQuery('#submit').prop('title', '');

            }
        }
        );
    }

    /**
     * Set up forms page hints
     */
    function chimpy_lite_forms_page_hints()
    {
        if (typeof chimpy_lite_forms_hints !== 'undefined') {
            jQuery.each(chimpy_lite_forms_hints, function(index, value) {
                jQuery('form').find('.' + index).each(function() {
                    jQuery(this).parent().parent().find('th').each(function() {
                        if (jQuery(this).find('.chimpy_lite_tip').length === 0) {
                            jQuery(this).append('<div class="chimpy_lite_tip" title="' + value + '"><i class="fa fa-question"></div>');
                        }
                    });
                });
            });
        }
        jQuery.widget('ui.tooltip', jQuery.ui.tooltip, {
            options: {
                content: function() {
                    return jQuery(this).prop('title');
                }
            }
        });
        jQuery('.chimpy_lite_tip').tooltip();
    }

    /**
     * Checkboxes list
     */
    jQuery('#chimpy_lite_checkbox_list').each(function() {
        chimpy_lite_load_single_list_field('checkbox');
    });

    function chimpy_lite_load_single_list_field(context)
    {
        jQuery('#chimpy_lite_' + context + '_list').replaceWith('<p id="chimpy_lite_' + context + '_list" class="chimpy_lite_loading"><span class="chimpy_lite_loading_icon"></span>' + chimpy_lite_label_connecting_to_mailchimp + '</p>');

        jQuery.post(
            ajaxurl,
            {
                'action': 'chimpy_lite_get_lists'
            },
            function(response) {

                try {
                    var result = jQuery.parseJSON(response);
                }
                catch (err) {
                    jQuery('.chimpy_lite_loading').html(chimpy_lite_label_bad_ajax_response);
                }

                if (result && typeof result['message'] === 'object' && typeof result['message']['lists'] === 'object') {
                    var fields = '';

                    for (var prop in result['message']['lists']) {
                        fields += '<option value="' + prop + '" ' + (chimpy_lite_selected_list !== null && chimpy_lite_selected_list === prop ? 'selected="selected"' : '') + '>' + result['message']['lists'][prop] + '</option>';
                    }

                    jQuery('#chimpy_lite_' + context + '_list').replaceWith('<select id="chimpy_lite_' + context + '_list" name="chimpy_lite_options[chimpy_lite_' + context + '_list]" class="chimpy-lite-field">' + fields + '</select>');
                }
            }
        );
    }

});
