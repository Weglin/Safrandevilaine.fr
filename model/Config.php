<?php 
/**
* 
*/
class Config extends Model {

	function __construct (){
		parent::__construct();
	}

	public function save($datas){
		//initialisation des variables
		$this->errors=array();
		$key=$this->primaryKey;
				
		if ($this->validates($datas)===true){
			$name=$datas->name;
			unset($datas->name);
			foreach($datas as $k=>$v){
				$data= new stdClass();
				$findData=$this->findFirst(array(
						'fields'=>$key,
						'conditions'=>array('name'=>$name,'param'=>$k)));

				$data->name=$name;
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


	/**
	*
	*/
	public function validates($data){
		foreach ($this->dataRule as $k=>$v){
			if (!isset($data->$k)){
				$this->errors[$k]= "Le champ ".$k." n'existe pas alors qu'une règle lui a été définie";
			}else{
				switch ($v['rule']) {
					case 'notEmpty' :
						if (empty($data->$k)){
							$this->errors[$k]=$v['message'];		
						}
						break;

					case 'slug' :
						if (!preg_match('/^([[:alnum:]\-]+)$/', $data->$k)){
							$this->errors[$k]=$v['message'];
						}
						break;

					case 'cPostal' :
						if (isset($data->pays)){
							switch ($data->pays) {
								case 'France' :
									if (!preg_match('/^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/', $data->$k)){
										$this->errors[$k]=$v['message'];
									}
									break;
								case 'United Kingdom' :
									if (!preg_match('/^((GIR 0AA)|((([^QVX][0-9][0-9]?)|(([^QVX][^IJZ][0-9][0-9]?)|(([^QVX][0-9][A-HJKSTUW])|([^QVX][^IJZ][0-9][ABEHMNPRVWXY])))) [0-9][^CIKMOV]{2}))$/', $data->$k)){
										$this->errors[$k]=$v['message'];
									}
							}	
						}
						break;

					case 'mail' :
						if (!preg_match('/^[[:alnum:]]([-_.]?[[:alnum:]])+_?@[[:alnum:]]([-.]?[[:alnum:]])+\.[[:alpha:]]{2,6}$/', $data->$k)) {
							$this->errors[$k]=$v['message'];
						}
						break;

					case 'password' :
						$k2= $k.'2';
						if (strlen($data->$k)<8){
							$this->errors[$k]=$v['message']['inf'];
						}
						if ($data->$k<>$data->$k2) {
							$this->errors[$k2]=$v['message']['idem'];
						}
						break;

					case 'entier' :
						if(!StringIsInt($data->$k)){
							$this->errors[$k]=$v['message'];
						}
						break;

					default :
						$this->errors[$k]="La règle d'enregistrement n'est pas définie pour le champ ".$k;	
				} 
			}

		}
		if (!empty($this->errors)){
			return $this->errors;
		}
		return true;
	}
}
 ?>