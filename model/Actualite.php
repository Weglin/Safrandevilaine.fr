<?php 
/**
* 
*/
class Actualite extends Model {
	
	function __construct (){
		parent::__construct();
		$this->dataRule = array (
			'name' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un titre"),
			'content'=> array (
				'rule' => 'notEmpty',
				'message' => "L'article ne comporte aucun contenu"),
			'slug'=> array (
				'rule' => 'slug',
				'message'=> "Cette URL est invalide, il ne doit comporter que des caractères alphanumérique")
		);
	}
}
 ?>