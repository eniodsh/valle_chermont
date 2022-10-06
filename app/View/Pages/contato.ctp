<section id="banner_interno">
  <?php echo $this->Html->image('img_banner_interno2.jpg', array('alt' => __(""))) ?>
</section>

<section id="box_institucional">
  <div class="central">
    <div class="col_12 conteudo_text" style="padding-bottom: 0;">
        
      <h2 style="margin-bottom: 0;">FALE CONOSCO<br><span></span></h2>

    </div>
  </div>
</section>

<section id="contato">
    <div class="central">
        <div class="box_contato">
            <p>Sua opinião é fundamental para que possamos avaliar nosso trabalho e direcionar nossas ações.
            <br />
            Se você tem sugestões, elogios, críticas ou reclamações sobre qualquer uma de nossas atividades, por favor, fale conosco. </p>

            <form>
                <div class="col_12">
                    <?php echo $this->Form->input("nome", array("type" => "text", "label" => "Nome:", 'class' => 'obrigatorio', 'required' => true)) ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input('estado_id', array("label" => "Estado",'empty'=>' - Selecione um estado - ','id'=>'estado' )); ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input('cidade_id', array("label" => "Cidade",'empty'=>' - Selecione um estado - '  ,'id'=>'cidade')); ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input("email", array("type" => "text", "label" => "E-mail:", 'class' => 'C_email obrigatorio', 'required' => true)) ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input("telefone", array("type" => "text", "label" => "Telefone:", 'class' => 'obrigatorio')) ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input("celular", array("type" => "text", "label" => "Celular:")) ?>
                </div>
                <div class="col_4">
                    <?php echo $this->Form->input("profissao", array("type" => "text", "label" => "Profissão:", 'class' => 'obrigatorio')) ?>
                </div>
                <div class="col_12">
                    <?php echo $this->Form->input("mensagem", array("type" => "textarea", "label" => "Mensagem:", 'class' => 'obrigatorio', 'required' => true)) ?>
                </div>

                <input type="submit" value="Enviar" class="btn1" />
                <br clear="all" />
            </form>

        </div>

    </div>
    <br clear="all" />
    <br clear="all" />
</section>