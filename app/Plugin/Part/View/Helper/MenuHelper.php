<?php
/**
 * Part Comunicação Online
 * Helper para menus
 * @author leandro@part.com.br
 *
 */
class MenuHelper extends Helper {
	
	public $helpers = array('Html');
	
	function item($texto, $url, $icone = null, $onlyController = false) {
		$out = '<li';
		if(isset($this->request->params['prefix'])){
			$url = '/' . $this->request->params['prefix'] . $url;
		}
		
		$parsed = Router::parse($url);
		
		if($this->request->params['controller'] == $parsed['controller'] && ($this->request->params['action'] == $parsed['action'] || $onlyController)) {
			$out .= " class='active'";
		}
		
		$out .= '>';
		
		if($icone != null)
			$texto = '<i class="icon-' . $icone . ' icon"></i>' . $texto;
		
		
		$out .= $this->Html->link($texto, $url, array('escape' => false));
		
		$out .= '</li>';
		
		return $out;
	}	
}
