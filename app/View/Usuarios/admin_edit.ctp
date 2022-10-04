<?php $this->assign('menu', $this->element('admin/menu_configuracoes')); ?>

<h1>Usuários</h1>

<?php echo $this->Form->create('Usuario', array('class' => 'form-horizontal')) ?>

	<fieldset>
		<legend>Editar Usuário</legend>
      <?php echo
      $this->Flash->render(),
      $this->Form->input('id'),
      $this->Form->input('usuario', array('label' => 'Usuário')),
      $this->Form->input('senha', array('type' => 'password', 'value' => '', 'helpInline' => 'Preencha somente para alterar')),
      $this->Form->input('nome'),
      $this->Form->input('email', array('label' => 'E-mail'));
      ?>
		<div class="form-actions">
			<?php echo $this->Form->submit('Salvar', array('div' => false, 'class' => 'btn btn-primary')) ?>
			<?php echo $this->Html->link('Cancelar', array('action' => 'index'), array('class' => 'btn'), 'Deseja realmenta cancelar?') ?>
		</div>
	</fieldset>

<?php echo $this->Form->end() ?>
