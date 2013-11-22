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

}
 ?>