<?php 
/**
* 
*/
class User extends Model
{
	function __construct (){
		parent::__construct();
		$this->dataRule = array (
			'nom' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un nom"),
			'prenom'=> array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un prénom"),
			'adresse'=> array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer une adresse"),
			'cp'=> array (
				'rule' => 'cPostal',
				'message' => "Vous devez indiquer un code postal valide"),
			'ville'=> array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer une ville"),
			'pays'=> array (
				'rule' => 'notEmpty',
				'message' => "Vous devez indiquer un pays"),
			'email'=> array (
				'rule' => 'mail',
				'message' => "Cet Email est invalide"),
			'pwd'=> array (
				'rule' => 'password',
				'message'=> array(
					'inf' => "Votre mot de passe doit comporter au moins 8 caractères pour être valide",
					'idem' => "Vous avez fait une erreur de frappe en indiquant votre mot de passe, les deux champs doivent être identiques"))
		);
	}
}
 ?>