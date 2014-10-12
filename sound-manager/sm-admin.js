jQuery(document).ready(function($){
 
 
    var custom_uploader;

    $('.removeArtistLink').click(function(){
        var data = {
            'action': 'remove_artist_link',
            'post_id' : $(this).data('post-id')
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajax_url, data, function(response) {

        });
        $(this).parent().remove();
        return false;
    });

    $('#soundForm').submit(function(e){
        var errorSelector = $('.error'), data = {
                'action': 'createNewSoundSubmit',
                'attachment': $(this).serialize()
                };
                // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                jQuery.post(ajax_object.ajax_url, data, function(response) {
                    if(response != "0"){
                       errorSelector.fadeOut();
                       $(".updated").html("<p>Sound created! Manage Here</p><a href='"+response+ "'>" + response+"</a>" );
                       clearForm();   
                    }
                    else{
                       clearForm();   
                       $(".updated").fadeOut(); 
                       errorSelector.html("<p>Sound could not be created, try again!</p>" );
                       errorSelector.fadeIn();
                    }
                });
        e.preventDefault();

    });
    function clearForm(){
        $("#soundForm").trigger('reset');
        $("#upload_sound").val("");
    }
    $('#create_sounds_button').click(function(e){
        e.preventDefault();
        var errorSelector = $('.error'), data = {
        'action': 'createNewSoundsFromFolderSubmit',
        'soundsUrl':  $('#upload_sound').val()
        };
        jQuery.post(ajax_object.ajax_url, data, function(response) {
            console.log(response);
            if(response != "0"){
                errorSelector.fadeOut();
               $(".updated").html("<p>Sounds created! Manage Here</p>").fadeIn();
               clearForm();   
            }
            else{
               clearForm();   
               $(".updated").fadeOut();
                errorSelector.html("<p>Sound could not be created, try again!</p>" );
                errorSelector.fadeIn();
            }
        });


    });
    $('#upload_sound_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Song File',
            button: {
                text: 'Choose Song'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            postData(attachment.id);
            $('#upload_sound').val(attachment.url);
        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });
    
    function postData(attachment){
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        var data = {
        'action': 'uploader_callback',
        'attachment': attachment      // We pass php values differently!
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajax_url, data, function(response) {
            var response = jQuery.parseJSON(response);

            if(response['title'] != null){
               $("input.soundName").val(response["title"]);
               $("input.artist").val(response["artist"]);
               $("input.album").val(response["album"]);
                $(".error").fadeOut();
                $(".updated").html("<p>Uploader completed successfully, go ahead and create your sound!</p>" );
                $(".updated").fadeIn();
            }
            else{
                $(".updated").fadeOut();
                $(".error").html("<p>Uploader could not create sound based on upload, please try with a valid audio file with id3v2 tags.</p>" );    
                $(".error").fadeIn();            
            }
    });
    }
 
});