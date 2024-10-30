(function( $) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
	$(function() {
        $("body").on("click", ".select-pda-magic-link-file", function (evt) {
			evt.preventDefault();
			var select_file = wp.media({
                title: "Select file show to widget",
                button: {text: "Select"},
                multiple: true,
            });
			select_file.on('select', function(){
			   var attachments = select_file.state().get('selection').models.map(function(m){
			      return m.toJSON();
               });

                $(".pda-magic-link-widget-title").val("Magic Link");
                $(".pda-magic-link-widget-title").trigger('change');
                $(".attachment-media-view").empty();
                for (var i = 0; i < attachments.length; i++) {
                    $(".attachment-media-view").append('<div class="pda-link-to-wp-file-selected placeholder">'+'Selected File: '+ attachments[i].title+'</div>');
                }
                var title_img = attachments.map(function(t){
                    return t.title;
                })
                $(".pda-magic-link-widget-title-img").val(title_img.join(';'));

                var url_img = attachments.map(function(u){
                    return u.url;
                })
                $(".pda-magic-link-widget-url").val(url_img.join(';'));
                // console.log('58: ',title_img.join(';'));

                $(".select-pda-magic-link-file").html("Replace File");

            });
			select_file.open();

            // var button_id = '#' + $(this).attr('id');
            // var _origin_send_attachment = wp.media.editor.send.attachment;
            // // var btn = $('#select-pda-magic-link-file-btn');
            // // var send_attachment_bkp = wp.media.editor.send.attachment;
            // var _pda_magic_link_custom_media = true;
            //
            // wp.media.editor.send.attachment = function (props, attachment) {
            //     $(".placeholder").html("Selected file: "+attachment.title);
            //     $(".select-pda-magic-link-file").html("Replace File");
            //
            // 	if (_pda_magic_link_custom_media) {
            //         $(".pda-magic-link-widget-title").val("Magic Link");
            //         $(".pda-magic-link-widget-title").trigger('change');
            //
            //         $(".pda-magic-link-widget-url").val(attachment.url);
            //         $(".pda-magic-link-widget-url").trigger('change');
            //
            //         $(".pda-magic-link-widget-title_img").val(attachment.title);
            //         $(".pda-magic-link-widget-title_img").trigger('change');
            //     } else {
            //         return _origin_send_attachment.apply( button_id, [props, attachment] );
				// }
            // }
            // wp.media.editor.open('#select-pda-magic-link-file-btn');
        });
    });

})( jQuery);
