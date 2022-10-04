<?php
App::uses('AppModel', 'Model');
/**
 * Part Comunicação Online
 */
class PartUpload extends AppModel {
	
	public $useTable = false;		
	
	public $actsAs = array( 
		'PartUpload.Upload' => array(
			'image1' => array('thumbsizes' => array('normal' => array('height' => 200, 'width' => 300))),
			'image2' => array(),
			'image3' => array()
		)
	);
	
}
	