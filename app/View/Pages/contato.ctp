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
            Se você tem sugestões, elogios, críticas ou reclamações sobre qualquer uma de nossas atividades, por favor, fale conosco. 

            </p><br><br>

            <div class="col_4">
                <strong>Encarregada pelo tratamento dos dados pessoais:</strong><br>
                Bárbara Lobo Chermont Brasil Vasconcellos<br>
                lgpd@vallechermont.com.br

                <br><br>
                <strong>ENDEREÇO/LOCALIZAÇÃO/CONTATOS</strong><br>
                Praça Saldanha Marinho nº 42 - Campina - 66015-360 - Belém/PA
                <br><br>

                <strong>Telefones:</strong><br>
                (91) 3242-6339/ 3241-0262 /3241-2423/ 3241-8057<br>
                (91) 99131-6440 - WhatsApp<br>
                <br>
                <br>

                <strong>SETORES/E-MAILS:</strong><br>
                INSTITUCIONAL:<br>
                vallechermont@vallechermont.com.br
                <br><br>

                RECEPÇÃO/RTD:<br>
                rtd@vallechermont.com.br<br>
                (91) 3242-6339 / (91) 3241-0262<br>
                <br>

                PESSOAS JURÍDICAS:<br>
                analise1@vallechermont.com.br - Associações<br>
                analise2@vallechermont.com.br - Sociedades<br>
                analise3@vallechermont.com.br
                <br><br>

                NOTIFICAÇÃO:<br>
                notificacao@vallechermont.com.br
                <br><br>

                APOSTILA DE HAIA:<br>
                apostila@vallechermont.com.br
                <br><br>

                LGPD:<br>
                lgpd@vallechermont.com.br
                <br><br>

                FINANCEIRO (DEPÓSITOS):<br>

                pix@vallechermont.com.br
                <br><br>

                OFICIAL:<br>
                oficial@vallechermont.com.br
                <br><br>

                OFICIAL SUBSTITUTO:<br>
                substituto@vallechermont.com.br<br><br>

                ATENDIMENTO AO CLIENTE:<br>
                sac@vallechermont.com.br
                <br><br>

                FALE CONOSCO<br>
                sac@vallechermont.com.br
                <br><br>
            </div>

            <div class="col_8">
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

    </div>
    <br clear="all" />
    <br clear="all" />
</section>