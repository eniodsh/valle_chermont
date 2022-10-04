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
//invocações
App::uses($modelClass, 'Model');

eval("\$objModel = new {$modelClass}();");
$schema = $objModel->schema();
$validation = $objModel->validate;

include_once __DIR__ . '/../commom.php';

?>
<h1><?php printf("<?php echo __('%s') ?>", ucfirst(traduzir($pluralHumanName))) ?></h1>
<?php if($displayField) echo "<h3><?php echo h(\${$singularVar}['{$modelClass}']['{$displayField}']) ?></h3>\n" ?>
<table class="table table-bordered table-striped ">
<?php
foreach ($fields as $field) {
	$isKey = false;
	echo "\t<tr>\n";
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\t\t<td><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?></td>\n";
				echo "\t\t<td><?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></td>\n";
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t\t<td><?php echo __('" . ucfirst(traduzir($field)) . "'); ?></td>\n";
		
		if(isset($validation[$field]['partimagem'])) {
			echo "\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "imagem") . " ?>&nbsp;</td>\n";
		}
		else if($schema[$field]['type'] == 'boolean') {
			echo "\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "boolean") . " ?>&nbsp;</td>\n";
		}
		else if($schema[$field]['type'] == 'datetime') {
			echo "\t\t<td><?php echo " . mostrar($singularVar, $modelClass, $field, "datetime") . " ?>&nbsp;</td>\n";
		}
		else {
			echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']) ?>&nbsp;</td>\n";
		}
		
	}
	echo "\t</tr>\n";
}
?>
</table>
<div class="well">
	<?php echo "<?php echo \$this->Html->link(\$this->Html->icon('pencil white') . ' ' . __('Editar'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('escape' => false, 'class' => 'btn btn-primary')) ?>" ?> 
	<?php echo "<?php echo \$this->Form->postLink(\$this->Html->icon('trash white') . ' ' . __('Excluir'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger', 'escape' => false), __('Você realmente deseja apagar o ítem # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])) ?>" ?> 
	<?php echo "<?php echo \$this->Html->link(\$this->Html->icon('arrow-left') . ' ' . __('Voltar'), array('action' => 'index'), array('class' => 'btn', 'escape' => false)) ?>" ?> 
</div>
