/**
 * Chimpy Lite Plugin Frontend JavaScript
 */


function bindMailChimp() {
    jQuery('.chimpy_lite_signup_form').each(function () {

        var chimpy_lite_button = jQuery(this).find('button');
        var chimpy_lite_context = jQuery(this).find('#chimpy_lite_form_context').val();

        chimpy_lite_button.click(function () {
            chimpy_lite_process_mailchimp_signup(jQuery(this), chimpy_lite_context);
        });

        jQuery(this).find('input[type="text"], input[type="email"]').each(function () {
            jQuery(this).keydown(function (e) {
                if (e.keyCode === 13) {
                    chimpy_lite_process_mailchimp_signup(chimpy_lite_button, chimpy_lite_context);
                }
            });
        });
    });
}

/**
 * MailChimp signup
 */
function chimpy_lite_process_mailchimp_signup(button, context)
{
    if (button.parent().parent().valid()) {

        button.parent().parent().find('fieldset').fadeOut(function() {

            var  this_form = jQuery(this).parent();
            this_form.find('#chimpy_lite_signup_'+context+'_processing').fadeIn();
            button.prop('disabled', true);

            jQuery.post(
                chimpy_lite_ajaxurl,
                {
                    'action': 'chimpy_lite_subscribe',
                    'data': button.parent().parent().serialize()
                },
                function(response) {
                    var result = jQuery.parseJSON(response);

                    // Remove progress scene and display message
                    this_form.find('#chimpy_lite_signup_'+context+'_processing').fadeOut(function() {
                        if (result['error'] == 1) {
                            this_form.find('#chimpy_lite_signup_'+context+'_error').children().html(result['message']);
                            this_form.find('#chimpy_lite_signup_'+context+'_error').fadeIn();
                        }
                        else {
                            this_form.find('#chimpy_lite_signup_'+context+'_success').children().html(result['message']);
                            this_form.find('#chimpy_lite_signup_'+context+'_success').fadeIn();
                        }
                    });
                }
            );
        });
    }
}
jQuery(document).ready(function() {

    /**
     * Handle form submit
     */
    bindMailChimp();



});
