<?php $this->assign('menu', $this->element('admin/menu_configuracoes')); ?>

<h1>Usuários</h1>
<h3><?php echo h($usuario['Usuario']['nome']) ?></h3>
<table class="table table-bordered table-striped ">
	<tr>
		<td>Id</td>
		<td><?php echo h($usuario['Usuario']['id']) ?></td>
	</tr>
	<tr>
		<td>Usuário</td>
		<td><?php echo h($usuario['Usuario']['usuario']) ?></td>
	</tr>
	<tr>
		<td>Nome</td>
		<td><?php echo h($usuario['Usuario']['nome']) ?></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo h($usuario['Usuario']['email']) ?></td>
	</tr>
	<tr>
		<td>Criado em</td>
		<td><?php echo d($usuario['Usuario']['created']) ?></td>
	</tr>
	<tr>
		<td>Modificado em</td>
		<td><?php echo d($usuario['Usuario']['modified']) ?></td>
	</tr>
  <tr>
    <td>Removido em</td>
    <td><?php echo d($usuario['Usuario']['deleted']) ?></td>
  </tr>
</table>
<div class="well">
	<?php echo $this->Html->link($this->Html->icon('pencil white') . ' ' . __('Editar'), array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'class' => 'btn btn-primary')) ?> 
	<?php echo $this->Form->postLink($this->Html->icon('trash white') . ' ' . __('Excluir'), array('action' => 'delete', $usuario['Usuario']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Você realmente deseja apagar o ítem # %s?', $usuario['Usuario']['id'])) ?> 
	<?php echo $this->Html->link($this->Html->icon('arrow-left') . ' ' . __('Voltar'), array('action' => 'index'), array('class' => 'btn', 'escape' => false)) ?> 
</div>
