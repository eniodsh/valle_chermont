<?php
/**
 * Bake Template for Controller action generation.
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
 * @package       Cake.Console.Templates.default.actions
 * @since         CakePHP(tm) v 1.3
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

include_once __DIR__ . '/../commom.php';
 
?>

  /**
   * @return void
   */
	public function <?php echo $admin ?>index()
  {
    if (isset($this->request->query['busca'])) {
			$this->paginate = array('conditions'=>array('or' => array(
<?php 
	$campos = $modelObj->schema();
	foreach($campos as $campo => $propriedades) { 
		if($propriedades['type'] != 'string' && $propriedades['type'] != 'text')
			continue;
?>
				"<?php echo $modelObj->name ?>.<?php echo $campo ?> LIKE '%{$this->request->query['busca']}%'",
<?php } ?>
			)));
		}

		$this->set('<?php echo $pluralName ?>', $this->paginate());
	}

  /**
   * @param string $id
   * @return void
   */
	public function <?php echo $admin ?>view($id = null)
  {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException('<?php echo ucfirst(traduzir($singularHumanName)); ?> inválido(a).');
		}
		$this->set('<?php echo $singularName; ?>', $this-><?php echo $currentModelName; ?>->read(null, $id));
	}

<?php $compact = array(); ?>
  /**
   * @return void
   */
	public function <?php echo $admin ?>add()
  {
		if ($this->request->is('post')) {
			$this-><?php echo $currentModelName; ?>->create();
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
        $this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> foi salvo(a) com sucesso.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
        $this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> não pode ser salvo(a). Tente novamente.', array('element' => 'alert'));
			}
		}
<?php
	foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
		foreach ($modelObj->{$assoc} as $associationName => $relation):
			if (!empty($associationName)):
				$otherModelName = $this->_modelName($associationName);
				$otherPluralName = $this->_pluralName($associationName);
				echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
				$compact[] = "'{$otherPluralName}'";
			endif;
		endforeach;
	endforeach;
	if (!empty($compact)):
		echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
	endif;
?>
	}

<?php $compact = array(); ?>
  /**
   * @param string $id
   * @return void
   */
	public function <?php echo $admin; ?>edit($id = null)
  {
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException('<?php echo ucfirst(traduzir($singularHumanName)); ?> inválido(a).');
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this-><?php echo $currentModelName; ?>->save($this->request->data)) {
				$this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> foi editado(a) com sucesso.', array('element' => 'success'));
				$this->redirect(array('action' => 'index'));
			} else {
        $this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> não pode ser editado(a). Tente novamente.', array('element' => 'alert'));
			}
		} else {
			$this->request->data = $this-><?php echo $currentModelName; ?>->read(null, $id);
		}
<?php
		foreach (array('belongsTo', 'hasAndBelongsToMany') as $assoc):
			foreach ($modelObj->{$assoc} as $associationName => $relation):
				if (!empty($associationName)):
					$otherModelName = $this->_modelName($associationName);
					$otherPluralName = $this->_pluralName($associationName);
					echo "\t\t\${$otherPluralName} = \$this->{$currentModelName}->{$otherModelName}->find('list');\n";
					$compact[] = "'{$otherPluralName}'";
				endif;
			endforeach;
		endforeach;
		if (!empty($compact)):
			echo "\t\t\$this->set(compact(".join(', ', $compact)."));\n";
		endif;
	?>
	}

  /**
   * @param string $id
   * @return void
   */
	public function <?php echo $admin; ?>delete($id = null)
  {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this-><?php echo $currentModelName; ?>->id = $id;
		if (!$this-><?php echo $currentModelName; ?>->exists()) {
			throw new NotFoundException('<?php echo ucfirst(traduzir($singularHumanName)); ?> inválido(a).');
		}
		if ($this-><?php echo $currentModelName; ?>->delete()) {
      $this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> foi excluido(a) com sucesso.', array('element' => 'success'));
			$this->redirect($this->referer());
		}

    $this->Flash->set('O(a) <?php echo traduzir(strtolower($singularHumanName)); ?> não pode ser excluido(a). Tente novamente.', array('element' => 'alert'));
		$this->redirect($this->referer());
	}
