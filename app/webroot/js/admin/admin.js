var editors = [];
$('textarea.editor').each(function(i, el) {
    var id = $(el).attr('id');
    editors[i] = CKEDITOR.replace(id);
    CKFinder.setupCKEditor(editors[i], www_root + 'js/admin/libs/ckfinder/');
});

$('.data').setMask('99/99/9999');
$('.telefone').setMask('(99)9999-9999');
$('.celular').setMask('(99)99999-9999');

$(".pegaSlug").stringToSlug({
    getPut: '.geraSlug'
});