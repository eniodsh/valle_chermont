<?php

App::uses('AppController', 'Controller');
App::import('Vendor','phpthumb', array('file' => 'phpThumb' . DS . 'phpthumb.class.php'));

class UploadsController extends AppController {
	
	public function upload() {
		Configure::load('PartUpload.config');
		
		$this->layout = false;
		$this->autoRender = false;
		
		$model = $this->request->query['model'];
		$field = $this->request->query['field'];
		
		$modelObject = ClassRegistry::init($model);

		if(!isset($modelObject->actsAs['PartUpload.Upload'][$field])) {
			throw new Exception('falta configurar no model');
		}
					
		$configs = $modelObject->actsAs['PartUpload.Upload'][$field];
			
		//upload da imagem
		$tmpfile = uniqid(); //arquivo temporário
		$dir = Configure::read('uploadTempDir'); 
		
		//move o arquivo original para a pasta temp
		if(isset($this->request->query['qqfile'])) { //Caso a requisição venha via XHR (chrome, firefox, opera)
			$input = fopen('php://input', 'r');
			$target = fopen($dir . $tmpfile , 'w');
				
			stream_copy_to_stream($input, $target);
			fclose($target);
			fclose($input);
			$filename = $this->request->query['qqfile'];
		}
		else { //Caso venha via post com um iframe oculto (internet explorer)
			move_uploaded_file($_FILES['qqfile']['tmp_name'], $dir . $tmpfile);
			$filename = $_FILES['qqfile']['name'];
		}
		
		//separar o nome da extensão
		$parts = explode('.', $filename);
		$ext = array_pop($parts);

		$onlyFilename = join('.', $parts);
		
		//Caso seja para slugzar o nome:
		if(Configure::read('uploadSlugNames')) {
            $onlyFilename = Inflector::slug($onlyFilename, '-');
        }
		
		$tmpFilename = $onlyFilename;
		
		$i = 1;
		while(file_exists($dir . $onlyFilename . '.' . $ext)) {
			$onlyFilename = $tmpFilename . $i;
			$i++;
		}
		
		//TODO: montar validações

		//montar os redimensionamentos	
		if(!empty($configs['thumbsizes'])) {
			foreach($configs['thumbsizes'] as $prefix => $thumbsize) {
				$thumb = new phpthumb();
				$thumb->setSourceFilename($dir . $tmpfile);

				// verifica a utilizacao do parametro uploadDefaultZoomCrop
                if(isset($thumbsize['uploadDefaultZoomCrop']) && $thumbsize['uploadDefaultZoomCrop']) {
                    $thumb->setParameter('zc', 1);

                    // essa opcao apenas vai funcionar quando ambas as opcoes de largura e altura foram preenchidas
                    if(!isset($thumbsize['height']) || !isset($thumbsize['width'])) {
                        throw new CakeException('Para usar a opcao "uploadDefaultZoomCrop" é necessário preencher as ' .
                            'opções "width" e "height".');
                    }
                }
				
				if(isset($thumbsize['height'])) {
                    $thumb->setParameter('h', $thumbsize['height']);
                }
				
				if(isset($thumbsize['width'])) {
                    $thumb->setParameter('w', $thumbsize['width']);
                }
				
				if(isset($thumbsize['params'])) {
					foreach($thumbsize['params'] as $param => $value) {
						$thumb->setParameter($param, $value);
					}
				}
					
				$thumb->GenerateThumbnail();
				
				//Ajustar prefixo
				if($prefix == 'normal') {
                    $prefix = '';
                } else {
                    $prefix =  $prefix . '_';
                }
				
				$thumb->RenderToFile($dir . $prefix . $onlyFilename  . '.' . $ext);
			}
		}
		else {
			copy($dir . $tmpfile, $dir . $onlyFilename  . '.' . $ext);
		}
					
		@unlink($dir . $tmpfile);
		echo json_encode(array('path' => Configure::read('uploadPath') . $onlyFilename . '.' . $ext, 'filename' => $onlyFilename . '.' . $ext));
		
	}
}
