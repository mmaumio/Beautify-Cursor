(function($){
	// Color Picker
	$('.xr-color-field').wpColorPicker();

	// Image Upload
	$('.xr-upload-button').click(function(e) {
        e.preventDefault();

        var custom_uploader = wp.media({
            title: 'Custom Image',
            button: {
                text: 'Upload Image'
            },
            multiple: false  // Set this to true to allow multiple files to be selected
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.xr-image-prev').attr('src', attachment.url);
            $('.xr-upload-field').val(attachment.url);

        })
        .open();
    });

}(jQuery));