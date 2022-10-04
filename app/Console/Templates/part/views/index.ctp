<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	App::uses($modelClass, 'Model');
	
	eval("\$objModel = new {$modelClass}();");
	$schema = $objModel->schema();
	$validation = $objModel->validate;
	
  include_once __DIR__ . '/../commom.php';
?>
<h1><?php echo "<?php echo __('" . traduzir($pluralHumanName) . "') ?>" ?></h1>

<div class="well">
	<?php echo "<?php echo \$this->Html->link(\$this->Html->icon('file white') . ' ' . __('Cadastrar') . ' ' . __('" . traduzir(strtolower($singularHumanName)) . "') , array('action' => 'add'), array('class' => 'btn btn-primary', 'escape' => false)) ?>" ?> 
	<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('type' => 'get', 'class' => 'pull-right')) ?>" ?> 
	<?php echo "<?php echo \$this->Form->input('busca', array('class' => 'input-medium search-query', 'label' => false, 'div' => false, 'value' => isset(\$this->request->query['busca']) ? \$this->request->query['busca'] : '' )) ?>" ?> 
		<button type="submit" class="btn"><i class="icon-search icon"></i>&nbsp;Buscar</button>
	<?php echo "<?php echo \$this->Form->end() ?>" ?> 
</div>

<?php echo "<?php echo \$this->Flash->render() ?>" ?>
<table class="table table-striped">
	<thead>
		<tr>
<?php  
		$i = 1;
		foreach ($fields as $field) {
			$custom = ucfirst(traduzir($field));
?>
			<th<?php if($field == 'id') echo ' class="id"' ?>><?php echo "<?php echo \$this->Paginator->sort('{$field}','{$custom}');?>";?></th>
<?php
			if($i==4) break;
			$i++; 
		}
?>
			<th class="actions"><?php echo __('Ações');?></th>
		</tr>
	</thead>
	<tbody>
<?php echo "<?php
	\$i = 1; 
	foreach (\${$pluralVar} as \${$singularVar}){
?>" ?> 
		<tr>
<?php 
		$i = 1;
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t\t<td>\n\t\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				//Tipo a tipo
				if(isset($validation[$field]['partimagem'])) {
					echo "\t\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "imagem") . " ?>&nbsp;</td>\n";
				}
				else if(isset($validation[$field]['parteditor'])) {
					echo "\t\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "editor") . " ?>&nbsp;</td>\n";
				}
				else if($schema[$field]['type'] == 'boolean') {
					echo "\t\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "boolean") . " ?>&nbsp;</td>\n";
				}
				else if($schema[$field]['type'] == 'datetime') {
					echo "\t\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "datetime") . " ?>&nbsp;</td>\n";
				}
				else {
					echo "\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']) ?>&nbsp;</td>\n";
				}
			}
			if($i==4) break;
			$i++;
		}
?>			
			<td class="actions">
				<?php echo "<?php echo \$this->Html->link(\$this->Html->icon('file white'), array('action' => 'view', \${$singularVar}['{$modelClass}']['id']), array('escape' => false, 'class' => 'btn btn-info', 'title' => __('detalhes'))); ?>" ?> 			
				<?php echo "<?php echo \$this->Html->link(\$this->Html->icon('pencil white'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['id']), array('escape' => false, 'class' => 'btn btn-primary', 'title' => __('editar'))); ?>"?> 
				<?php echo "<?php echo \$this->Form->postLink(\$this->Html->icon('trash white'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['id']), array('class' => 'btn btn-danger', 'escape' => false, 'title' => __('apagar')), __('Você realmente deseja apagar o ítem # %s?', \${$singularVar}['{$modelClass}']['id'])); ?>" ?> 
			</td>
		</tr>
<?php echo "<?php
		\$i++;
	}
	if(\$i == 1) {
?>" ?>
		<tr>
			<td colspan="<?php echo $i + 1 ?>">Nenhum registro encontrado</td>
		</tr>
<?php echo "<?php } ?>" ?>
  </tbody>
</table>

<div class="pagination pull-right">
	<ul>
	<?php echo "<?php
		echo \$this->Paginator->first('←');
		echo \$this->Paginator->prev('«');
		echo \$this->Paginator->numbers();
		echo \$this->Paginator->next('»');
		echo \$this->Paginator->last('→');
	?>" ?> 
	</ul>
</div>
