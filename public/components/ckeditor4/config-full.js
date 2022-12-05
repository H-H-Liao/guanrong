var editors = document.querySelectorAll('.ckeditor-full');
for (var i = 0; i < editors.length; ++i) {
    CKEDITOR.replace(editors[i].id, {
        toolbar: [
            // { items: ['Styles']},
            { items: ['FontSize', 'TextColor', 'BGColor'] },
            { items: ['Bold', 'Italic', 'Strike', 'Subscript', 'Superscript'] },
            { items: ['RemoveFormat'] },
            { items: ['NumberedList', 'BulletedList', 'Outdent', 'Indent'] },
            { items: ['Blockquote', 'CreateDiv', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
            { items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { items: ['Link', 'Unlink', 'Anchor'] },
            { items: ['Image', 'Embed', 'Table', 'HorizontalRule', 'SpecialChar'] },
            { items: ['Maximize', 'ShowBlocks', 'Source'] },
            { items: ['Find']}
        ],
        entities: true,
        format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
        allowedContent: true,
        stylesSet: [
            // { name: '黃底線字加粗', element: 'div', attributes: { class: 'slogan underline' } }
            // { name: 'Button 1', element: 'a', attributes: { class: 'btn btn-primary' } },
            // { name: 'Button 2', element: 'a', attributes: { class: 'btn btn-secondary' } },
            // { name: 'Button 1 outline', element: 'a', attributes: { class: 'btn btn-outline-primary' } },
            // { name: 'Button 2 outline', element: 'a', attributes: { class: 'btn btn-outline-secondary' } },
            // { name: 'Link button', element: 'a', attributes: { class: 'btn btn-link' } },

            // { name: 'Alert Success', element: 'div', attributes: { class: 'alert alert-success' } },
            // { name: 'Alert Info', element: 'div', attributes: { class: 'alert alert-info' } },
            // { name: 'Alert Warning', element: 'div', attributes: { class: 'alert alert-warning' } },
            // { name: 'Alert Danger', element: 'div', attributes: { class: 'alert alert-danger' } },

            // { name: 'Small', element: 'small' },

            // { name: 'Typewriter', element: 'tt' },

            // { name: 'Computer Code', element: 'code' },
            // { name: 'Keyboard Phrase', element: 'kbd' },
            // { name: 'Sample Text', element: 'samp' },
            // { name: 'Variable', element: 'var' },

            // { name: 'Deleted Text', element: 'del' },
            // { name: 'Inserted Text', element: 'ins' },

            // { name: 'Cited Work', element: 'cite' },
            // { name: 'Inline Quotation', element: 'q' },

            // { name: 'Language: RTL', element: 'span', attributes: { dir: 'rtl' } },
            // { name: 'Language: LTR', element: 'span', attributes: { dir: 'ltr' } },
        ],
        extraPlugins: 'link,image2,codemirror,panelbutton,embed,justify,showblocks,div,dialogadvtab,font,colorbutton,colordialog,tableresize,tableselection,find,dialog',
        allowedContent: true,
        removePlugins: 'image',
        embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
        extraAllowedContent: 'dl;dt;dd;small',
        bodyClass: 'rich-content' + ' ' + 'editor' + ' ' + editors[i].className.split(" ").filter(text=>text.toLowerCase().indexOf('ckeditor-project'.toLowerCase()) > -1),
        height: '60vh',
        contentsCss: ['/project/css/plugins.css','/project/css/style.css'],
        codemirror: {
            theme: 'twilight',
        },
        fontSize_sizes:'12(網頁最小字體)/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;30/30px;32/32px;34/34px;36/36px;38/38px;40/40px;42/42px;46/46px;48/48px;50/50px;60/60px;72/72px;',
        find_highlight: {
            element: 'span',
            styles: { 'background-color': '#ff0', color: '#00f' }
        },
        language: 'zh',
        filebrowserBrowseUrl: '/admin/files?view=filepicker',
        filebrowserImageBrowseUrl: '/admin/files?type=i&view=filepicker'

    });

    CKEDITOR.on('dialogDefinition', function (event) {
        try {
          var dialogName = event.data.name
          var dialogDefinition = event.data.definition

          if (dialogName === 'table' || dialogName === 'tableProperties') {
            var advancedTab = dialogDefinition.getContents('advanced')
            var infoTab = dialogDefinition.getContents('info')
            var txtWidth = infoTab.get('txtWidth')
            txtWidth.default = '100%'

            var stylesField = advancedTab.get('advStyles')
            stylesField.default = 'width: 100%;'

            var cssClassField = advancedTab.get('advCSSClasses')
            cssClassField.default = 'mod-table table-list-view' // 預設 class
          }
        } catch (exception) {
          window.alert('Error ' + event.message)
        }
      })

    CKEDITOR.on('instanceReady', function (event) {
        var editor = event.editor
        editor.on('change', function (e) {
            var tables = e.editor.document.$.querySelectorAll('table:not(.has-wrapper)')
            if (tables.length > 0) {
            tables.forEach(function (table) {
                table.classList.add('has-wrapper')
                $(table).wrap('<div class="u-overxauto"></div>')
            })
            }
        })
    })
}
