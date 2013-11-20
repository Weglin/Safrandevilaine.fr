<?php 
/**
* 
*/
class Page extends Model
{
	function __construct (){
		parent::__construct();
		$this->dataRule = array (
			'name' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un titre"),
			'content'=> array (
				'rule' => 'notEmpty',
				'message' => "La page ne comporte aucun contenu"),
			'slug'=> array (
				'rule' => 'slug',
				'message'=> "Cette URL est invalide, il ne doit comporter que des caractères alphanumériques")
		);
	}
}
 ?>