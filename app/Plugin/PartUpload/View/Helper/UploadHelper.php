<?php
/**
 * Part Comunicação Online
 * Helper para uploads
 * @author leandro@part.com.br
 *
 */
class UploadHelper extends AppHelper {
	private $partes = array();
	private $configs = null;
	private $data = null;
	private $id = "";
	private $model;
	private $field;
	private $inputName;
	private $type;
	
	/*Para usar com relacionamento hasmany*/
	private $multiple = false;
	private $i = 0; //iterador de multiplos
	
	public $helpers = array('Html', 'Form');
	private $templateItemImage;
	private $templateItemFile;
	private $templateItemProgress;
	private $first = true; //controla se ja existe um input
	
	private function init($campo, &$options = array()) {
		
		$defaultOptions = array(
			'label' => null, 
			'div' => 'control-group',
			'labelClass' => 'control-label',
			'controls' => 'controls',
			'class' => 'btn', 
			'thumbnails' => 'thumbnails',
			'text' => null,
			'before' => '',
			'between' => '',
			'after' => ''
		);
		
		$options = array_merge($defaultOptions, $options);
		
				
		/*Define o mapa do campo*/
		$this->partes = explode('.', $campo);
		if(count($this->partes) == 1) {
			array_unshift($this->partes, key($this->request->params['models']));
		}
		
		//Id do campo
		$this->id = join('', $this->partes);
		
		
		//nome do model
		$this->model = $this->partes[0];
		
		//verifica se está em plugin
		if($this->request->params['plugin'] !== null) {
			$this->model = Inflector::camelize($this->request->params['plugin']) . '.' . $this->model;
			
		}
		
		$this->field = end($this->partes);
		
		//verificar se o model da imagem é o model principal ou se é um model que faz has many para habilitar o upload multiplo
		if($this->model != key($this->request->params['models'])) {
			$modelRequest = ClassRegistry::init(key($this->request->params['models']));
			if(isset($modelRequest->hasMany[$this->model])) {
				$this->multiple = true;
			}
		}
		
		//ler model da imagem
		$model = ClassRegistry::init($this->model);
		
		if(!isset($model->actsAs['PartUpload.Upload'][$this->field])) {
			throw new Exception('falta configurar no model');
		}
					
		$this->configs = $model->actsAs['PartUpload.Upload'][$this->field];
		
		if(isset($this->configs['type'])) {
			$this->type = $this->configs['type'];
		}
		else {
			$this->type = $configs['type'] = 'image';
		}
		
		//lê o data
		if(isset($this->request->data[$this->model]))
			$this->data = $this->request->data[$this->model];	
	
	
		//Coisas que só roda no primeiro botão que for adicionado
		if($this->first) {
			Configure::load('PartUpload.config');
			
			$this->templateItemImage = Configure::read('templateItemImage');
			$this->templateItemFile = Configure::read('templateItemFile');
			$this->templateItemProgress = Configure::read('templateItemProgress');
			
			$this->first = false;
			
			$templates = array('templateItemImage' => $this->templateItemImage, 'templateItemFile' => $this->templateItemFile, 'templateItemProgress' => $this->templateItemProgress);
			
			$this->Html->scriptBlock('var uploadTemplates = ' . json_encode($templates) . ';', array('block' => 'script'));
			//Script Fineupload
			$this->Html->script('PartUpload.jquery.fineuploader-3.0.min', array('block' => 'script'));
			//$this->Html->css('PartUpload.fileuploader', null, array('block' => 'css'));
			
			//funções deste helper
			$this->Html->script('PartUpload.partupload', array('block' => 'script'));
		}

	}
	
