<?php 
/**
* 
*/
class Commerce extends Model
{
	function __construct (){
		parent::__construct();
		$this->dataRule = array (
			'nom' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer le nom du commerce"),
			'activite'=> array (
				'rule' => 'notEmpty',
				'message' => "Vous devez décrire l'activité de ce commerce"),
			'adresse'=> array (
				'rule' => 'notEmpty',
				'message' => "Le champ adresse est vide"),
			'cp'=> array (
				'rule' => 'cPostal',
				'message' => "Le champ code postal n'est pas valide"),
			'ville'=> array (
				'rule' => 'notEmpty',
				'message'=> "Le champ ville est vide")
		);
	}
}
 ?>