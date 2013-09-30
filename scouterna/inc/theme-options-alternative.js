jQuery(document).ready(function($) {

	// Uploading files
	var file_frame,
		button_id, 
		button, 
		id, 
		parent;
	
	  jQuery('.custom_media_upload').live('click', function( event ){
	
      		button_id = '#' + event.target.id, 
			button = $(button_id), 
			id = button.attr('id').replace('_button', ''), 
			parent = $(this).closest('p'); 
				
	    // If the media frame already exists, reopen it.
	    if ( file_frame ) {
	      file_frame.open();
	      return;
	    }
	
	    // Create the media frame.
	    file_frame = wp.media.frames.file_frame = wp.media({
	      title: theme_options_alternative_strings.select_image,
	      button: {
	        text: theme_options_alternative_strings.insert_image,
	      },
	      multiple: false  // Set to true to allow multiple files to be selected
	    });
	
	    // When an image is selected, run a callback.
	    file_frame.on( 'select', function() {
	      
	      var attachment = file_frame.state().get('selection').first().toJSON(),
	      	custom_media_image = parent.find('.custom_media_image'), 
			custom_media_url = parent.find('.custom_media_url'), 
			custom_media_id = parent.find('.custom_media_id');	
	     	
			$(custom_media_id).val(attachment.id);
			$(custom_media_url).val(attachment.url);
			$(custom_media_image).attr('src', attachment.url).css('display', 'block');
			
	    });
	
	    // Finally, open the modal
	    file_frame.open();
	    
	    event.preventDefault();
	    
	  });
	  
	  jQuery('.custom_media_remove').live('click', function( event ){
	
      		button_id = '#' + event.target.id, 
			button = $(button_id), 
			id = button.attr('id').replace('_removebutton', ''), 
			parent = $(this).closest('p'); 
			
	      	custom_media_image = parent.find('.custom_media_image'), 
			custom_media_url = parent.find('.custom_media_url'), 
			custom_media_id = parent.find('.custom_media_id');	
	     	
			$(custom_media_id).val('');
			$(custom_media_url).val('');
			$(custom_media_image).attr('src', '').css('display', 'none');
	    
	  });

}); 