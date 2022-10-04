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
//invocacoes
App::uses($modelClass, 'Model');

eval("\$objModel = new {$modelClass}();");
$schema = $objModel->schema();
$validation = $objModel->validate;

include_once __DIR__ . '/../commom.php';

?>
<h1><?php printf("<?php echo __('%s') ?>", ucfirst(traduzir($pluralHumanName))) ?></h1>
<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('class' => 'form-horizontal', 'type' => 'file')) ?>";?> 
	<fieldset>
		<legend><?php printf("<?php echo __('%s') . ' ' . __('%s') ?>", strpos($action, 'add') !== false ? "Cadastrar" : "Editar" , traduzir($singularHumanName)); ?></legend>
		<?php echo "<?php echo \$this->Flash->render() ?>" ?>
<?php
		$camposCompletos = array();
		$temSlug = false;
		foreach ($fields as $key => $value) {
			if(isset($schema[$value])){
				if($value == 'slug'){
					$temSlug = true;
				}
				$camposCompletos[$value] = $schema[$value];
			}
		}

		echo "\t\t<?php\n";
		foreach ($camposCompletos as $key => $value) {
			$nomeCampo = $key;
			$tipo = $value['type'];

			if (strpos($action, 'add') !== false && $nomeCampo == $primaryKey) {
				continue;
			} elseif (!in_array($nomeCampo, array('created', 'modified', 'updated'))) {
				$label = traduzir($nomeCampo, true);
				
				$options = array();
				if($label != Inflector::humanize($nomeCampo))
					$options['label'] = ucfirst($label);
				

				if($temSlug) {
					if($nomeCampo == 'nome'){
						echo "\t\t\techo \$this->Form->input('{$nomeCampo}', array('type'=>'text','class'=>'geraSlug'));\n";
						continue;	
					}
					if($nomeCampo == 'titulo'){
						echo "\t\t\techo \$this->Form->input('{$nomeCampo}', array('type'=>'text','class'=>'geraSlug'));\n";
						continue;	
					}
					if($nomeCampo == 'slug'){
						echo "\t\t\techo \$this->Form->input('{$nomeCampo}', array('type'=>'text','class'=>'pegaSlug'));\n";
						continue;	
					}
				}

				
				//tipo a tipo
				if(isset($validation[$nomeCampo]['partimagem'])) {
					echo "\t\t\techo \$this->Upload->input('{$nomeCampo}'";
				}
				else if(isset($validation[$nomeCampo]['partarquivo'])) {
					echo "\t\t\techo \$this->Upload->input('{$nomeCampo}'";
				}
				else if($tipo == 'date') {
					echo "\t\t\techo \$this->Form->input('{$nomeCampo}', array('type'=>'text','class'=>'data'));\n";
					continue;
				}
				else {
					echo "\t\t\techo \$this->Form->input('{$nomeCampo}'";
				}
				
				if(isset($validation[$nomeCampo]['parteditor']) || $tipo == 'text') {
					$options['class'] = 'editor';
				}
				
				if($nomeCampo == 'email') {
					$options['class'] = 'email';
				}
				if($nomeCampo == 'telefone') {
					$options['class'] = 'telefone';
				}
				if($nomeCampo == 'celular') {
					$options['class'] = 'celular';
				}

				if(isset($validation[$nomeCampo]['notempty'])) {
					$options['required'] = 'required';
				}
				
				
				//options
				if(count($options) > 0) {
					echo ', array(';
					foreach($options as $option => $value) {
						echo '"' . $option . '" => "' . $value . '", ';	
					}
					echo ')';
				}
				
				echo ");\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\t\techo \$this->Form->input('{$assocName}');\n";
			}
		}
		echo "\t\t?>\n";
?>
		<div class="form-actions">
			<?php echo "<?php echo \$this->Form->submit(__('Salvar'), array('div' => false, 'class' => 'btn btn-primary')) ?> " ?> 
			<?php echo "<?php echo \$this->Html->link(__('Cancelar'), array('action' => 'index'), array('class' => 'btn'), __('Deseja realmenta cancelar?')) ?>" ?> 
		</div>
	</fieldset>
<?php echo "<?php echo \$this->Form->end() ?>" ?>
