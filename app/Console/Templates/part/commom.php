<?php
function traduzir($str) {
	$str = str_replace("_id","", $str);
	
	$str = acentos($str);
	
	$termos = array(
		'created' => 'Criado em',
		'modified' => 'Modificado em',
		'titulo' => 'Título',
		'usuario' => 'usuário',
		'Usuario' => 'Usuário',
		'Usuarios' => 'Usuários',
		'email' => 'E-mail'	,
		'descricao' => 'Descrição'
	);
	if(isset($termos[$str]))
		return $termos[$str];
	else
		return Inflector::humanize($str);
}

function mostrar($singularVar, $modelClass, $field, $type) {
	$a = array(
		'boolean' => "\${$singularVar}['{$modelClass}']['{$field}'] == 1 ? __('Sim'): __('Não')",
		'datetime' => "d(\${$singularVar}['{$modelClass}']['{$field}'])",
		'imagem' => "\${$singularVar}['{$modelClass}']['{$field}'] != '' ? \$this->Html->image('/files/{$singularVar}/mini_' . \${$singularVar}['{$modelClass}']['{$field}'], array('alt' => 'miniatura')) : ''",
		'editor' => "\$this->Text->truncate(strip_tags(\${$singularVar}['{$modelClass}']['{$field}']), 150, array('exact' => false))"
	);
	return $a[$type];
}

/*
 * 
 * Copiado do plugin CakePtBr
 * 
 */
function acentos($palavra) {
	$espacamentos = array(' ', '_');
	foreach ($espacamentos as $espacamento) {
		if (strpos($palavra, $espacamento) !== false) {
			$palavra = explode($espacamento, $palavra);
			$saida = '';
			foreach ($palavra as $pedaco) {
				$saida .= acentos($pedaco) . $espacamento;
			}
			return rtrim($saida, $espacamento);
		}
	}
	if (preg_match('/(.*)cao$/', $palavra, $matches)) {
		return $matches[1] . 'ção';
	}
	if (preg_match('/(.*)ao(s)?$/', $palavra, $matches)) {
		return $matches[1] . 'ão' . (isset($matches[2]) ? $matches[2] : '');
	}
	if (preg_match('/(.*)coes$/', $palavra, $matches)) {
		return $matches[1] . 'ções';
	}
	if (preg_match('/(.*)oes$/', $palavra, $matches)) {
		return $matches[1] . 'ões';
	}
	if (preg_match('/(.*)aes$/', $palavra, $matches)) {
		return $matches[1] . 'ães';
	}
	return $palavra;
}
