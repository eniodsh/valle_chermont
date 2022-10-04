<?php
/**
 * Part Comunicação Online
 * Helper para menus
 * @author leandro@part.com.br
 *
 */
class MenuHelper extends Helper {
	
	public $helpers = array('Html');
	
	function item($texto, $url, $icone = null) {
		$out = '<li';
		$parsed = Router::parse($url);
		$prefix = $this->request->params['prefix'];
		
		if($this->request->params['controller'] == $parsed['controller'] && $this->request->params['action'] == $prefix . '_' . $parsed['action']) {
			$out .= " class='active'";
		}
		
		$out .= '>';
		
		if($icone != null)
			$texto = '<i class="icon-' . $icone . ' icon"></i>' . $texto;
		
		
		$out .= $this->Html->link($texto, array($prefix => true, 'controller' => $parsed['controller'], 'action' => $parsed['action']), array('escape' => false));
		
		$out .= '</li>';
		
		return $out;
	}	
}
