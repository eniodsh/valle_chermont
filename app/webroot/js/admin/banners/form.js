$(document).on('ready', function() {

    // executa dhtml no formulario
    AdminBannersForm.execute('#BannerAdminForm');
});

/**
 * Contem funcoes para utilizar HTML dinamico, usando jQuery para manipular o DOM do formulario.
 */
var AdminBannersForm = new function() {

    var form;

    /**
     * Essa função recebe o formulario como parametro e modifica o DOM aplicando regras definidas.
     * As regras representam requisitos de negocio e usabilidade da funcionalidade.
     *
     * @param form
     * @return void|boolean Pode retornar false em caso de erros
     */
    this.execute = function(form) {

        // identifica o form
        if (typeof form === "string") {
            // tenta selecionar usando jQuery
            form = $(form);
        }

        // valida o parametro
        if ( (typeof form === "undefined") || !(form instanceof jQuery) || !(form.length)) {
            console.warn("Impossible to identify form parameter as a jQuery instance. Returning...");
            return false;
        }

        // define o elemento "form" na classe
        AdminBannersForm.form = form;

        // adiciona e executa as regras
        AdminBannersForm.addFieldValidade();
    };

    /**
     * Adiciona o campo "validade" ao formulario. A disponibilidade dos campos data_inicio e data_fim muda de acordo
     * com o status desse campo.
     */
    this.addFieldValidade = function() {

        // declara a marcacao para o campo validade
        var fieldValidateMarkup = '<div class="control-group">' +
            '<label class="control-label" for="validade">Validade</label>' +
            '<div class="controls">' +
            '<label class="checkbox">' +
            '<input type="checkbox" id="validade" name="data[Banner][indeterminado]">Intederminado' +
            '</label>' +
            '</div>' +
            '</div>';

        // procura o container de campos data
        var validade = $(AdminBannersForm.form).find(".validade");

        // adiciona o campo validade
        validade.before(fieldValidateMarkup);

        var fieldIndeterminado = $(AdminBannersForm.form).find("#validade");

        fieldIndeterminado.on("change", function(event) {
            var checked = $(event.target).prop("checked");
            
            if ( checked ) {
                validade.find("input").prop("disabled", true);
            } else {
                validade.find("input").prop("disabled", false);
            }
        });

        fieldIndeterminado.prop("checked", true).trigger("change");

        // verifica se as datas estao preenchidas
        if ($("[name='data[Banner][data_inicio]']").val() && $("[name='data[Banner][data_fim]']").val()) {
            fieldIndeterminado.prop("checked", false).trigger("change");
        }
    }
};

