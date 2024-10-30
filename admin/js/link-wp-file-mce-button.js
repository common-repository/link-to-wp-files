(function(window, $) {

    var privateFileBtn = 'pgl-private-link';
    var informUploadedFile = 'pgl-uploaded-file';
    var attachedFile = {};
    var pml_global = {};

    tinymce.create('tinymce.plugins.link2wp', {
       init: function (ed, url) {
           ed.addButton('link2wp', {
               title: 'Link to file',
               icon: 'fa-external-link',
               onclick: handleInsertProtectedFile
           });
       },
       createControl: function (n, cm) {
          return null;
       },
        getInfo: function () {
            return {
                longname: 'Magic Link for WordPress',
                author: 'buildwps',
                authorurl: 'www.buildwps.com',
                infour: 'www.buildwps.com',
                version: '1.0'
            }
        }
    });

    tinymce.PluginManager.add('link2wp', tinymce.plugins.link2wp);

    function handleInsertProtectedFile(e) {
        e.preventDefault();

        pml_global.custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Media',
            frame: 'select',
            button: {
                text: 'Pick it',
                id: 'pick-link-to-wp-file',
                onclick: function () {
                    console.log('hello');
                }
            },
            multiple: false
        });

        pml_global.custom_uploader.on('select', function () {
            attachedFile = pml_global.custom_uploader.state().get('selection').first().toJSON();
            handleFormSubmit();
        });

        pml_global.custom_uploader.open();
    }

    function handleFormSubmit() {
        if(attachedFile) {
            var content = tinyMCE.activeEditor.selection.getContent() || attachedFile.title;
            var link = '<a target="_blank" ref="noopener noreferrer" href="' + attachedFile.url +'">' + content + ' </a>';
            tinyMCE.activeEditor.selection.setContent(link);
        }
    }

})(window, jQuery);