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
				'message' => "Cet Email est invalide")
		);
	}

	public function save($data){
		//initialisation des variables
		$this->errors=array();
		$key=$this->primaryKey;

		//demande de validation des données
		if ($this->validates($data)===true){
			$data = $this->cleaning($data,'pwd2');

			//enregistrement des données
			if(isset($data->$key) && !empty ($data->$key)){
				$data=$this->cleaning($data,'pwd');
				$sql = $this->update($data);
			}else{
				$sql = $this->create($data);
			}
			$pre = $this->db->prepare($sql);
			return $pre->execute($this->valeurs);
		}else{
			return $this->errors;
		}
	}
}
 ?>