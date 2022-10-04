<?php $this->assign('menu', $this->element('admin/menu_configuracoes')); ?>

<h1>Usuários</h1>

<div class="well">
	<?php echo $this->Html->link($this->Html->icon('file white') . ' ' . 'Cadastrar usuário' , array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)) ?>
	<?php echo $this->Form->create('Usuario', array('type' => 'get', 'class' => 'pull-right')) ?> 
	<?php echo $this->Form->input('busca', array('class' => 'input-medium search-query', 'label' => false, 'div' => false, 'value' => isset($this->request->query['busca']) ? $this->request->query['busca'] : '' )) ?> 
		<button type="submit" class="btn"><i class="icon-search icon"></i>Buscar</button>
	<?php echo $this->Form->end() ?> 
</div>

<?php echo $this->Flash->render() ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th class="id"><?php echo $this->Paginator->sort('id', 'Id');?></th>
			<th><?php echo $this->Paginator->sort('usuario', 'Usuário');?></th>
			<th><?php echo $this->Paginator->sort('nome', 'Nome');?></th>
			<th><?php echo $this->Paginator->sort('email', 'E-mail');?></th>
			<th class="actions">Ações</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($usuarios as $usuario) : ?>
    <tr>
      <td><?php echo h($usuario['Usuario']['id']) ?></td>
      <td><?php echo h($usuario['Usuario']['usuario']) ?></td>
      <td><?php echo h($usuario['Usuario']['nome']) ?></td>
      <td><?php echo h($usuario['Usuario']['email']) ?></td>

      <td class="actions">
        <?php echo $this->Html->link($this->Html->icon('file white'), array('action' => 'view', $usuario['Usuario']['id']), array('escape' => false, 'class' => 'btn btn-info', 'title' => __('detalhes'))); ?>
        <?php echo $this->Html->link($this->Html->icon('pencil white'), array('action' => 'edit', $usuario['Usuario']['id']), array('escape' => false, 'class' => 'btn btn-primary', 'title' => __('editar'))); ?>
        <?php echo $this->Form->postLink($this->Html->icon('trash white'), array('action' => 'delete', $usuario['Usuario']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'title' => __('apagar')), __('Você realmente deseja apagar o ítem # %s?', $usuario['Usuario']['id'])); ?>
      </td>
    </tr>
<?php endforeach; ?>
<?php if (empty($usuarios)) : ?>
    <tr>
      <td colspan="5">Nenhum registro encontrado</td>
    </tr>
<?php endif; ?>
  </tbody>
</table>

<div class="pagination pull-right">
	<ul>
	<?php
  echo $this->Paginator->first('←');
  echo $this->Paginator->prev('«');
  echo $this->Paginator->numbers();
  echo $this->Paginator->next('»');
  echo $this->Paginator->last('→');
	?> 
	</ul>
</div>