	/**
	 * Percorre recursivamente um array com o outro afim de encontrar o valor final.
	 */
	private function searchData($data, $partes) {
		$posicao = array_shift($partes);
		if(count($partes) > 0) {
			if(!isset($data[$posicao]))
				return null;
			return $this->searchData($data[$posicao], $partes);
		}
		else
			return $data[$posicao];
	}
		
	
	public function input($campo, $options = array()) {
		
		//montar label
		$this->init($campo, $options);
		
		$labelOptions = array();
		if($options['labelClass']) {
			$labelOptions = $this->Form->addClass($labelOptions, $options['labelClass']);
		}
		
		if($options['label'] !== false)		
			$label = $this->Form->label($campo, $options['label'], $labelOptions);
		else 
			$label = '';
		
		
		
		//montar input
		$this->inputName = 'data[' . implode('][', $this->partes) . ']';
	
		$previewOut = '';
		if($this->data != null) {
			$i = 0;
			if(!$this->multiple) {
				$data = array($this->data);
			}
			else {
				$data = $this->data;
			}
			
			if($this->type == 'image') {
				$template = $this->templateItemImage;
			}
			else {
				$template = $this->templateItemFile;
			}
			
			
			foreach($data as $item) {
				$campo = $item[end($this->partes)];
				
				if(empty($campo)) //caso não tenha foto subida.
					continue;
				
				$inputNameI = str_replace('0', $i, $this->inputName);
				if(gettype($campo) == 'array' && $campo['status'] == 'new') { //Caso seja voltando da validação mas seja um campo novo
					$previewOut .= str_replace(
						array('{fieldId}', '{itemId}', '{folder}', '{image}', '{imageName}', '{inputName}', '{status}', '{multiple}'), 
						array($this->id, $i, $this->Html->url('/files/tmp/'), $campo['file'], $campo['file'], $inputNameI, 'new', $this->multiple? 'true': 'false'),
						$template
					);
				}
				else if(gettype($campo) == 'array' && $campo['status'] == 'old') { //Caso seja voltando da validação, mas seja de um campo que veio do edit.
					$previewOut .= str_replace(
							array('{fieldId}', '{itemId}', '{folder}', '{image}', '{imageName}', '{inputName}', '{status}', '{multiple}'),
							array($this->id, $i, $this->Html->url('/files/' . strtolower($this->partes[0]) . '/'), $campo['file'], $campo['file'], $inputNameI, 'old', $this->multiple? 'true': 'false'),
							$template
					);
				}
				elseif(gettype($campo) == 'string') { //Caso seja vindo do edit
					$previewOut .= str_replace(
							array('{fieldId}', '{itemId}', '{folder}', '{image}', '{imageName}', '{inputName}', '{status}', '{multiple}' ),
							array($this->id, $i, $this->Html->url('/files/' . strtolower($this->partes[0]) . '/'), $campo, $campo, $inputNameI, 'old', $this->multiple? 'true': 'false'),
							$template
					);
				}
				$i++;
				$this->i = $i;
			}
			
		}

		//TODO: fazer os erros de validação
		$error = '';
		
		$textName = $this->type == 'image'? __('imagem'): __('arquivo');

		if(!$this->multiple)
			$text = __("Subir") . ' ' . $textName;
		else
			$text = __("Subir") . ' ' . Inflector::pluralize($textName);
		
		if($options['text'] !== null)
			$text = $options['text'];
			
	
		
		$buttonOptions = array(
			'id' => $this->id . '-button',
			'class' => $options['class'],
			'rel' => 'upload-button',
			'data-id' => $this->id,
			'data-input-name' => $this->inputName,
			'data-type' => $this->type,
			'data-action' =>  $this->Html->url(array('controller' => 'uploads', 'action' => 'upload', 'plugin' => 'part_upload', 'admin' => false)),
			'data-multiple' => $this->multiple? 1: 0,
			'data-i' => $this->i, 
			'data-model' => $this->model, 
			'data-field' => $this->field,
			'data-folder' => $this->Html->url('/')
		);
		
		
		$input = $this->Html->link($text, 'javascript:void(0)', $buttonOptions);
		
		
		if($options['thumbnails'] !== false){
			$input .= '<ul id="' . $this->id . '-preview" class="' . $options['thumbnails'] . '">' . $previewOut . '</ul>';
		}
				
		if($options['controls']  !== false) {
			$input = $this->Html->div(array('class' => $options['controls']), $input);
		}
		
		
		$out = $options['before'] . $label . $options['between'] . $input . $options['after'] . $error;
		
		
		if($options['div'] !== false)
			$out = $this->Html->div(array('class' => $options['div']), $out);
		
 
		return $out;
	}
		
}
