(function($, w, e) {

    var partUploaders = [];

    /*
     * Função que troca os pares da string para montar os templates
     */
    var replaceText = function(string, pairs) {
        for (i = 0; i < pairs.length; i++)
            string = string.split('{' + pairs[i][0] + '}').join(pairs[i][1]);
        return string;
    };


    $("body").on('click', '.upload-delete', function() {
        var item = $("#" + $(this).attr("data-target"));
        var status = item.find('.upload-status').val();
        if (status == 'new' && confirm('Deseja realmente excluir este envio?')) {
            item.remove();
        }
        if (status == 'old' && confirm('Deseja marcar este arquivo para exclusão?')) {
            item.find('.upload-status').val('rem');
            item.find('.upload-file').css('opacity', '0.5');
            item.find('.upload-filename').css('text-decoration', 'line-through');
            $(this).remove();
        }
    });


    $("a[rel=upload-button]").each(function() {
        var el = $(this);

        var id = el.attr('data-id');
        var action = el.attr('data-action');
        var folder = el.attr('data-folder');
        var multiple = parseInt(el.attr('data-multiple')) == 1 ? true : false;
        var i = parseInt(el.attr('data-i'));
        var inputName = el.attr('data-input-name');
        var model = el.attr('data-model');
        var field = el.attr('data-field');
        var type = el.attr('data-type');
        var template = type == 'image' ? uploadTemplates.templateItemImage : uploadTemplates.templateItemFile;


        partUploaders[id] = new qq.FineUploaderBasic({
            button: el[0],
            request: {
                endpoint: action,
                params: {model: model, field: field}
            },
            multiple: multiple,
            debug: true,
            callbacks: {
                onSubmit: function(itemId, filename) {
                    console.log('call');
                    if (!multiple) {
                        itemId = 0;
                        $('#' + id + '-preview').html('');
                        $('#' + id + '-button').hide();
                    }
                    else {
                        itemId += i;
                    }

                    $('#' + id + '-preview').append(
                            replaceText(uploadTemplates.templateItemProgress, [['fieldId', id], ['itemId', itemId.toString()], ['file', filename]])
                            );
                },
                onProgress: function(itemId, filename, loaded, total) {
                    if (!multiple) {
                        itemId = 0;
                    }
                    else {
                        itemId += i;
                    }

                    var percent = Math.ceil(loaded / total * 100.0);
                    $('#' + id + '-progress-' + itemId + ' .bar').css('width', percent.toString() + '%');
                },
                onComplete: function(itemId, fileName, response) {
                    if (!multiple) {
                        itemId = 0;
                        $('#' + id + '-button').show().find(".button-label").html("Substituir imagem");
                        inputNameItem = inputName;
                    }
                    else {
                        itemId += i;
                        inputNameItem = inputName.split('[0]').join('[' + itemId + ']');
                    }

                    $('#' + id + '-loading-' + itemId).remove();


                    $('#' + id + '-preview').append(
                            replaceText(template, [
                        ['fieldId', id], ['itemId', itemId.toString()], ['folder', folder],
                        ['image', response['path']], ['imageName', response['filename']], ['inputName', inputNameItem], ['status', 'new'], ['multiple', multiple]
                    ])
                            );
                }
            }
        });
    });




})(jQuery, window, window.event);
