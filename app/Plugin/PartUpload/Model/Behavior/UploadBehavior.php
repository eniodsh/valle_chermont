<?php
App::uses('File', 'Utility');
App::uses('Folder', 'Utility');


class UploadBehavior extends ModelBehavior {
	private $tempFolder;
	
	public $defaults = array(
		'path' => '{ROOT}webroot{DS}files{DS}{model}{DS}{field}{DS}',
	);

	function __construct() {
		Configure::load('PartUpload.config');
			
		//limpar pasta temporária
		$this->tempFolder = Configure::read('uploadTempDir');
		
		if(!is_dir($this->tempFolder)) {
			@mkdir($this->tempFolder, '0777');
		}
		else {
			//data limite
			$limite = strtotime('-1 hour');
			
			$p = opendir($this->tempFolder);
			if($p !== false) {
				while(($file = readdir($p)) !== false){
					if(is_file($this->tempFolder . $file)){
						if(filemtime($this->tempFolder . $file) < $limite)
							@unlink($this->tempFolder . $file);
					}
				}
				closedir($p);
			}
		}
	}

	function setup(Model $model, $settings = array()) {
		$this->fields[$model->name] =  $settings;
		
		foreach($this->fields[$model->name] as $field => $setting) {
			
		}
	}

	private function deleteFiles($item, $field, $setting, $model) {		
		$folder = WWW_ROOT . 'files' . DS . strtolower($model->name) . DS;
		
		@unlink($folder . $item[$field]['file']);
		
		if(!empty($setting['thumbsizes'])) {
			foreach($setting['thumbsizes'] as $prefix => $thumbsize) {
				if($prefix == 'normal')
					continue;
				@unlink($folder . $prefix . '_' . $item[$field]['file']);
			}
		}

		if($item[$field]['multiple'] == 'true'){
			$conditions = array($model->name . '.' . $field => $item[$field]['file']);
			$deleted = $model->deleteAll($conditions, false);
			unset($model->data[$model->name]);
		}
		else {
			$model->data[$model->name][$field] = "";
		}
	}

    function beforeSave(Model $model, $options = array()) {
		
		foreach($this->fields[$model->name] as $field => $setting) {
			if(!isset($model->data[$model->name][$field]) || !is_array($model->data[$model->name][$field])) {				
				continue;
			}

			$arquivo = $model->data[$model->name][$field]['file'];
			
			if($model->data[$model->name][$field]['status'] == 'old' && $model->data[$model->name][$field]['multiple'] == 'true') {
				unset($model->data[$model->name]);
				continue;
			}
			
			if($model->data[$model->name][$field]['status'] == 'old') {
				unset($model->data[$model->name][$field]);
				continue;
			}

			elseif ($model->data[$model->name][$field]['status'] == 'rem') {
				$this->deleteFiles($model->data[$model->name], $field, $setting, $model);
				continue;
			}
			
			//separar extensão do arquivo
			$partes = explode('.', $arquivo);
			$ext = array_pop($partes);
			$nomeArquivo = implode($partes, '.');
			
			//copiar para a nova pasta
			$folder = WWW_ROOT . 'files' . DS . strtolower($model->name) . DS;
			$tempFolder = Configure::read('uploadTempDir');
		
			if(!file_exists($folder))
				mkdir($folder, '0777');
			
			$i = 1;
			$nomeArquivoTemp = $nomeArquivo;
			while(file_exists($folder . $nomeArquivo . '.' . $ext)){
				$nomeArquivo = $nomeArquivoTemp . $i;
				$i++;
			}
			
			//arquivo principal
			copy($tempFolder . $arquivo, $folder . $nomeArquivo . '.' . $ext);
			@unlink($tempFolder . $arquivo);
			
			//thumbnails
			if(!empty($setting['thumbsizes'])) {
				foreach($setting['thumbsizes'] as $prefix => $thumbsize) {
					if($prefix == 'normal') continue;
					copy($tempFolder . $prefix . '_' . $arquivo, $folder . $prefix . '_' . $nomeArquivo . '.' . $ext);
					@unlink($tempFolder . $prefix . '_' . $arquivo);
				}
			}
			
			//TODO: Deletar arquivos antigos em caso de edit.
			
			//coloca o data com o nome que pode ter sido alterado
			$model->data[$model->name][$field] = $nomeArquivo . '.' . $ext;
		}

		return true;
	}
	
	function beforeDelete(Model $model, $cascade = true) {
		$data = $model->findById($model->id);
		$folder = WWW_ROOT . 'files' . DS . strtolower($model->name) . DS;
		
		
		foreach($this->fields[$model->name] as $field => $setting) {
			foreach($setting['thumbsizes'] as $prefix => $thumbsize) {
				if($prefix == 'normal') continue;
				@unlink($folder . $prefix . '_' . $data[$model->name][$field]);
			}
			@unlink($folder . $data[$model->name][$field]);
		}
		return true;
	}

}
