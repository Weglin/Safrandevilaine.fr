<?php 
/**
* 
*/
class Contact extends Model {
	function __construct (){
		if($this->requete === false){
			$this->table='config';
			$this->requete = new Requete(array(	'nom'=>$this->table.'s',
												'alias'=>$this->table,
												'primary_key'=>$this->primaryKey));
		}
		parent::__construct();
		
		$this->dataRule = array (
			'name' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un nom"),
			'email'=> array (
				'rule' => 'mail',
				'message' => "Cet Email est invalide"),			
			'content'=> array (
				'rule' => 'notEmpty',
				'message' => "Votre message est vide, merci de préciser votre demande"),
		);
	}
}

?>