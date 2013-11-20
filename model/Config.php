<?php 
/**
* 
*/
class Config extends Model {

	function __construct (){
		parent::__construct();
		$this->dataRule = array (
			'host' => array (
				'rule' => 'notEmpty',
				'message' => "Vous devez renseigner un nom d'hôte"),
			'port'=> array (
				'rule' => 'entier',
				'message' => "Le Port doit être un nombre entier"),
			'username'=> array (
				'rule' => 'mail',
				'message'=> "L'identifiant doit être au format user@domaine.com"),
			'password'=> array (
				'rule' => 'notEmpty',
				'message'=> "Le mot de passe n'a pas été renseigné")

		);
	}

	public function save($datas){
		//initialisation des variables
		$this->errors=array();
		$key=$this->primaryKey;
				
		if ($this->validates($datas)===true){
			switch ($datas->name='smtp') {
				case 'smtp':
					unset($datas->name);
					foreach($datas as $k=>$v){
						$data= new stdClass();
						$findData=$this->findFirst(array(
							'fields'=>$key,
							'conditions'=>array('name'=>'smtp','param'=>$k)));
						
						$data->name='smtp';
						$data->param=$k;
						$data->value=$v;
						
						if(isset($findData->$key) && !empty($findData->$key)){
							$data->$key=$findData->$key;
							$sql =$this->update($data);
						}else{
							$data->$key='';
							$sql =$this->create($data);
						}
						$pre = $this->db->prepare($sql);
						$result[$k]=$pre->execute($this->valeurs);
					}
					break;
				default :
					return false;
			}

			foreach ($result as $k => $v){
				if ($v!=true){
					$this->errors[$k]='Une erreur s\'est produite lors de l\'enregistrement du paramètre <b>"'.$k.'"</b>';
				}
			}
			if (!empty($this->errors)){
				return $this->errors;
			}
			return true;

		}else{
			return $this->errors;
		}
	}
}
 ?>